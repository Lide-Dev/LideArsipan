<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_Admin extends CI_Controller {


    public function index(){
        $this->load->view('templates/navbar_admin');
        $this->load->view('dashboard_admin/index');
    }
}

?>

