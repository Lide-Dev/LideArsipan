<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller {


    public function index(){
        $this->load->model('model_surat','ms');
        $data = $this->initConfig("dashboard");
        $data['count_sm'] = $this->ms->getCountSurat('sm');
        $data['count_sk'] = $this->ms->getCountSurat('sk');
        $data['count_dp'] = $this->ms->getCountSurat('dp');
        $data['count_all'] = $this->ms->getCountSurat();
        $this->initView('dashboard/index',$data);
    }
}

?>