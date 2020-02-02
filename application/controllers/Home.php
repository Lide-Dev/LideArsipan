<?php

class Home extends CI_Controller {


    public function index(){
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('dashboard/index');
        $this->load->view('templates/footer');
    }
}

?>