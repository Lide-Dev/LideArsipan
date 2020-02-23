<?php

class Login extends MY_Controller
{

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
        $this->initView('login/index', $data, false, false, true);
    }

    public function LP_CheckEmail()
    {
        $state = false;
        $this->load->model('model_datapengguna', "model_dp");
        $email = $this->input->post("email");
        $state = $this->model_dp->checkEmail($email);
        if ($state) {
            $this->SendMail( $email, "");
            echo 1;
        } else {
            echo 0;
        }
    }

    public function SendMail($to, $text)
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
            'newline' => "\r\n"
            /*'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
            'mailtype' => 'text', //plaintext 'text' mails or 'html'
            'smtp_timeout' => '4', //in seconds
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE*/

        );
        $this->load->library('email',$config);
        $this->email->set_newline("\r\n");
        $this->email->from($email, 'Lide Arsipan');
        $this->email->to($to);
        $this->email->subject('Test Pengiriman Email');
        $this->email->message("Coba mengirim Email dengan CodeIgniter.");
        if ($this->email->send()) {
            echo "Email berhasil terkirim.";
        } else {
            echo "Email gagal dikirim.";
        }
        //Send mail
    }

    public function createPassChange($id)
    {

    }
}
