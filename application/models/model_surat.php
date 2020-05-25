<?php
class Model_Surat extends MY_Model
{

    function FixDatePicker($data)
    {
        $data = explode("/", $data);
        $data = "{$data[2]}-{$data[1]}-{$data[0]}";
        return $data;
    }

    function TambahSurat($data)
    {
        if (is_array($data['klasifikasi'])) {
            $data['klasifikasi'] = implode(".", $data['klasifikasi']);
        }

        $date = date("Y-m-d H:i:s");
        if ($data['tipesurat'] === 'suratmasuk') {
            $id = $this->getIdRandom('suratmasuk', 20, 'SM');
            $tabel = 'surat_masuk';
            $value = array(
                'id_suratmasuk' => $id,
                'asal_surat' => $data['asalsurat'],
                'keterangan' => $data['keterangan'],
                'lokasi_arsip' => $data['lokasiarsip'],
                'isi_ringkas' => $data['isiringkas']
            );
        } else if ($data['tipesurat'] === 'disposisi') {
            $id = $this->getIdRandom('disposisi', 20, 'DI');
            $tabel = 'disposisi';
            $value = array(
                'id_disposisi' => $id,
                'dituju' => $data['asalsurat'],
                'pengirim' => $data['lokasiarsip'],
                'isi_disposisi' => $data['isiringkas'],
                'perihal' => $data['perihal'],
                'no_agenda' => $data['noagenda']
            );
        } else {
            $id = $this->getIdRandom('suratkeluar', 20, 'SK');
            $tabel = 'surat_keluar';
            $value = array(
                'id_suratkeluar' => $id,
                'surat_dikirim' => $data['asalsurat'],
                'keterangan' => $data['keterangan'],
                'lokasi_arsip' => $data['lokasiarsip'],
                'isi_ringkas' => $data['isiringkas']
            );
        }
        $date = date('Y-m-d H:i:s');
        $value += array(
            //'klasifikasi' => $data['desckode'],
            'id_dokumen' => $data['id_dokumen'],
            'id_kode' => $data['klasifikasi'],
            'id_upload' => 'ADM0000000',
            'tgl_pembuatan' => $this->FixDatePicker($data['tglpembuatansurat']),
            'tgl_penerimaan' => $this->FixDatePicker($data['tglpenerimaansurat']),
            'create_time' => $date,
            'update_time' => $date
        );
        $this->createLog(5, "Membuat surat baru dengan ID Surat: " . $id);
        $this->db->insert($tabel, $value);
    }

    function getCountSurat()
    {
        $num_rows = $this->db->count_all_results('surat_masuk');
        $num_rows += $this->db->count_all_results('surat_keluar');
        return $num_rows;
    }

    function getDataTableSurat($data, $type)
    {
        $params = $data;

        if ($type === 'dp'){
            $type = 'disposisi';
        }
        else if ($type === 'sk'){
            $type = 'surat_keluar';
        }
        else{
            $type = 'surat_masuk';
        }
        $query = $this->querySurat('datatables', $params, $type);
        //print_r($query);
        //$query2 = $this->querySurat('datatables', $params, 'surat_keluar');
        $queryFilter = $this->querySurat('datatables', $params, $type, true);
        //$queryFilter2 = $this->querySurat('datatables', $params, 'surat_keluar', true);
        $queryAll = $this->querySurat('all', $params, $type);
        //$queryAll2 = $this->querySurat('all', $params, 'surat_keluar');
        //foreach ($query->result() as $row) {
        //     $value[] = $row;
        // }
        //foreach ($query2->result() as $row) {
        //    $value[] = $row;
        //}

        $totalFilter = sizeof($queryFilter);
        //$totalFilter += $queryFilter2->num_rows();
        $total = $queryAll->num_rows();
        //$total += $queryAll2->num_rows();
        $result = array('total' => $total, 'data' => $query, 'totalFilter' => $totalFilter);
        return $result;
    }

    function querySurat($type = 'all', $params, $typesurat, $filter = false)
    {
        $config = array(
            'limitmax' => 60
        );
        $this->db->join('kode', 'kode.id_kode = ' . $typesurat . '.id_kode');

        if ($type === 'datatables') {
            $column2 = '.keterangan';
            if ($typesurat==='dp'){
                $column2= '.perihal';
            }
            $order_field = $params['order'][0]['column'];
            $order_type = $params['order'][0]['dir'];
            $columns = array(
                0 => $typesurat . '.id_kode',
                1 => $typesurat . $column2,
                2 => $typesurat . '.tgl_penerimaan',
                3 => 'kode.nama'
            );
            if (!empty($params['search']['value'])) {
                $this->db->like($columns[1], $params['search']['value']);
                $this->db->or_like($columns[0], $params['search']['value']);
                $this->db->or_like($columns[3], $params['search']['value']);
            }

            if (!$filter) {
                if (!empty($params['start']))
                    $start = $params['start'];
                else
                    $start = 0;

                if (!empty($params['length']) && $params['length'] <= $config['limitmax']) {
                    $limit = $params['length'];
                } else {
                    $limit = 20;
                }
                $this->db->limit($limit, $start);
            }
            if ($order_field<3){
                $this->db->order_by($typesurat . "." . $params['columns'][$order_field]['data'], $order_type);
            }

            $query = $this->db->get($typesurat);
            $data = array();
            $a = 0;
            $data = $query->result_array();
            foreach ($data as $i) {
                $i['klasifikasi'] = $this->get_desckode($i['id_kode']);
                $data[$a] = $i;
                $a++;
            }
            if ($order_field==='3'){
                $columns = array_column($data,'klasifikasi');
                if ($order_type === 'asc')
                   array_multisort($columns,SORT_ASC,$data);
                else
                    array_multisort($columns,SORT_DESC,$data);
            }
            return $data;
        } else {
            $query = $this->db->get($typesurat);
            return $query;
        }
    }

    function get_desckode($kode)
    {
        if (!is_array($kode))
            $kode = explode(".", $kode);

            $this->db->where("id_kode", $kode[0] . ".0.0.0");
            $query = $this->db->get('kode')->row(0);
            $result = $query->nama;
            $this->db->reset_query();
        if ($kode[1] !== "0") {
            $result .= " / ";
            $temp = array_slice($kode,0,2);
            $temp = implode(".",$temp);
            $this->db->where("id_kode", $temp. ".0.0");
            $query = $this->db->get('kode')->row(0);
            $result .= $query->nama;
            $this->db->reset_query();
        }
        if ($kode[2] !== "0") {
            $result .= " / ";
            $temp = array_slice($kode,0,3);
            $temp = implode(".",$temp);
            $this->db->where("id_kode", $temp. ".0");
            $query = $this->db->get('kode')->row(0);
            $result .= $query->nama;
            $this->db->reset_query();
        }
        if ($kode[3] !== "0") {
            $result .= " / ";
            $temp = array_slice($kode,0,4);
            $temp = implode(".",$temp);
            $this->db->where("id_kode", $temp);
            $query = $this->db->get('kode')->row(0);
            $result .= $query->nama;
            $this->db->reset_query();
        }

        return $result;
    }
}
