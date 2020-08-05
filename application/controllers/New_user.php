<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class New_User extends MY_Controller
{
    public function index($hash)
    {
        if(empty($_SESSION['new_user'])){
            redirect(base_url("error"));
        }
        else{
            $a = $_SESSION['new_user'];
            if ($a["id"]!==$_SESSION["idlogin"]){
                redirect(base_url("error"));
            }
            if ($a["hash"]!==$hash){
                redirect(base_url("error"));
            }
        }
        $this->load->model("model_login", "mdl");
        $this->load->model("model_datapengguna", "mdp");

        $data = $this->initConfig('new_user', 'Konfigurasi Awal', true);
        $data["data_login"] = $this->mdl->getDataUser($_SESSION["idlogin"]);
        $data["data_account"] = $this->mdp->GetUserbyIDUser($_SESSION["idlogin"]);
        $l = $this->mdp->getJabatanbyID($data["data_account"]->id_jabatan);
        $data["data_account"]->jabatan= $l->nama;
        $this->initView('new_user/index', $data, true, true);
    }

    public function change_data()
    {
        $this->validation_init();
        $email_valid = false;
        $pass_valid = false;
        $this->load->model("model_login", "mdl");
        $this->load->model("model_datapengguna", "mdp");
        if (!empty($_POST['email'])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email_valid = true;
            }
        } else {
            $email_valid = true;
        }

        if (!empty($this->input->post('pass')) and $this->input->post('pass')===$this->input->post('passc')){
            $pass_valid=true;
        }

        if ($email_valid&&$pass_valid) {
            if ($this->form_validation->run()) {
                $this->mdl->updateDataLogin($_SESSION["idlogin"],$this->input->post(),$_SESSION["idlogin"]);
                $_POST['id_change']=$_SESSION["idlogin"];
                $this->mdl->changePassword($this->input->post());
                $this->mdp->updateAccountData($_SESSION["idlogin"],$this->input->post());
                $this->session->set_tempdata('new_user',"",2);
                $role = $this->rolePermission($_SESSION['idlogin']);
                if (strtolower($role->nama) !== 'admin'){
                    if (substr($_POST["username"], 0, 3) == 'usl' && strlen($_POST["username"]) == 10)
                        $this->messagePage("Konfigurasi awal akun berhasil namun username anda masih bawaan sistem. Ini membuat anda dibawa ke konfigurasi awal lagi ketika login ke akun ini.",2);
                    else
                        $this->messagePage("Konfigurasi awal akun berhasil!",1);
                    redirect(base_url("dashboard"));
                }
                else{
                    redirect(base_url("admin/dashboard"));
                }

            }
            else{
                $this->session->unset_tempdata('new_user');
                $this->messagePage("Ada beberapa input form yang penting belum di isi atau tidak sesuai persyaratan. ",3);
                $hash = bin2hex(random_bytes(20));
                $this->session->set_tempdata('new_user',
                array(
                    'id'=>$_SESSION["idlogin"],
                    'hash'=>$hash
                ),500);
                redirect(base_url("newuser/".$hash));
            }
        }
        else{
            $this->session->unset_tempdata('new_user');
            if (!$email_valid){
                $this->messagePage("Email yang anda isi tidak valid.",3);
            }
            elseif (!$pass_valid) {
                $this->messagePage("Konfirmasi password tidak sama.",3);
            }
            else{
                $this->messagePage("Email yang anda isi tidak valid dan konfirmasi password tidak sama.",3);
                }
            $hash = bin2hex(random_bytes(20));
            $this->session->set_tempdata('new_user',
            array(
                'id'=>$_SESSION["idlogin"],
                'hash'=>$hash
            ),500);
            redirect(base_url("newuser/".$hash));
        }
    }

    public function validation_init()
    {
        $config = array(
            array(
                'field' => 'username',
                'label' => 'Username',
                'rules' => 'required|min_length[3]',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'pass',
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'passc',
                'label' => 'Ulangi Password',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            ),
            array(
                'field' => 'nama',
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.',
                ),
            )
        );

        $this->form_validation->set_rules($config);
    }
}
