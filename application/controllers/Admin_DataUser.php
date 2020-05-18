<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_DataUser extends MY_Controller
{

    public function index()
    {
        $this->session->set_userdata('tablemode','normal');
        $data = $this->initConfig("adm_datauser", "Data User", false, true);
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


    //------ MAIN FUNCTION ------------------

    public function submitRequest()
    {
        $request = $this->session->tempdata('requestform');
        if ($request === 'new') {
            $this->addAccount();
        } else if ($request === 'edit') {
            $this->editAccount();
        } else if ($request === 'pss') {
            $this->editPassword();
        }
        else if($request === 'ban') {
            $this->banAccount();
        }
        else {
            $data['valid'] = false;
            $data['message'] = 'Session pada form ini habis! Silahkan ulang lagi.';
            $data['request'] = 'ssnexp';
            echo json_encode($data);
        }
    }

    public function addAccount()
    {
        $valid = $valid2 = $validname = $validemail = false;
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
        if ($this->form_validation->run() == FALSE) {
            $data['valid'] = false;
            $data['message'] = 'Terdapat kesalahan pada penginputan data. Mohon di perhatikan kembali';
            $data['return'] = $_POST;
            $data['request'] = 'new';
            echo json_encode($data);
        } else {
            if (!empty($_POST['username'])) {
                $validname = true;
            }
            if (!empty($_POST['email'])) {
                $validemail = true;
            }
            if ($validname && (!empty($_POST['username']) && strlen($_POST['username']) > 3))
                $validname = true;
            else
                $validname = false;
            if ($validemail && (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
                $validemail = true;
            else
                $validemail = false;

            if ($validname || $validemail) {
                $valid = true;
            } else {
                $valid = false;
            }

            if ($valid) {
                $valid2 = $this->mdp->getAccountDataWhere($_POST, true);
                if ($valid2) {
                    $this->mdp->addNewAccount($_POST, true);
                    $data['valid'] = true;
                    $data['message'] = 'Akun telah dibuat!';
                    $data['request'] = 'new';
                    echo json_encode($data);
                } else {
                    $data['valid'] = false;
                    $data['message'] = 'Username atau email telah digunakan';
                    $data['return'] = $_POST;
                    $data['request'] = 'new';
                    echo json_encode($data);
                }
            } else {
                $data['valid'] = false;
                $data['message'] = 'Terdapat kesalahan pada inputan Username & Email!';
                $data['return'] = $_POST;
                $data['request'] = 'new';
                echo json_encode($data);
            }
        }
    }

    public function editAccount()
    {
        $valid  = $validname = $validemail = false;
        if (empty($this->session->tempdata("iduser"))) {
            $data['valid'] = false;
            $data['message'] = 'Sesi pada pengeditan akun habis. Coba ulangi lagi!';
            $data['return'] = $_POST;
            $data['request'] = 'edit';
            echo json_encode($data);
        } else {
            $dataerror = '';
            $id = $this->session->tempdata('iduser');
            $this->load->model('model_login', 'mdl');
            $isAvailable = $this->mdl->validIDData($id);
            if (empty($_POST['cek_email'])) {
                $_POST['cek_email']=false;
                $_POST['email']='undefined';
            }
            if ($isAvailable > 0) {
                $isAvailable = true;
            } else {
                $isAvailable = false;
                $dataerror .= ' ID yang dipilih tidak ada. ';
            }

            if ($_POST['cek_email']) {
                if (!empty($_POST['email'])) {
                    $validemail = true;
                }
                if ($validemail && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
                    $validemail = true;
                else {
                    $validemail = false;
                    $dataerror .= 'Kesalahan format pada input data email. ';
                }
            }

            if (!empty($_POST['username'])) {
                $validname = true;
            }

            if ($validname && strlen($_POST['username']) > 3)
                $validname = true;
            else {
                $validname = false;
                $dataerror .= 'Kesalahan format pada input data username. ';
            }

            if($_POST['cek_email']){
                if ($isAvailable && $validname && $validemail) {
                    $valid = true;
                } else {
                    $valid = false;
                }

            }
            else{
                if ($isAvailable && $validname) {
                    $valid = true;
                } else {
                    $valid = false;
                }

            }

            if ($valid)
            {
                $this->mdl->updateDataLogin($id, $_POST);
                $data['valid'] = true;
                $data['message'] = 'Data akun berhasil di ubah!';
                $data['return'] = $_POST;
                $data['request'] = 'edit';
                echo json_encode($data);
            } else {
                $data['valid'] = false;
                $data['message'] = 'Terdapat kesalahan saat pengiriman form: ' . $dataerror;
                $data['return'] = $_POST;
                $data['request'] = 'edit';
                echo json_encode($data);
            }
        }
    }

    public function editPassword()
    {
        $data['valid'] = false;
        $data['message'] = 'menuju ke pass!';
        $data['return'] = $_POST;
        $data['request'] = 'new';
        echo json_encode($data);
    }

    public function banAccount()
    {
        $id = $this->session->tempdata('iduser');
        $this->load->model('model_login','mdl');
        $dataerror=''; $valid=true;
        $config= array(
            array(
                'field' => 'desc',
                'label' => 'Alasan Ban',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'Alasan perlu di isi!'
                )

            ),
        );

        $this->form_validation->set_rules($config);
        if ($this->form_validation->run()){
            if(empty($_POST['date']))
            {
                $dataerror .= 'Terjadi kesalahan pada input tenggat waktu.';
                $valid=false;
            }
            if($_POST['date']<1&&$_POST['date']>6)
            {
                $_POST['date'] = 1;
            }

            if ($valid){
                $this->mdl->banAccount($id,$_POST);
                $data['valid'] = true;
                $data['message'] = 'Akun telah di Ban! Cek di Blacklist Mode.';
                $data['request'] = 'ban';
                echo json_encode($data);
            }
            else{
                $data['valid'] = false;
                $data['message'] = 'Terdapat kesalahan saat pengiriman form: ' . $dataerror;
                $data['return'] = $_POST;
                $data['request'] = 'ban';
                echo json_encode($data);
            }
        }
        else{
            $data['valid'] = false;
            $data['message'] = 'Tolong di isi alasan ban pada form!';
            $data['return'] = $_POST;
            $data['request'] = 'ban';
            echo json_encode($data);
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
        if (!empty($_POST['iduser']))
        $this->session->set_tempdata("iduser", $this->input->post("iduser", true), 240);

        $request = $this->input->post("request", true);
        $this->session->set_tempdata("requestform", $request, 180);
        echo $request.$_POST['iduser'];
    }

    public function getViewModal()
    {
        //AJAX View Modal
        //if (!$this->input->is_ajax_request()) exit("Unknown Address (401)");
        if ($this->session->tempdata('requestform') === "new") {
            $this->load->model("model_datapengguna", "mdp");
            $option = $this->mdp->getJabatanAll();
            $view = array();
            $view["jabatan"] = "";
            foreach ($option as $row) {
                $view['jabatan'] .= "<option value='{$row->id_jabatan}'>{$row->nama}</option>";
            }
            $load = $this->load->view("admin_datauser/formnew", $view, true);
        } else if ($this->session->tempdata('requestform') === "pss") {
            $load = $this->load->view("admin_datauser/formpassword", "", true);
        } else if ($this->session->tempdata('requestform') === "ban") {
            $load = $this->load->view("admin_datauser/formban", "", true);
        } else if ($this->session->tempdata('requestform') === "unban") {
            $load = $this->load->view("admin_datauser/formunban", "", true);
        } else {
            $load = $this->load->view("admin_datauser/formedit", "", true);
        }
        echo $load;
    }

    function getCountAjax()
    {
        $this->load->model("model_login", "mdl");
        $data['tablerow'] = $this->mdl->getCountLogin();
        $data['tablemode']= $this->tableMode(true);
        echo json_encode($data);
    }

    public function tableMode($return='')
    {
        if (!empty($_POST['mode']))
        $this->session->set_userdata('tablemode',$_POST['mode']);

        if (empty($return) || !$return){
            $data['request'] = $this->session->userdata('tablemode');
            echo json_encode($data);
        }
        else{
            return ($this->session->userdata('tablemode'));
        }
    }

    public function getTable($mode)
    {
        $this->load->model("model_login", "mdl");
        $result = $this->mdl->getDataLogin($this->input->post(null, true),$mode);
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

