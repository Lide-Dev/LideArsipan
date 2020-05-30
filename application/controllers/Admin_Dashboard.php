<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Dashboard extends MY_Controller{

    public function index()
    {
        $this->load->model('model_surat','ms');
        $this->load->model('model_login','ml');
        $data = $this->initConfig('adm_dashboard','Dashboard','false',true);
        $data['countsurat']=$this->ms->getCountSurat();
        $data['countlogin']= $this->ml->getCountLogin();
        $data['countfile']= $this->countBytes();
        $this->initView('admin_dashboard/index',$data,true,false);
    }

    function countBytes(){
        $this->load->model('model_dokumen','md');
        $arr=$this->md->GetByteFile();
        $sum = 0.0;
        foreach($arr as $a){
            $sum+=$a['byte_file'];
        }
        return $this->formatBytes($sum);
    }

    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }


}