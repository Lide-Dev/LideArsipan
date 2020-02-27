<?php
class Model_Login extends MY_Model
{

    function validateLogin($isemail, $data, $pass)
    {
        if ($isemail) {
            $this->db->where('email', $data);
            $count = $this->db->count_all_results('userlogin');
            if (empty($count)) {
                $id = 'undefined';
            } else {
                $this->db->where('email', $data);
                $query = $this->db->get('userlogin');
                $row = $query->row();
                $id = $row->id_user;
                $hash = $row->password;
            }
        } else {
            $this->db->where('username', $data);
            $count = $this->db->count_all_results('userlogin');
            if (empty($count)) {
                $id = "undefined";
            } else {
                $this->db->where('username', $data);
                $query = $this->db->get('userlogin');
                $row = $query->row();
                $id = $row->id_user;
                $hash = $row->password;
            }
        }
        if ($id === 'undefined') {
            $value['valid'] = false;
            return $value;
        } else {
            if (password_verify($pass, $hash)) {
                $value['valid'] = true;
                $value['id'] = $id;
                return $value;
            }
        }
    }

    function cekLinkCP($idlink)
    {
        $idpass = substr($idlink, 0, 10);
        $kodeganti = substr($idlink, 10, 30);
        $this->db->where('id_lupapass', $idpass);
        $this->db->where('kodeganti', $kodeganti);
        $row = $this->db->count_all_results('lupapass');
        if ($row > 0) {
            return true;
        } else {
            return false;
        }
    }
}
