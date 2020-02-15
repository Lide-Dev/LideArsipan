<?php

class Upload extends CI_Controller {


    public function index(){
        $this->load->helper('form');
        $data['error']='';
        $this->load->view("form_surat/upload",$data);
    }


    public function upload_doc()
    {
        $config['upload_path'] = './assets/doc';
        $config['allowed_types'] = 'pdf|jpg|png|doc|docx';
        $config['max_size']     = '10240';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('berkas')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->helper('form');
            $this->load->view('form_surat/upload', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('form_surat/complete', $data);
        }
    }

}

?>