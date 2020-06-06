<?php
class Model_Dokumen extends MY_Model
{



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
        $id = $this->getIdRandom('dokumen', 20, 'DK');
        $value = array(
            'id_dokumen' => $id,
            'nama' => $data['raw_name'],
            'ekstensi' => $data['file_ext'],
            'byte_file' => $data['file_size'],
        );
        $this->db->insert('dokumen', $value);
        return $id;
    }

    function GetDokumenbyID($id)
    {
        $this->db->where('id_dokumen', $id);
        $query = $this->db->get('dokumen');

        return $query->row_array();
    }

    function GetByteFile()
    {

        $this->db->select('byte_file');
        $query = $this->db->get('dokumen');
        return $query->result_array();
    }

    function GetByteFileArsip($sampah = false)
    {
        $sampah ? $sampah=1 : $sampah=0;
        $this->db->escape($sampah);
        $select = 'a.sampah, a.id_dokumen , b.byte_file';
        $table = "SELECT sampah, id_dokumen from surat_masuk where sampah={$sampah}
        UNION ALL
        SELECT sampah, id_dokumen from surat_keluar where sampah={$sampah}
        UNION ALL
        SELECT sampah, id_dokumen from disposisi where sampah={$sampah}";
        $join = 'dokumen b on a.id_dokumen = b.id_dokumen';

        
        $query =$this->db->query('SELECT '.$select.' FROM ('.$table.') a JOIN '. $join);
        $arr =  $query->result_array();
        $sum = 0;
        foreach($arr as $a){
            $sum += floatval($a['byte_file']);
        }
        return $sum;

    }

    function DeleteDokumenbyID($id)
    {
        $this->db->where('id_dokumen', $id);
        $this->db->delete('dokumen');
    }
}
