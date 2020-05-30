<?php

class Model_DataPengguna extends MY_Model
{
    function GetUserbyID($id,$column=null){
        $this->db->where("id_datapengguna",$id);
        if (!empty($column)){
            $this->db->select($column);
        }
        $query=$this->db->get('datapengguna');
        return $query->row();
    }

    function CheckEmail($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('userlogin');
        $result = $query->row("email");
        //$result2 =$query->row("id_user");
        if ($email === $result) {
            return true;
        } else
            return false;
    }

    function CreateCodePass($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('userlogin');
        $result = $query->row("id_user");

        $id = $this->getIdRandom('lupapass', 10);
        $kode = $this->getIdRandom(null, 30);
        $data = array(
            'id_lupapass' => $id,
            'kodeganti' => $kode,
            'id_user' => $result
        );
        $this->db->insert('lupapass', $data);

        $this->createLog(4, "Mengganti Password untuk ID User: {$result}");
        return $data;
    }

    function getJabatanAll()
    {
        $this->db->where("id_jabatan >", "JB000");
        $query = $this->db->get("jabatan");

        return $query->result();
    }

    function ValidateLogin($email)
    {
        $valid = $this->CheckEmail($email);

        if ($valid) {
            $this->db->where('email', $email);
            $query = $this->db->get('userlogin');
        }
    }

    function getAccountDataWhere($data, $boolreturn)
    {
        //print_r($data);
        $valid1 = $valid2 = false;
        if (!empty($data['email'])) {
            $email = $data['email'];
            $valid1 = true;
        }
        if (!empty($data['username'])) {
            $email = $data['username'];
            $valid2 = true;
        }
        if ((!$valid1 && !$valid2) && $boolreturn){

            return false;
        }
        else {

            $username = $data['username'];

            if ($valid1)
            $this->db->where('email', $email);
            if (!$valid1&&$valid2)
            $this->db->where('username', $username);
            if ($valid2)
            $this->db->or_where('username', $username);
            $query = $this->db->get('userlogin');
            if ($boolreturn) {
                if ($query->num_rows() > 0) {
                    return false;
                } else {
                    return true;
                }
            } else {
                return $query->result;
            }
        }
    }

    function addNewAccount($data,$id_user)
    {
        $id = $this->getIdRandom('userlogin',10,'USL');
        $id2 = $this->getIdRandom('datapengguna',10,'DP');
        if (empty($data['username']))
        $data['username']="undefined";
        if (empty($data['email']))
        $data['email']="undefined";

        $data['password']=password_hash($data['password'],PASSWORD_BCRYPT);

        $value1 = array(
            'id_user'=>$id,
            'username'=>$data['username'],
            'email'=>$data['email'],
            'password'=>$data['password'],
            'tipe'=>'user'

        );
        $this->db->insert('userlogin',$value1);

        if ($data['jeniskelamin']==='laki')
        {
            $gender = 'M';
        }
        else
        {
            $gender = 'F';
        }

        $maxjabatan = $this->db->get('jabatan')->num_rows();
        $maxjabatan -= 1;
        $numjabatan = substr($data['jabatan'],2);
        if (intval($numjabatan)<1||intval($numjabatan)>$maxjabatan){
            $data['jabatan']='JB009';
        }


        $value2 = array(
            'id_datapengguna'=>$id2,
            'nip'=>$data['nip'],
            'nama'=>$data['nama'],
            'tgl_lahir'=>$data['tgllahir'],
            'foto_profil'=>'undefined',
            'id_gender'=> $gender,
            'id_jabatan'=> $data['jabatan'],
            'id_user'=> $id
        );
        $this->db->insert('datapengguna',$value2);

        $c1 = array_keys($value1);
        $c2 = array_keys($value2);
        $d1 = $d2 = '';
        for ($i=0;$i<5;$i++){
            if ($i===3){
                continue;
            }
            if ($i===4){
                $d1 .= $c1[$i]." => ".$value1[$c1[$i]];
            }
            else{
                $d1 .= $c1[$i]." => ".$value1[$c1[$i]].", ";
            }
        }
        for ($i=0;$i<1;$i++){
            $d2 .= $c2[$i]." => ".$value2[$c2[$i]];
        }
        $desclog ='Login Data ( '.$d1.' ), User Data ( '.$d2.' ). ID_TriggerUser => '.$id_user;
        $this->createLog("001",$desclog);
    }
}
