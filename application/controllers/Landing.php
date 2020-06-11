<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Landing extends MY_Controller {

    public function index(){
        $config = $this->initConfig('landing','Condongcatur',true,false);
        if (!empty($_SESSION['idlogin'])){
            $user = $this->rolePermission($_SESSION['idlogin']);
            $role = strtolower($user->nama);
            if ($role==='admin'){
                $config['direct_tooltip']='Ke Dashboard Admin';
                $config['url']=base_url('admin/dashboard');
            }
            else {
                $config['direct_tooltip']='Ke Dashboard';
                $config['url']=base_url('dashboard');
            }
        }
        else{
            $config['direct_tooltip']='Login Ke Akun Anda';
            $config['url']=base_url('Login');
        }
        $this->initView('landing/index',$config,false,false,false,true);
    }
}

?>