<?php

class Home extends MY_Controller {


    public function index(){
        $data = $this->initConfig("home","Lide Arsipan");
        $this->initView('dashboard/index',$data);
    }
}

?>