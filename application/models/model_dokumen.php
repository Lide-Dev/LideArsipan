<?php
class Model_Dokumen extends CI_Model
{

    function cekIdAvailable($id)
    {
        $this->db->where('id_dokumen', $id);
        $num_rows = $this->db->count_all_results('dokumen');
        if($num_rows>0){
            return true;
        }
        else{
            return false;
        }

    }

    function getIdRandom()
    {
        $id = bin2hex(random_bytes(18));
        $result=true;
        while ($result) {
            $result = $this->cekIdAvailable($id);
            if ($result){
                $id = bin2hex(random_bytes(18));
            }
            else{
                break;
            }
        }
        return "DK".$id;

    }

    /**
     * Fungsi untuk menambahkan dokumen ke database
     *
     * @param array $data
     * Harus berisi data upload dari form. Contoh terdapat pada fungsi UploadDoc()
     *
     * @return string
     * Pengembalian berupa ID Dokumen.
     */
    function TambahDokumen($data)
    {
        $id = $this->getIdRandom();
        $value = array(
            'id_dokumen' => $id,
            'nama' => $data['raw_name'],
            'ekstensi' => $data['file_ext'],
            'byte_file' => $data['file_size'],
        );
        $this->db->insert('dokumen', $value);
        return $id;
    }
}
