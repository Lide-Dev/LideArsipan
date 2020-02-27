<?php

class Model_DataPengguna extends MY_Model
{

    function CheckEmail($email)
    {
        $this->db->where('email',$email);
        $query = $this->db->get('userlogin');
        $result =$query->row("email");
        //$result2 =$query->row("id_user");
        if ($email===$result){
        return true;
        }
        else
        return false;
    }

    function ValidateLogin($email){
        $valid = $this->CheckEmail($email);

        if ($valid){
            $this->db->where('email',$email);
            $query = $this->db->get('userlogin');

        }
    }

    function CreateCodePass($email){
        $this->db->where('email',$email);
        $query = $this->db->get('userlogin');
        $result =$query->row("id_user");

        $id = $this->getIdRandom('lupapass',10);
        $kode = $this->getIdRandom(null,30);
        $data = array(
            'id_lupapass' => $id,
            'kodeganti' => $kode,
            'id_user' => $result
        );
        $this->db->insert('lupapass',$data);

        $this->createLog(4,"Mengganti Password untuk ID User: {$result}");
        return $data;

    }


}
?>