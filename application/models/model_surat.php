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

    function GetSuratbyGroup($group,$surat,$chart=false)
    {
        $this->db->select("count(*) as count , (UNIX_TIMESTAMP(create_time)) as create_time"); //
        $this->db->from($surat);
        $this->db->where("create_time >=", " date_sub(curdate(), interval 7 day)");
       // $this->db->order_by("create_time","DESC");
        $query = $this->db->get_compiled_select();
        $query .= " group by ".$group. " order by create_time ASC ";
        $result = $this->db->query($query);
        print_r($result->result_array());
        return $result->result_array();

    }

    function DeleteTempSuratbyID($id, $type, $iduser)
    {
        $date = date("Y-m-d H:i:s");
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
        $this->db->set('update_time', $date);
        $this->db->update($table);
        $desclog = "Temporary Delete Surat {$table} ( ID_Surat => {$id} , ID_TriggerUser => {$iduser}, Date => {$date})";
        $this->createLog('012', $desclog);
    }

    function RecoverSuratbyID($id, $type, $iduser)
    {
        $date = date("Y-m-d H:i:s");
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
        $this->db->set('sampah', 0);
        $this->db->set('update_time', $date);
        $this->db->update($table);
        $desclog = "Recover Surat {$table} ( ID_Surat => {$id} , ID_TriggerUser => {$iduser}, Date => {$date})";
        $this->createLog('002', $desclog);
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
        $this->createLog("007", $desclog);
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
        $this->createLog("003", $desclog);
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
            'id_upload' => $iduser,
            'tgl_pembuatan' => $this->FixDatePicker($data['tglpembuatansurat']),
            'tgl_penerimaan' => $this->FixDatePicker($data['tglpenerimaansurat']),
            'create_time' => $date,
            'update_time' => $date
        );
        $this->createLog(5, "Create New Surat {$tabel} ( ID_Surat => {$id} , ID_TriggerUser => {$iduser} )");
        $this->db->insert($tabel, $value);
    }

    function getCountSurat($type = null,$sampah=false)
    {
        if ($type === 'dp') {
            $this->db->where('sampah',0);
            $num_rows = $this->db->count_all_results('disposisi');
        } else if ($type === 'sm') {
            $this->db->where('sampah',0);
            $num_rows = $this->db->count_all_results('surat_masuk');
        } else if ($type === 'sk') {
            $this->db->where('sampah',0);
            $num_rows = $this->db->count_all_results('surat_keluar');
        } else if ($sampah){
            $this->db->where('sampah',1);
            $num_rows = $this->db->count_all_results('surat_masuk');
            $this->db->where('sampah',1);
            $num_rows += $this->db->count_all_results('surat_keluar');
            $this->db->where('sampah',1);
            $num_rows += $this->db->count_all_results('disposisi');
        } else {
            $this->db->where('sampah',0);
            $num_rows = $this->db->count_all_results('surat_masuk');
            $this->db->where('sampah',0);
            $num_rows += $this->db->count_all_results('surat_keluar');
            $this->db->where('sampah',0);
            $num_rows += $this->db->count_all_results('disposisi');

        }
        return $num_rows;
    }

    function getDataTableSurat($data, $type = null, $sampah = false)
    {
        $params = $data;
        if ($sampah) {
            $queryresult = $this->querySampah('datatables', $params);
            $queryFilter = $this->querySampah('datatables', $params, true);
            $queryAll = $this->querySampah('all', $params);
            $totalFilter = sizeof($queryFilter);
            $total = $queryAll->num_rows();
            $result = array('total' => $total, 'data' => $queryresult, 'totalFilter' => $totalFilter);
        } else {
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

            $totalFilter = sizeof($queryFilter);
            //$totalFilter += $queryFilter2->num_rows();
            $total = $queryAll->num_rows();
            //$total += $queryAll2->num_rows();
            $result = array('total' => $total, 'data' => $query, 'totalFilter' => $totalFilter);
        }
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
            if ($typesurat === 'disposisi') {
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
                    $limit = 10;
                }
                $this->db->limit($limit, $start);
            }
            if ($order_field !== '1') {
                $this->db->order_by($typesurat . "." . $params['columns'][$order_field]['data'], $order_type);
            } else {
                $this->db->order_by("kode." . $params['columns'][$order_field]['data'], $order_type);
            }

            $query = $this->db->get($typesurat);
            $data = array();
            // $a = 0;
            $data = $query->result_array();
            // foreach ($data as $i) {
            //     $i['klasifikasi'] = $this->get_desckode($i['id_kode']);
            //     $data[$a] = $i;
            //     $a++;
            // }
            // if ($order_field === '1') {
            //     $columns = array_column($data, 'klasifikasi');
            //     if ($order_type === 'asc')
            //         array_multisort($columns, SORT_ASC, $data);
            //     else
            //         array_multisort($columns, SORT_DESC, $data);
            // }
            return $data;
        } else {
            $query = $this->db->get($typesurat);
            return $query;
        }
    }

    function querySampah($type = 'all', $params, $filter = false)
    {
        $option = '';

        $this->db->select('id_suratmasuk as id, update_time');
        $this->db->from('surat_masuk');
        $this->db->where('sampah', 1);
        $query1 = $this->db->get_compiled_select();
        $this->db->select('id_suratkeluar as id, update_time');
        $this->db->from('surat_keluar');
        $this->db->where('sampah', 1);
        $query2 = $this->db->get_compiled_select();
        $this->db->select('id_disposisi as id, update_time');
        $this->db->from('disposisi');
        $this->db->where('sampah', 1);
        $query3 = $this->db->get_compiled_select();
        if ($type === 'datatables') {
            $order_field = $this->db->escape(intval($params['order'][0]['column']));
            $order_type = $this->db->escape_str($params['order'][0]['dir']);

            $columns = array(
                0 => 'id',
                1 => 'update_time'
            );
            if (!empty($params['search']['value'])) {
                $this->db->like($columns[1], $params['search']['value']);
                $this->db->or_like($columns[0], $params['search']['value']);
            }

            $ordercol = $this->db->escape_str($params['columns'][$order_field]['data']);
            if (!empty($ordercol)) {
                // $this->db->order_by($params['columns'][$order_field]['data'], $order_type);
                $option .= ' ORDER BY ' . $ordercol . ' ' . $order_type;
            }

            if (!$filter) {
                if (!empty($params['start'])) {
                    $start = $this->db->escape(intval($params['start']));
                } else
                    $start = 0;

                    $limit = 10;
                // if (!empty($params['length']) && $params['length'] <= $config['limitmax']) {
                //     $limit = 6;//$this->db->escape(intval($params['length']));
                // } else {
                //     $limit = 5;
                // }
                $option.=' LIMIT '.$start.' , '.$limit;
                //$this->db->limit($limit, $start);
            }

            //$xa=$query1. " UNION ALL " . $query2. " UNION ALL ". $query3. $option;
            $query = $this->db->query($query1 . " UNION ALL " . $query2 . " UNION ALL " . $query3 . $option);
            return $query->result();
        } else {
            $this->db->select('id_suratmasuk as id, update_time');
            $this->db->from('surat_masuk');
            $this->db->where('sampah', 1);
            $query1 = $this->db->get_compiled_select();
            $this->db->select('id_suratkeluar as id, update_time');
            $this->db->from('surat_keluar');
            $this->db->where('sampah', 1);
            $query2 = $this->db->get_compiled_select();
            $this->db->select('id_disposisi as id, update_time');
            $this->db->from('disposisi');
            $this->db->where('sampah', 1);
            $query3 = $this->db->get_compiled_select();
            $query = $this->db->query($query1 . " UNION ALL " . $query2 . " UNION ALL " . $query3);
            return $query;
        }
    }

    // function get_desckode($kode)
    // {
    //     if (!is_array($kode))
    //         $kode = explode(".", $kode);

    //     $this->db->where("id_kode", $kode[0] . ".0.0.0");
    //     $query = $this->db->get('kode')->row(0);
    //     $result = $query->nama;
    //     $this->db->reset_query();
    //     if ($kode[1] !== "0") {
    //         $result .= " / ";
    //         $temp = array_slice($kode, 0, 2);
    //         $temp = implode(".", $temp);
    //         $this->db->where("id_kode", $temp . ".0.0");
    //         $query = $this->db->get('kode')->row(0);
    //         $result .= $query->nama;
    //         $this->db->reset_query();
    //     }
    //     if ($kode[2] !== "0") {
    //         $result .= " / ";
    //         $temp = array_slice($kode, 0, 3);
    //         $temp = implode(".", $temp);
    //         $this->db->where("id_kode", $temp . ".0");
    //         $query = $this->db->get('kode')->row(0);
    //         $result .= $query->nama;
    //         $this->db->reset_query();
    //     }
    //     if ($kode[3] !== "0") {
    //         $result .= " / ";
    //         $temp = array_slice($kode, 0, 4);
    //         $temp = implode(".", $temp);
    //         $this->db->where("id_kode", $temp);
    //         $query = $this->db->get('kode')->row(0);
    //         $result .= $query->nama;
    //         $this->db->reset_query();
    //     }

    //     return $result;
    // }

    // function get_desckode($kode)
    // {
    //     $result ='';
    //     if (!is_array($kode))
    //         $kode = explode(".", $kode);

    //     if ($kode[3] !== "0") {
    //         $result .= ".../.../.../";
    //         $temp = array_slice($kode, 0, 4);
    //         $temp = implode(".", $temp);
    //         $this->db->where("id_kode", $temp);
    //         $query = $this->db->get('kode')->row(0);
    //         $result .= $query->nama;
    //         $this->db->reset_query();
    //     }
    //     else if ($kode[2] !== "0") {
    //         $result = ".../.../";
    //         $temp = array_slice($kode, 0, 3);
    //         $temp = implode(".", $temp);
    //         $this->db->where("id_kode", $temp . ".0");
    //         $query = $this->db->get('kode')->row(0);
    //         $result .= $query->nama;
    //         $this->db->reset_query();
    //     }
    //     else if ($kode[1] !== "0" &&$kode[0]==='180') {
    //         $result .= ".../";
    //         $temp = array_slice($kode, 0, 2);
    //         $temp = implode(".", $temp);
    //         $this->db->where("id_kode", $temp . ".0.0");
    //         $query = $this->db->get('kode')->row(0);
    //         $result .= $query->nama;
    //         $this->db->reset_query();
    //     }
    //     else{
    //         $this->db->where("id_kode", $kode[0] . ".0.0.0");
    //         $query = $this->db->get('kode')->row(0);
    //         $result = $query->nama;
    //         $this->db->reset_query();
    //     }

    //     return $result;
    // }
}
