<?php
class Model_Role extends MY_Model {

    function getRole($id_jabatan)
    {
        $this->db->join('role b','a.id_role = b.id_role');
        $this->db->where('id_jabatan',$id_jabatan);
        $query=$this->db->get('jabatan a');
        return $query->row();
    }


}

?>