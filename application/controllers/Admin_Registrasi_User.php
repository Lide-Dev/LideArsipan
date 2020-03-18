<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_Registrasi_User extends CI_Controller {


    public function index(){
        $this->load->view('templates/navbar_admin');
        $this->load->view('admin_registrasi_user/index');
    }
}

?>