<?php
class Model_Kode extends CI_Model{

    function search_kategori($title){
        $this->db->like('id_kode','0.0.0','before');
        $this->db->like('nama', $title , 'both');
        $this->db->order_by('nama', 'ASC');
        $this->db->limit(10);
        return $this->db->get('kode')->result();
    }

    function search_kode($title,$kode){
        if ($kode[0]==='160'){
            $this->db->where('id_kode >','160.0.0.0');
            $this->db->where('id_kode <','162.0.0.0');
            //print_r($result);
        }
        else{
            $this->db->like('id_kode','0.0','before');
            $this->db->like('id_kode',$kode[0],'after');
        }
        $this->db->like('nama', $title , 'both');
        $this->db->order_by('nama', 'ASC');
        $this->db->limit(10);
        //echo "<br><br>";
        //print_r($result);
        return $this->db->get('kode')->result();;
    }

    function search_subkode1($title,$kode){
        $this->db->like('id_kode',$kode[0].$kode[1],'after');
        $this->db->like('id_kode','0','before');
        $this->db->like('nama', $title , 'both');
        $this->db->order_by('nama', 'ASC');
        $this->db->limit(10);
        return $this->db->get('kode')->result();
    }

 
}