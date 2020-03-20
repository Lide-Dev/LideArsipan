<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Dashboard extends MY_Controller{

    public function index()
    {
        $data = $this->initConfig('adm_dashboard','Dashboard','false');
        $this->initView('admin_dashboard/index',$data,true,false);
    }


}