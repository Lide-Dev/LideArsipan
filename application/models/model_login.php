<?php

class Model_Login extends MY_Model
{

    function getLoginIDWhere($email,$pass)
    {
        $this->db->where('email', $email);
        $count= $this->db->count_all_results('userlogin');
        if(empty($count)){
            return "undefined";
        }
        else{
        $this->db->where('email', $email);
        $query = $this->db->get('userlogin');
        $row=$query->row();
        $id = $row->id_user;
        return $id;
        }
    }
}
