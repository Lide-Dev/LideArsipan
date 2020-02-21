<?php

class Model_DataPengguna extends CI_Model
{

    function CheckEmail($id,$email)
    {
        $this->db->where('id_datapengguna',$id);
        $query = $this->db->get('datapengguna');
        $result=$query->row();
        if ($result->email===$email)
        return true;
        else
        return false;
    }
}
?>