<?php
class Model_Surat extends MY_Model
{
    function GetSuratbyID($id, $type)
    {
        if ($type === 'sm') {
            $table = 'surat_masuk';
            $type = 'suratmasuk';
        } else if ($type === 'sk') {
            $table = 'surat_keluar';
            $type = 'suratkeluar';
        } else {
            $table = 'disposisi';
            $type = 'disposisi';
        }
        $this->db->where('id_' . $type, $id);
        $query = $this->db->get($table);

        return $query->row_array();
    }

    function DeleteTempSuratbyID($id, $type, $iduser)
    {
        if ($type === 'sm') {
            $table = 'surat_masuk';
            $type = 'suratmasuk';
        } else if ($type === 'sk') {
            $table = 'surat_keluar';
            $type = 'suratkeluar';
        } else {
            $table = 'disposisi';
            $type = 'disposisi';
        }
        $this->db->where('id_' . $type, $id);
        $this->db->set('sampah', 1);
        $this->db->update($table);
        $desclog = "Temporary Delete Surat {$table} ( ID_Surat => {$id} , ID_TriggerUser => {$iduser})";
        $this->createLog('012', $desclog);
    }

    function DeletePermSuratbyID($id, $type, $iduser)
    {
        if ($type === 'sm') {
            $table = 'surat_masuk';
            $type = 'suratmasuk';
        } else if ($type === 'sk') {
            $table = 'surat_keluar';
            $type = 'suratkeluar';
        } else {
            $table = 'disposisi';
            $type = 'disposisi';
        }
        $desclog = "Delete Surat {$table} ( ID_Surat => {$id} , ID_TriggerUser => {$iduser})";
        $this->db->where('id_' . $type, $id);
        $this->db->delete($table);
        $this->createLog("007",$desclog);
    }

    function EditSuratbyID($id, $type, $data, $iduser)
    {
        if ($type === 'sm') {
            $table = 'surat_masuk';
            $type = 'suratmasuk';
            $data = array(
                'no_surat' => $data['nosurat_'],
                'asal_surat' => $data['asalsurat_'],
                'isi_ringkas' => $data['isiringkas_'],
                'keterangan' => $data['keterangan_'],
                'lokasi_arsip' => $data['lokasiarsip_']
            );
        } else if ($type === 'sk') {
            $table = 'surat_keluar';
            $type = 'suratkeluar';
            $data = array(
                'no_surat' => $data['nosurat_'],
                'surat_dikirim' => $data['pengirim_'],
                'isi_ringkas' => $data['isiringkas_'],
                'keterangan' => $data['keterangan_'],
                'lokasi_arsip' => $data['lokasiarsip_']
            );
        } else {
            $table = 'disposisi';
            $type = 'disposisi';
            $data = array(
                'no_agenda' => $data['noagenda_'],
                'perihal' => $data['perihal_'],
                'dituju' => $data['dituju_'],
                'pengirim' => $data['pengirim_'],
                'isi_disposisi' => $data['isidisposisi_']
            );
        }

        $this->db->where('id_' . $type, $id);
        $this->db->update($table, $data);
        $desclog = "Edit Surat {$table} ( ID_Surat => {$id} , ID_TriggerUser => {$iduser})";
        $this->createLog("003",$desclog);
    }

    function EditSuratValidatebyID($id, $type, $data)
    {
        if ($type === 'sm') {
            $table = 'surat_masuk';
            $type = 'suratmasuk';
            $data = array(
                'no_surat' => $data['nosurat_'],
                'asal_surat' => $data['asalsurat_'],
                'isi_ringkas' => $data['isiringkas_'],
                'keterangan' => $data['keterangan_'],
                'lokasi_arsip' => $data['lokasiarsip_']
            );
        } else if ($type === 'sk') {
            $table = 'surat_keluar';
            $type = 'suratkeluar';
            $data = array(
                'no_surat' => $data['nosurat_'],
                'surat_dikirim' => $data['pengirim_'],
                'isi_ringkas' => $data['isiringkas_'],
                'keterangan' => $data['keterangan_'],
                'lokasi_arsip' => $data['lokasiarsip_']
            );
        } else {
            $table = 'disposisi';
            $type = 'disposisi';
            $data = array(
                'no_agenda' => $data['noagenda_'],
                'perihal' => $data['perihal_'],
                'dituju' => $data['dituju_'],
                'pengirim' => $data['pengirim_'],
                'isi_disposisi' => $data['isidisposisi_']
            );
        }
        $column = array_keys($data);
        $muchkey = sizeof($data);
        $this->db->select(implode(', ', $column));
        $this->db->where('id_' . $type, $id);
        $query = $this->db->get($table);
        $real = $query->row_array();
        $changes = array();
        for ($i = 0; $i < $muchkey; $i++) {
            if ($data[$column[$i]] === $real[$column[$i]] || (empty($data[$column[$i]]) && empty($data[$column[$i]]))) {
                $changes[$i] = false;
            } else {
                $changes[$i] = true;
            }
        }
        $return = array('changes' => $changes, 'size' => $muchkey);
        return $return;
    }

    function FixDatePicker($data)
    {
        $data = explode("/", $data);
        $data = "{$data[2]}-{$data[1]}-{$data[0]}";
        return $data;
    }

    function TambahSurat($data, $iduser)
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
                'isi_ringkas' => $data['isiringkas'],
                'no_surat' => $data['nosurat']
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
                'isi_ringkas' => $data['isiringkas'],
                'no_surat' => $data['nosurat']
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
        $this->createLog(5, "Create New Surat {$tabel} ( ID_Surat => {$id} , ID_TriggerUser => {$iduser} )");
        $this->db->insert($tabel, $value);
    }

    function getCountSurat($type = null)
    {
        if ($type === 'dp') {
            $num_rows = $this->db->count_all_results('disposisi');
        }
        else if ($type === 'sm'){
            $num_rows = $this->db->count_all_results('surat_masuk');
        }
        else if ($type === 'sk' ){
            $num_rows = $this->db->count_all_results('surat_keluar');
        }
        else{
            $num_rows = $this->db->count_all_results('surat_masuk');
            $num_rows += $this->db->count_all_results('surat_keluar');
            $num_rows += $this->db->count_all_results('disposisi');
        }
        return $num_rows;
    }

    function getDataTableSurat($data, $type)
    {
        $params = $data;

        if ($type === 'dp') {
            $type = 'disposisi';
        } else if ($type === 'sk') {
            $type = 'surat_keluar';
        } else {
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
        $this->db->where('sampah', 0);
        if ($type === 'datatables') {
            $column2 = '.keterangan';
            if ($typesurat === 'dp') {
                $column2 = '.perihal';
            }
            $order_field = $params['order'][0]['column'];
            $order_type = $params['order'][0]['dir'];
            $columns = array(
                0 => $typesurat . '.id_kode',
                1 => 'kode.nama',
                2 => $typesurat . '.tgl_penerimaan',
                3 =>  $typesurat . $column2
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
            if ($order_field !== '1') {
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
            if ($order_field === '1') {
                $columns = array_column($data, 'klasifikasi');
                if ($order_type === 'asc')
                    array_multisort($columns, SORT_ASC, $data);
                else
                    array_multisort($columns, SORT_DESC, $data);
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
            $temp = array_slice($kode, 0, 2);
            $temp = implode(".", $temp);
            $this->db->where("id_kode", $temp . ".0.0");
            $query = $this->db->get('kode')->row(0);
            $result .= $query->nama;
            $this->db->reset_query();
        }
        if ($kode[2] !== "0") {
            $result .= " / ";
            $temp = array_slice($kode, 0, 3);
            $temp = implode(".", $temp);
            $this->db->where("id_kode", $temp . ".0");
            $query = $this->db->get('kode')->row(0);
            $result .= $query->nama;
            $this->db->reset_query();
        }
        if ($kode[3] !== "0") {
            $result .= " / ";
            $temp = array_slice($kode, 0, 4);
            $temp = implode(".", $temp);
            $this->db->where("id_kode", $temp);
            $query = $this->db->get('kode')->row(0);
            $result .= $query->nama;
            $this->db->reset_query();
        }

        return $result;
    }
}
