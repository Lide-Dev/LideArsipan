<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bantuan extends MY_Controller {


    public function index(){
        $data = $this->initConfig("bantuan");
        $this->initView('bantuan/index',$data);
    }
}

?>