<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

    public function getTest(){
        $this->load->model("model_surat");
        $this->load->model("model_kode","mk");
        $result = $this->model_surat->getDataTableSurat($this->input->post(null,true));
        $a=0;
        foreach ($result['data'] as $i){
            $data=(array)$i;
            $data['klasifikasi']=$this->mk->get_desckode($data['id_kode']);
            $i=(object)$data;
            $result['data'][$a] = $i;
            $a++;
        }
    }

    public function getTable(){
        $this->load->model("model_surat");
        $this->load->model("model_kode","mk");
        $result = $this->model_surat->getDataTableSurat($this->input->post(null,true));

        $callback = array(
            'draw' =>  $this->input->post('draw',true),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['totalFilter'],
            'data' => $result['data']
        );

        header('Content-Type: application/json');
        echo json_encode($callback);

    }



}

?>