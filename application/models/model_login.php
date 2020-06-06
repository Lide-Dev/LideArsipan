<?php
class Model_Login extends MY_Model
{

    //-----------------------------------------------------------------------------
    function getCountLogin()
    {
        $num_rows = $this->db->count_all_results('userlogin');
        return $num_rows;
    }

    function queryLogin($type = 'all', $params, $filter = false)
    {
        $config = array(
            'limitmax' => 60
        );

        if ($type === 'datatables') {
            $this->db->select('u.id_user , u.email , u.username');
            $this->db->from('userlogin as u');
            $order_field = $params['order'][0]['column'];
            $order_type = $params['order'][0]['dir'];
            $columns = array(
                0 => 'u.id_user',
                1 => 'u.email',
                2 => 'u.username',
            );
            if (!empty($params['search']['value'])) {
                $this->db->like($columns[1], $params['search']['value']);
                $this->db->or_like($columns[0], $params['search']['value']);
                $this->db->or_like($columns[2], $params['search']['value']);
            }

            if (!$filter) {
                if (!empty($params['start']))
                    $start = $params['start'];
                else
                    $start = 0;

                if (!empty($params['length']) && $params['length'] <= $config['limitmax']) {
                    $limit = $params['length'];
                } else {
                    $limit = 20;
                }
                $this->db->limit($limit, $start);
            }
            $this->db->order_by($params['columns'][$order_field]['data'], $order_type);
            $query = $this->db->get();
            /*foreach($query->result() as $row){
            unset($row->password);
            }*/
            return $query;
        } else {
            $query = $this->db->get('userlogin');
            //$this->db->join('banakun as b', 'banakun.id_user = userlogin.id_user','left');
            /*foreach($query->result() as $row){
                unset($row->password);
                }*/
            return $query;
        }
    }

    function queryBanLogin($type = 'all', $params, $filter = false)
    {
        $config = array(
            'limitmax' => 60
        );

        if ($type === 'datatables') {
            $this->db->select('u.id_user , u.email , u.username , b.finish_date');
            $this->db->from('userlogin as u');
            $order_field = $params['order'][0]['column'];
            $order_type = $params['order'][0]['dir'];
            $columns = array(
                0 => 'u.id_user',
                1 => 'u.email',
                2 => 'u.username',
            );
            if (!empty($params['search']['value'])) {
                $this->db->like($columns[1], $params['search']['value']);
                $this->db->or_like($columns[0], $params['search']['value']);
                $this->db->or_like($columns[3], $params['search']['value']);
            }

            if (!$filter) {
                if (!empty($params['start']))
                    $start = $params['start'];
                else
                    $start = 0;

                if (!empty($params['length']) && $params['length'] <= $config['limitmax']) {
                    $limit = $params['length'];
                } else {
                    $limit = 10;
                }
                $this->db->limit($limit, $start);
            }
            $date = date("Y-m-d");
            $this->db->order_by($params['columns'][$order_field]['data'], $order_type);
            $this->db->join('banakun as b', 'b.id_user = u.id_user');
            $this->db->where('b.finish_date >',$date);
            $query = $this->db->get();
            /*foreach($query->result() as $row){
            unset($row->password);
            }*/
            return $query;
        } else {
            $this->db->join('banakun as b', 'b.id_user = userlogin.id_user');
            $query = $this->db->get('userlogin');
            //$this->db->join('banakun as b', 'banakun.id_user = userlogin.id_user','left');
            /*foreach($query->result() as $row){
                unset($row->password);
                }*/
            return $query;
        }
    }

    function getDataLogin($data,$mode)
    {
        $value = array();
        $params = $data;

        if ($mode==='normal'){
        $query = $this->queryLogin('datatables', $params);
        $queryFilter = $this->queryLogin('datatables', $params, true);
        $queryAll = $this->queryLogin('all', $params);
        }
        if ($mode==='ban'){
            $query = $this->queryBanLogin('datatables', $params);
            $queryFilter = $this->queryBanLogin('datatables', $params, true);
            $queryAll = $this->queryBanLogin('all', $params);
        }
        foreach ($query->result() as $row) {
            $value[] = $row;
        }

        $totalFilter = $queryFilter->num_rows();
        $total = $queryAll->num_rows();
        $result = array('total' => $total, 'data' => $value, 'totalFilter' => $totalFilter);
        return $result;
    }

    //-----------------------------------------------------------------------------

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
                $type = $row->tipe;
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
                $value['type'] = $type;
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

    //-------------------------------------------------------------------------

    function getDataUser($id)
    {
        $this->db->where("id_user", $id, true);
        $single = $this->db->get("userlogin");
        $row = $single->row();
        unset($row->password);
        return $row;
    }

    function validIDData($id)
    {
        $this->db->where("id_user", $id, true);
        $num_rows = $this->db->count_all_results('userlogin');
        return $num_rows;
    }

    function updateDataLogin($id, $data,$iduser)
    {
        $date = date("Y-m-d H:i:s");
        if (empty($data['email'])) {
            $data['email'] = 'undefined';
        }
        $data = array(
            'username' => $data['username'],
            'email' => $data['email'],
            'update_time' => $date
        );

        $this->db->where('id_user', $id);
        $this->db->update('userlogin', $data);

        $desclog = "(ID_User => {$id} , Email => {$data['email']} , Username => {$data['username']} , ID_TriggerUser => {$iduser})";
        $this->createLog("003",$desclog);
    }

    function banAccount($id, $data, $iduser)
    {
        $id2 = $this->getIdRandom(null,10,'BA');
        $date = date("Y-m-d H:i:s");
        switch ($data['date']) {
            case 1:
                $date2 = strtotime("+1 week", strtotime($date));
                break;
            case 2:
                $date2 = strtotime("+1 month", strtotime($date));
                break;
            case 3:
                $date2 = strtotime("+6 month", strtotime($date));
                break;
            case 4:
                $date2 = strtotime("+1 year", strtotime($date));
                break;
            case 5:
                $date2 = strtotime("+10 year", strtotime($date));
            break;
        }


        $date2 = date("Y-m-d H:i:s", $date2);
        $value = array(
            'id_ban' => $id2,
            'id_user' => $id,
            'alasan' => $data['desc'],
            'start_date' => $date,
            'finish_date' => $date2
        );
        $this->db->insert('banakun', $value);

        $desclog = "(ID_Ban => {$id2} , ID_User => {$id} , ID_TriggerUser => {$iduser})";
        $this->createLog("009",$desclog);
    }

    function unbanAccount($id,$iduser){
        $date = date("Y-m-d H:i:s");
        $date2 = strtotime("-2 day", strtotime($date));
        $date2 = date("Y-m-d H:i:s", $date2);

        $this->db->where('id_user',$id);
        $query=$this->db->get('banakun')->row_array();

        $this->db->where('id_user',$id);
        $this->db->update('banakun', array('finish_date' => $date2));
        $desclog = "(ID_Ban => {$query['id_ban']} , ID_User => {$id} , ID_TriggerUser => {$iduser})";
        $this->createLog("010",$desclog);
    }

    function validBan($id){
        $this->db->where('id_user',$id);
        $single = $this->db->get('banakun');
        return $single->row();
    }
}
