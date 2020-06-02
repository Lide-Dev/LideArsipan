<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Boxsampah extends MY_Controller
{
    public function index()
    {
        $data = $this->initConfig('adm_boxsampah','Box Sampah','false',true);
        $this->initView('admin_boxsampah/index',$data,true,false);
    }
}
