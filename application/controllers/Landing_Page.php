<?php

class Landing_Page extends MY_Controller {


    public function index(){
        $data = $this->initConfig("home","Lide Arsipan");
        $this->initView('landing_page/index',$data);
    }
}

?>