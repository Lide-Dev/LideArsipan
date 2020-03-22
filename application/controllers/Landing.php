<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Landing extends MY_Controller {

    public function index(){
        $config = $this->initConfig('landing','Condong Catur',true,false);
        $this->initView('landing/index',$config,false,false,false,true);
    }
}

?>