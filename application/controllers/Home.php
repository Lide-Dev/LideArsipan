<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends MY_Controller {


    public function index(){
        $data = $this->initConfig("dashboard","Lide Arsipan");
        $this->initView('dashboard/index',$data);
    }
}

?>