<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Admin_DataUser extends MY_Controller
{

    public function index()
    {
        $this->session->set_userdata('tablemode', 'normal');
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

    public function viewCP($idlink = null)
    {
        $data['valid'] = false;
        $data = $this->initConfig('gpass', 'Ganti Password', true, true);
        if (!empty($_SESSION['changepass']['link'])) {
            //$data['v']= "w";
            if ($_SESSION['changepass']['link'] === $idlink) {
                $data['valid'] = true;
                //$data['v']= "w";
            }
        }

        $this->initView("login/gantipassword", $data, true, false);
    }


    //------ MAIN FUNCTION ------------------

    public function submitRequest()
    {

        $request = $this->session->tempdata('requestform');
        if ($request === 'new') {
            $data = $this->addAccount();
        } else if ($request === 'edit') {
            $data = $this->editAccount();
        } else if ($request === 'pss') {
            $data = $this->editPassword();
        } else if ($request === 'ban') {
            $data = $this->banAccount();
        } else if ($request === 'unban') {
            $data = $this->unbanAccount();
        } else {
            $data['valid'] = false;
            $data['message'] = 'Session pada form ini habis! Silahkan ulang lagi.';
            $data['request'] = 'ssnexp';
        }
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
    }

    public function addAccount()
    {
        $valid = $valid2 = $validname = $validemail = false;
        $this->load->model('model_datapengguna', 'mdp');
        parse_str($_POST['pst'], $_POST['pst']);
        $config = array(
            array(
                'field' => "pst[password]",
                'label' => 'Password',
                'rules' => 'required',
                'min_length' => 8,
                'errors' => array(
                    'required' => 'Password perlu di isi!',
                    'min_length' => 'Password harus lebih dari 8 karakter!'
                ),
            ),
            array(
                'field' => 'pst[nip]',
                'label' => 'NIP',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'NIP perlu di isi!'
                )
            ),

            array(
                'field' => 'pst[tgllahir]',
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
            $data['return'] = $_POST['pst'];
            $data['error'] = validation_errors();
            $data['request'] = 'new';
        } else {
            if (!empty($_POST['pst']['username'])) {
                $validname = true;
            }
            if (!empty($_POST['pst']['email'])) {
                $validemail = true;
            }
            if ($validname && (!empty($_POST['pst']['username']) && strlen($_POST["pst"]['username']) > 3))
                $validname = true;
            else
                $validname = false;
            if ($validemail && (!empty($_POST["pst"]['email']) && filter_var($_POST['pst']['email'], FILTER_VALIDATE_EMAIL)))
                $validemail = true;
            else
                $validemail = false;

            if ($validname || $validemail) {
                $valid = true;
            } else {
                $valid = false;
            }

            if ($valid) {
                $valid2 = $this->mdp->getAccountDataWhere($_POST['pst'], true);
                if ($valid2) {
                    $this->mdp->addNewAccount($_POST['pst'], $_SESSION['idlogin']);
                    $data['valid'] = true;
                    $data['message'] = 'Akun telah dibuat!';
                    $data['request'] = 'new';
                } else {
                    $data['valid'] = false;
                    $data['message'] = 'Username atau email telah digunakan';
                    $data['return'] = $_POST['pst'];
                    $data['request'] = 'new';
                }
            } else {
                $data['valid'] = false;
                $data['message'] = 'Terdapat kesalahan pada inputan Username & Email!';
                $data['return'] = $_POST['pst'];
                $data['request'] = 'new';
            }
        }
        return $data;
    }

    public function editAccount()
    {
        $valid  = $validname = $validemail = false;
        parse_str($_POST['pst'], $_POST['pst']);
        $data['test'] = $_POST['pst'];
        if (empty($this->session->tempdata("iduser"))) {
            $data['valid'] = false;
            $data['message'] = 'Sesi pada pengeditan akun habis. Coba ulangi lagi!';
            $data['return'] = $_POST['pst'];
            $data['request'] = 'edit';
        } else {
            $dataerror = '';
            $id = $this->session->tempdata('iduser');
            $this->load->model('model_login', 'mdl');
            $isAvailable = $this->mdl->validIDData($id);
            if (empty($_POST['pst']['cek_email'])) {
                $_POST['pst']['cek_email'] = false;
                $_POST['pst']['email'] = 'undefined';
            }
            if ($isAvailable > 0) {
                $isAvailable = true;
            } else {
                $isAvailable = false;
                $dataerror .= ' ID yang dipilih tidak ada. ';
            }

            if ($_POST['pst']['cek_email']) {
                if (!empty($_POST['pst']['email'])) {
                    $validemail = true;
                }
                if ($validemail && filter_var($_POST['pst']['email'], FILTER_VALIDATE_EMAIL))
                    $validemail = true;
                else {
                    $validemail = false;
                    $dataerror .= 'Kesalahan format pada input data email. ';
                }
            }

            if (!empty($_POST['pst']['username'])) {
                $validname = true;
            }

            if ($validname && strlen($_POST['pst']['username']) > 3)
                $validname = true;
            else {
                $validname = false;
                $dataerror .= 'Kesalahan format pada input data username. ';
            }

            if ($_POST['pst']['cek_email']) {
                if ($isAvailable && $validname && $validemail) {
                    $valid = true;
                } else {
                    $valid = false;
                }
            } else {
                if ($isAvailable && $validname) {
                    $valid = true;
                } else {
                    $valid = false;
                }
            }

            if ($valid) {
                $this->mdl->updateDataLogin($id, $_POST['pst'], $_SESSION['idlogin']);
                $data['valid'] = true;
                $data['message'] = 'Data akun berhasil di ubah!';
                $data['return'] = $_POST['pst'];
                $data['request'] = 'edit';
            } else {
                $data['valid'] = false;
                $data['message'] = 'Terdapat kesalahan saat pengiriman form: ' . $dataerror;
                $data['return'] = $_POST['pst'];
                $data['request'] = 'edit';
            }
        }
        return $data;
    }

    public function editPassword()
    {
        parse_str($_POST['pst'], $_POST['pst']);
        $data['valid'] = false;
        $data['message'] = 'menuju ke pass!';
        $data['return'] = $_POST['pst'];
        $data['request'] = 'new';
        return $data;
    }

    public function banAccount()
    {

        $id = $this->session->tempdata('iduser');
        $this->load->model('model_login', 'mdl');
        $dataerror = '';
        $valid = true;
        parse_str($_POST['pst'], $_POST['pst']);

        if (!empty($_POST['pst']['desc'])) {

            if (empty($_POST['pst']['date'])) {
                $dataerror .= 'Terjadi kesalahan pada input tenggat waktu.';
                $valid = false;
            }
            if ($_POST['pst']['date'] < 1 && $_POST['pst']['date'] > 6) {
                $_POST['pst']['date'] = 1;
            }

            if ($valid) {
                $this->mdl->banAccount($id, $_POST['pst'], $_SESSION['idlogin']);
                $data['valid'] = true;
                $data['message'] = 'Akun telah di Ban! Cek di Blacklist Mode.';
                $data['request'] = 'ban';
            } else {
                $data['valid'] = false;
                $data['message'] = 'Terdapat kesalahan saat pengiriman form: ' . $dataerror;
                $data['return'] = $_POST['pst'];
                $data['request'] = 'ban';
            }
        } else {
            $data['valid'] = false;
            $data['message'] = 'Tolong di isi alasan ban pada form!';
            $data['return'] = $_POST['pst'];
            $data['request'] = 'ban';
        }
        return $data;
    }

    public function unbanAccount()
    {
        $id = $this->session->tempdata('iduser');
        $this->load->model('model_login', 'mdl');
        if (!empty($id)) {
            $this->mdl->unbanAccount($id, $_SESSION['idlogin']);
            $data['valid'] = true;
            $data['message'] = 'Akun telah di unban!';
            $data['request'] = 'unban';
        } else {
            $data['valid'] = false;
            $data['message'] = 'Session form ini telah habis!';
            $data['request'] = 'ban';
        }
        return $data;
    }

    public function changePassword()
    {
        if (!empty($_SESSION['changepass'])) {
         //   echo "a";
         //   print_r($_POST);
            if (empty($_POST['newpass']) ||  $_POST['newpass'] != $_POST['cekpass'] || strlen($_POST['newpass']) < 4 ) {
                echo "b";
                $error = '';
                if (empty($_POST['newpass'])) {
                    $error .= "Isilah form yang telah di sediakan. ";
                }
                else {
                if ($_POST['newpass'] != $_POST['cekpass']) {
                    $error .= "Isi pengecekan password dengan benar. ";
                }
                if (strlen($_POST['newpass']) < 4)
                    $error .= "Password kurang dari 3 karakter.";
                }
                $this->messagePage($error, 3);
                redirect(base_url("gantipass/" . $_SESSION['changepass']['link']));
            } else {
               // echo "c";
                $data['id_change'] = $_SESSION['changepass']['id_change'];
                $data['pass'] = $_POST['newpass'];
                $this->load->model('model_login','mdl');
                $this->mdl->changePassword($data);
                $this->messagePage("Password telah berhasil diganti di user dengan id ".$data['id_change'], 1);
                $this->session->unset_tempdata('changepass');
                unset($_SESSION['changepass']);
                redirect(base_url("admin/admdatauser"));
            }
        }
        else{
          //  echo "d";
            $this->messagePage("Session Habis", 2);
            redirect(base_url("gantipass/" . $_SESSION['changepass']['link']));
        }
    }


    //---------------------------AJAX REQUEST----------------------------------------------

    public function createLinkCP($id)
    {
        //$this->load->model('model_datapengguna', "model_dp");
        //$this->model_dp->CreateCodePass($id);

        if (!empty($_SESSION["idlogin"])) {
            $role = $this->rolePermission($_SESSION["idlogin"]);
            if ($role->admin == 1) {
                $link = bin2hex(random_bytes(24));
                $arr = array("id_change" => $id, "link" => $link);
                $this->session->set_tempdata("changepass", $arr, 900);
                redirect(base_url("gantipass/" . $link));
            } else {
                $this->errorPage(array('title' => 'Tidak di Ijinkan', 'code' => '403', 'desc' => 'Kami tidak bisa membawa anda ke URL yang di tuju karena masalah perijinan'));
            }
        } else {
            $this->errorPage(array('title' => 'Tidak di Ijinkan', 'code' => '403', 'desc' => 'Kami tidak bisa membawa anda ke URL yang di tuju karena masalah perijinan'));
        }
    }

    public function getEditDataUser()
    {
        //if (!$this->input->is_ajax_request()) exit("Unknown Address (401)");
        $this->load->model("model_login", "mdl");
        $result=(array)$this->mdl->getDataUser($this->input->get("iduser", true));
        $row=sizeof($result);
        $key=array_keys($result);
        for($i=0;$i<$row;$i++){
            $result[$key[$i]]=$this->security->xss_clean($result[$key[$i]]);
        }

       // foreach($result)
        echo json_encode($result);
    }

    public function setClickButton()
    {
        //if (!$this->input->is_ajax_request()) exit("Unknown Address (401)");
        if (!empty($_POST['iduser']))
            $this->session->set_tempdata("iduser", $this->input->post("iduser", true), 240);

        $request = $this->input->post("request", true);
        $this->session->set_tempdata("requestform", $request, 180);
        echo json_encode(array('token' => $this->security->get_csrf_hash()));
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
                $view['jabatan'] .= "<option value='".$this->security->xss_clean($row->id_jabatan)."'>".$this->security->xss_clean($row->nama)."</option>";
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
        $data['tablemode'] = $this->tableMode(true);
        echo json_encode($data);
    }

    public function tableMode($return = '')
    {
        if (!empty($_GET['mode']))
            $this->session->set_userdata('tablemode', $_GET['mode']);

        if (empty($return) || !$return) {
            $data['request'] = $this->session->userdata('tablemode');
            echo json_encode($data);
        } else {
            return ($this->session->userdata('tablemode'));
        }
    }

    public function getTable($mode)
    {
        $this->load->model("model_login", "mdl");
        $result = $this->mdl->getDataLogin($this->input->get(null, true), $mode);
        $callback = array(
            'draw' =>  $this->input->get('draw', true),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['totalFilter'],
            'data' => $result['data']
        );
        header('Content-Type: application/json');
        echo json_encode($callback);
    }
}
