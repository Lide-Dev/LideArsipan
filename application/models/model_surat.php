<?php
class Model_Surat extends CI_Model
{


    function FixDatePicker($data)
    {
        $data = explode("/", $data);
        $data = "{$data[2]}-{$data[1]}-{$data[0]}";
        return $data;
    }

    function cekIdAvailable($id, $tipe)
    {
        if ($tipe === 'suratmasuk') {
            $this->db->where('id_suratmasuk', $id);
            $num_rows = $this->db->count_all_results('surat_masuk');
        } else {
            $this->db->where('id_suratkeluar', $id);
            $num_rows = $this->db->count_all_results('surat_keluar');
        }
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    function getIdRandom($tipe)
    {
        $id = bin2hex(random_bytes(18));
        if ($tipe === 'suratmasuk')
            $uid = "SM";
        else
            $uid = "SK";
        $result = true;
        while ($result) {
            $result = $this->cekIdAvailable($id, $tipe);
            if ($result) {
                $id = bin2hex(random_bytes(18));
            } else {
                break;
            }
        }
        return $uid . $id;
    }

    function TambahSurat($data)
    {
        if (is_array($data['klasifikasi'])) {
            $data['klasifikasi'] = implode(".", $data['klasifikasi']);
        }

        $date = date("Y-m-d H:i:s");
        if ($data['tipesurat'] === 'suratmasuk') {
            $id = $this->getIdRandom('suratmasuk');
            $tabel = 'surat_masuk';
            $value = array(
                'id_suratmasuk' => $id,
                'asal_surat' => $data['asalsurat']
            );
        } else {
            $id = $this->getIdRandom('suratkeluar');
            $tabel = 'surat_keluar';
            $value = array(
                'id_suratkeluar' => $id,
                'surat_dikirim' => $data['asalsurat']
            );
        }
        $date = date('Y-m-d H:i:s');
        $value += array(
            'klasifikasi' => $data['desckode'],
            'id_dokumen' => $data['id_dokumen'],
            'id_kode' => $data['klasifikasi'],
            'id_upload' => 'ADM0000000',
            'lokasi_arsip' => $data['lokasiarsip'],
            'isi_ringkas' => $data['isiringkas'],
            'keterangan' => $data['keterangan'],
            'tgl_pembuatan' => $this->FixDatePicker($_POST['tglpembuatansurat']),
            'tgl_penerimaan' => $this->FixDatePicker($_POST['tglpenerimaansurat']),
            'create_time' => $date,
            'update_time' => $date
        );
        $this->db->insert($tabel, $value);
    }

    function getCountSurat()
    {
        $num_rows = $this->db->count_all_results('surat_masuk');
        $num_rows += $this->db->count_all_results('surat_keluar');
        return $num_rows;
    }

    function getDataTableSurat($data)
    {
        $value = array();
        $params = $data;

        $query = $this->querySurat('datatables', $params, 'surat_masuk');
        $query2 = $this->querySurat('datatables', $params, 'surat_keluar');
        $queryFilter = $this->querySurat('datatables', $params, 'surat_masuk', true);
        $queryFilter2 = $this->querySurat('datatables', $params, 'surat_keluar', true);
        $queryAll = $this->querySurat('all', $params, 'surat_masuk');
        $queryAll2 = $this->querySurat('all', $params, 'surat_keluar');
        foreach ($query->result() as $row) {
            $value[] = $row;
        }
        foreach ($query2->result() as $row) {
            $value[] = $row;
        }

        $totalFilter = $queryFilter->num_rows();
        $totalFilter += $queryFilter2->num_rows();
        $total = $queryAll->num_rows();
        $total += $queryAll2->num_rows();
        $result = array('total' => $total, 'data' => $value, 'totalFilter' => $totalFilter);
        return $result;
    }

    function querySurat($type = 'all', $params, $typesurat, $filter = false)
    {
        $config = array(
            'limitmax' => 60
        );

        if ($type === 'datatables') {
            $order_field = $_POST['order'][0]['column'];
            $order_type = $_POST['order'][0]['dir'];
            $columns = array(
                0 => 'id_kode',
                1 => 'keterangan',
                2 => 'tgl_penerimaan',
                3 => 'klasifikasi'
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

                if (!empty($params['length'])&&$params['length'] <= $config['limitmax']) {
                    $limit = $params['length'];
                } else {
                    $limit = 20;
                }
                $this->db->limit($limit,$start);
            }
            $this->db->order_by($params['columns'][$order_field]['data'], $order_type);

            $query = $this->db->get($typesurat);
            return $query;
        } else {
            $query = $this->db->get($typesurat);
            return $query;
        }
    }
}
