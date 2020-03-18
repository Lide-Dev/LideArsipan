<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_DataUser extends MY_Controller
{

    public function index()
    {
        $data = $this->initConfig("adm_datauser", "Data User", false);
        $config = array(
            "dialog_center" => true,
            "id" => array(
                "modal" => "modaladm",
                "form" => "formadm"
            ),
            "load" => "admin_datauser/modalduser",
            "text" => array(
                "ok" => "Go",
                "cancel" => "Cancel"
            ),
            "show" => array(
                "form" => true
            )
        );
        $data['modal'] = $this->initModal($config);
        $this->load->model("model_login", "mdl");
        $data['tablerow'] = $this->mdl->getCountLogin();
        $this->initView("admin_datauser/index", $data, true, false, true);
    }

    public function addAccount()
    {
        $this->load->model('model_datapengguna', 'mdp');
        $config = array(
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'required',
                'min_length' => 8,
                'errors' => array(
                    'required' => 'Password perlu di isi!',
                    'min_length' => 'Password harus lebih dari 8 karakter!'
                ),
            ),
            array(
                'field' => 'nip',
                'label' => 'NIP',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'NIP perlu di isi!'
                )
            ),

            array(
                'field' => 'tgllahir',
                'label' => 'Tanggal Lahir',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Tanggal Lahir perlu di isi!'
                )

            ),
        );
        $this->form_validation->set_rules($config);
        if ($this->form_validation->run() == FALSE)
        {
            $data['valid']=false;
            $data['message']='Terdapat kesalahan pada penginputan data. Mohon di perhatikan kembali';
            $data['return']=$this->input->post('',true);
            echo json_encode($data);
        }
        else
        {
            $valid = $this->mdp->getAccountDataWhere($this->input->post('',true));
            if ($valid){
                $this->mdp->addNewAccount($this->input->post('',true));
                $data['valid']=true;
                $data['message']='Akun telah dibuat!';
                echo json_encode($data);
            }
            else{
                $data['valid']=false;
                $data['message']='Username atau email telah digunakan';
                $data['return']=$this->input->post('',true);
                echo json_encode($data);
            }
        }

    }

    //---------------------------AJAX REQUEST----------------------------------------------

    public function getEditDataUser()
    {
        //if (!$this->input->is_ajax_request()) exit("Unknown Address (401)");

        $this->load->model("model_login", "mdl");
        echo json_encode($this->mdl->getDataUser($this->input->post("iduser", true)));
    }

    public function setClickButton()
    {
        //if (!$this->input->is_ajax_request()) exit("Unknown Address (401)");
        $request = $this->input->post("request", true);
        $this->session->set_flashdata("requestform", $request);
        echo $this->session->flashdata("requestform");
    }

    public function getViewModal()
    {
        //AJAX View Modal
        //if (!$this->input->is_ajax_request()) exit("Unknown Address (401)");

        if ($this->session->flashdata('requestform') === "new") {
            $this->load->model("model_datapengguna", "mdp");
            $option = $this->mdp->getJabatanAll();
            $view = array();
            $view["jabatan"] = "";
            foreach ($option as $row) {
                $view['jabatan'] .= "<option value='{$row->id_jabatan}'>{$row->nama}</option>";
            }
            $load = $this->load->view("admin_datauser/formnew", $view, true);
            echo $load;
        }
        else if ($this->session->flashdata('requestform') === "pss") {
            $load = $this->load->view("admin_datauser/formpassword","", true);
        }
        else {
            $load = $this->load->view("admin_datauser/formedit", "", true);
            echo $load;
        }
    }

    function getCountAjax()
    {
        $this->load->model("model_login", "mdl");
        $tablerow = $this->mdl->getCountLogin();
        echo $tablerow;
    }

    public function getTable()
    {
        $this->load->model("model_login", "mdl");
        $result = $this->mdl->getDataLogin($this->input->post(null, true));

        $callback = array(
            'draw' =>  $this->input->post('draw', true),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['totalFilter'],
            'data' => $result['data']
        );
        header('Content-Type: application/json');
        echo json_encode($callback);
    }

}
