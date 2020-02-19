<?php

class Login extends MY_Controller {

    public function index(){
        $data = $this->initConfig('login','Login',false);
        $config = array(
            "title"=>"Lupa Password",
            "dialog_center"=>true,
            "load"=>"login/lupapassword",
            "text" => array(
                "ok"=>"Cari Akun",
                "cancel"=>"Batal"
            ),
            "show"=>array(
                "form"=>true
            )
        );
        $data['modal']= $this->initModal($config);
        $this->initView('login/index',$data,false,false,true);
    }

    public function LP_CheckEmail()
    {
        $this->load->model('model_datapengguna',"model_dp");
        $email=$this->input->post("email");
        $state= $this->model_dp->checkEmail("ADM0000000",$email);
        if ($state){
            echo 1;
        }
        else {
            echo 0;
        }

    }
}

?>