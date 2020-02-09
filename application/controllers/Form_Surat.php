<?php

class Form_Surat extends CI_Controller
{
    private $kodevar;

    public function index()
    {
        $data['page']="form_surat";
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('form_surat/index');
        $this->load->view('templates/footer',$data);
    }

    public function get_autocomplete($idtext)
    {
        $this->load->model('model_kode');
        //if (isset($_GET['term'])) {
            if ($idtext === 'kategori') {
                $result = $this->model_kode->search_kategori($_GET['search']);

            }
            else if ($idtext === 'kodeutama') {
                $result = $this->model_kode->search_kode($_GET['search'],$this->session->kodesurat);

            }
            else if ($idtext === 'subkode1') {
                $result = $this->model_kode->search_subkode1($_GET['search'],$this->session->kodesurat);
            }
            /*else if ($idtext === 'subkode2') {
                $result = $this->model_kode->search_kode($_GET['search'],$this->session->kodesurat);
            }*/
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->id_kode." ".$row->nama;
                echo json_encode($arr_result);
                //print_r($arr_result);
            }
        //}
    }

    public function set_kode(){

            $this->session->set_userdata("kodesurat",$_POST['kodevar']);
            $this->session->set_userdata("tentangsurat",$_POST['tentangvar']);

    }
}
