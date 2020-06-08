<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends MY_Controller
{
    function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function index()
    {
        $data = $this->initConfig('login', 'Login', false);
        $config = array(
            "title" => "Lupa Password",
            "dialog_center" => true,
            "load" => "login/lupapassword",
            "text" => array(
                "ok" => "Cari Akun",
                "cancel" => "Batal"
            ),
            "show" => array(
                "form" => true
            )
        );
        $data['modal'] = $this->initModal($config);
        $this->initView('login/index', $data, false, false, true, true);
    }



    public function logout()
    {

        $this->session->sess_destroy();
        session_write_close();
        header("Location: " . base_url("dashboard"));
    }

    public function validateLogin()
    {
        $post = $this->input->post();
        print_r($post);
        $this->load->model('model_login', 'mdl');

        $email = $this->test_input($post["login_name"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //$emailErr = "Invalid email format";
            $data = $this->mdl->validateLogin(false, $post['login_name'], $post['login_pass']);
            //print_r ($data);
        } else {
            $data = $this->mdl->validateLogin(true, $post['login_name'], $post['login_pass']);
            //print_r ($data);
        }

        if ($data['valid']) {
            $this->session->set_userdata('idlogin', $data['id']);
            $role = $this->rolePermission($data['id']);
            if (strtolower($role->nama) !== 'admin')
                header('Location: ' . base_url("dashboard"));
            else
                header('Location: ' . base_url("admin/dashboard"));
        } else {
            $message = "Username/Email dengan Password tidak cocok!";
            header('Location: ' . base_url("login"));
            $this->messagePage($message, 3);
        }
    }

    public function LP_CheckEmail()
    {
        if (!$this->input->is_ajax_request()) exit("Unauthorized Request (401)");

            $state = false;
            $this->load->model('model_datapengguna', "model_dp");
            $email = $this->input->post("email", true);
            $state = $this->model_dp->checkEmail($email);
            $data = $this->model_dp->CreateCodePass($email);
            //echo $state;
            if ($state) {
                $this->SendMail($email, $data);
                echo 1;
            } else {
                echo 0;
            }

    }

    public function SendMail($to, $data)
    {
        $email = "bebc62626f8efd";
        $pass = "2371a11f65834f";

        $config = array(
            'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => $email,
            'smtp_pass' => $pass,
            'crlf' => "\r\n",
            'newline' => "\r\n",
            'mailtype' => 'html'
            /*'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
            'mailtype' => 'text', //plaintext 'text' mails or 'html'
            'smtp_timeout' => '4', //in seconds
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE*/

        );
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from($email, 'Lide Arsipan');
        $this->email->to($to);
        $this->email->subject('Tindakan Ganti Password');
        $this->email->message(
            "
        <center><b>Anda telah melakukan sebuah tindakan untuk mengganti password.</b><br><br>
        Ini adalah link untuk mengganti password anda <a href='" . base_url('gantipass/' . $data['id_lupapass'] . $data['kodeganti']) . "'>disini!</a> .<br>
        Jika ini bukan anda maka klik link <a href='" . base_url('gantipass/batal/' . $data['id_lupapass'] . $data['kodeganti']) . "'>disini</a> agar kami akan membatalkan link ganti anda.
        </center>"
        );
        if ($this->email->send()) {
            //echo "Email berhasil terkirim.";
        } else {
            //echo "Email gagal dikirim.";
        }
        //Send mail
    }

    public function changePassword($method, $idlink)
    {
    }

    public function viewCP($idlink = null)
    {
        $this->load->model("model_login", 'mdl');
        $data = $this->initConfig('gpass', 'Ganti Password');
        $data['valid'] = $this->mdl->cekLinkCP($idlink);
        $this->initView("login/gantipassword", $data, true, true);
    }
}
