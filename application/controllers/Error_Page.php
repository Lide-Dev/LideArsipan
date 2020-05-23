<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Error_Page extends CI_Controller {


    public function index(){
        $this->load->view('error_page/index');
    }
}

?>