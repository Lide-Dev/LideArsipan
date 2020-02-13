<?php
class Model_Surat extends CI_Model
{
    function FixDatePicker($data)
    {
        $data = explode("/",$data);
        $data = "{$data[2]}-{$data[1]}-{$data[0]}";
        return $data;
    }

    function cekIdAvailable($id,$tipe)
    {
        if ($tipe === 'suratmasuk'){
        $this->db->where('id_suratmasuk', $id);
        $num_rows = $this->db->count_all_results('surat_masuk');
        }
        else{
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
        $uid="SM";
        else
        $uid="SK";
        $result = true;
        while ($result) {
            $result = $this->cekIdAvailable($id,$tipe);
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
        print_r($data);
        if (is_array($data['klasifikasi'])){
        $data['klasifikasi'] = implode(".",$data['klasifikasi']);
        }

        $date = date("Y-m-d H:i:s");
        if ($data['tipesurat'] === 'suratmasuk') {
            $id=$this->getIdRandom('suratmasuk');
            $tabel='surat_masuk';
            $value = array(
                'id_suratmasuk' => $id,
                'asal_surat' => $data['asalsurat']
            );
        } else {
            $id=$this->getIdRandom('suratkeluar');
            $tabel='surat_keluar';
            $value = array(
                'id_suratkeluar' => $id,
                'surat_dikirim' => $data['asalsurat']
            );
        }
        $value += array(
            'id_dokumen' => $data['id_dokumen'],
            'id_kode' => $data['klasifikasi'],
            'id_upload' => 'ADM0000000',
            'lokasi_arsip' => $data['lokasiarsip'],
            'isi_ringkas' => $data['isiringkas'],
            'keterangan' => $data['keterangan'],
            'tgl_pembuatan' => $this->FixDatePicker($_POST['tglpembuatansurat']),
            'tgl_penerimaan' => $this->FixDatePicker($_POST['tglpenerimaansurat']),
            'update_time' => $date
        );
        $this->db->insert($tabel, $value);
    }
}
