<?php

class Landing_Page extends CI_Controller {


    public function index(){
        $data['page']="form_surat";
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('landing_page/index');
        $this->load->view('templates/footer',$data);
    }
}

?>