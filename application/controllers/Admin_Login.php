<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin_Login extends CI_Controller {

    public function index(){
        $this->load->view('admin_login/index');
    }
}

?>