<?php

class Model_DataPengguna extends MY_Model
{

    function CheckEmail($email)
    {
        $this->db->where('email',$email);
        $query = $this->db->get('datapengguna');
        $result =$query->row("email");
        $result2 =$query->row("id_user");
        if ($email===$result){
        $this->createLog(4,"Mengganti Password untuk ID User: {$result2}");
        return true;
        }
        else
        return false;
    }


}
?>