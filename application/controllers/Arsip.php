<?php

class Arsip extends MY_Controller {

    public function index(){
        $data = $this->initConfig("arsip","Data Arsip");
        $this->load->model("model_surat");
        $data['tablerow']=$this->model_surat->getCountSurat();
        $this->initView('arsip/index',$data);
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