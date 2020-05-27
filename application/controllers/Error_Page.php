<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Error_Page extends MY_Controller {


    public function index(){
        if (empty($this->session->flashdata('configer')))
        {
        $error['title']='Kesalahan Halaman';
        $error['code']='404';
        $error['desc']='Terjadi sebuah kesalahan pada halaman web ini. Coba di refresh page atau perhatikan
        url web dengan benar. Jika masih berlanjut cobalah kontak admin web ini';
        }
        else
        $error=$this->session->flashdata('configer');

        $data = $this->initConfig('errorpage',$error['title']);
        $data['error']=$error;
        $this->initView('error_page/index',$data,true,false);
    }
}

?>