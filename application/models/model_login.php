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
            $order_field = $params['order'][0]['column'];
            $order_type = $params['order'][0]['dir'];
            $columns = array(
                0 => 'id_user',
                1 => 'email',
                2 => 'username',
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

                if (!empty($params['length'])&&$params['length'] <= $config['limitmax']) {
                    $limit = $params['length'];
                } else {
                    $limit = 20;
                }
                $this->db->limit($limit,$start);
            }
            $this->db->order_by($params['columns'][$order_field]['data'], $order_type);

            $query = $this->db->get('userlogin');
            return $query;
        } else {
            $query = $this->db->get('userlogin');
            return $query;
        }
    }

    function getDataLogin($data){
        $value = array();
        $params = $data;

        $query = $this->queryLogin('datatables', $params);
        $queryFilter = $this->queryLogin('datatables', $params, true);
        $queryAll = $this->queryLogin('all', $params);
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
        $this->db->where("id_user",$id,true);
        $single=$this->db->get("userlogin")->row();
        return $single;
    }
}
