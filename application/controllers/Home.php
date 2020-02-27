<?php

class Home extends MY_Controller {


    public function index(){
        $data = $this->initConfig("dashboard","Lide Arsipan");
        $this->initView('dashboard/index',$data);
    }
}

?>