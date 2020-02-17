<?php

class Arsip extends CI_Controller {
    /**
     * Inisialisasi informasi untuk view page yang di gunakan.
     *
     * @param string $page
     * Diusahakan sama seperti yang ada di view template dan lain-lain karena berpengaruh jalannya web seperti JS.
     * @param string $title
     * Judul page yang akan berada pada tab browser.
     * @return array
     */
    function initconfig($page,$title=null){
        if (!empty($page)){
        $data['page']=$page;
        }
        else {$data['page']="undefined";}

        if (!empty($title)){
            $data['title']=$title;
            }
            else {$data['title']="Lide Arsipan";}


        return $data;
    }

    public function index(){
        $data = $this->initconfig('arsip','Data Arsip');
        $this->load->model("model_surat");
        $data['tablerow']=$this->model_surat->getCountSurat();
        $this->load->view('templates/header',$data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('arsip/index',$data);
        $this->load->view('templates/footer',$data);
    }

    function getCountAjax(){
        $this->load->model("model_surat");
        $tablerow=$this->model_surat->getCountSurat();
        echo $tablerow;
    }

    public function getTable(){
        $this->load->model("model_surat");
        $result = $this->model_surat->getDataTableSurat($this->input->post());
        $callback = array(
            'draw' =>  $this->input->post('draw'),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['totalFilter'],
            'data' => $result['data']
        );

        header('Content-Type: application/json');
        echo json_encode($callback);

    }



}

?>