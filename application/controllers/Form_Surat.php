<?php

class Form_Surat extends CI_Controller
{
    private $kodevar;

    public function index()
    {
        $data['page'] = "form_surat";
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('form_surat/index');
        $this->load->view('templates/footer', $data);
    }

    public function get_autocomplete($idtext)
    {
        $this->load->model('model_kode');
        $i = 0;
        //if (isset($_GET['term'])) {
        if ($idtext === 'kategori') {
            $result = $this->model_kode->search_kategori($_GET['search']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = $row->id_kode . " " . $row->nama;
                echo json_encode($arr_result);
            }
        } else if ($idtext === 'kodeutama') {
            $result = $this->model_kode->search_kode($this->session->kodesurat);
            if (count($result) > 0) {
                foreach ($result as $row) {
                if ($i===0){
                ?>
                    <option value=<?=$row->id_kode?>> <?= $row->id_kode . " " . $row->nama ." (Dipilih) "?> </option>
                <?php
                } else {
                ?>
                    <option value=<?= $row->id_kode ?>> <?= "&emsp; ".$row->id_kode . " " . $row->nama ?> </option>
                <?php
                }
                $i++;
                }
            }
        } else if ($idtext === 'subkode1') {
            $result = $this->model_kode->search_subkode1($this->session->kodesurat);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    if ($i===0){
                        ?>
                            <option value=<?=$row->id_kode?>> <?= $row->id_kode . " " . $row->nama ." (Dipilih) "?> </option>
                        <?php
                        } else {
                        ?>
                            <option value=<?= $row->id_kode ?>> <?= "&emsp; ".$row->id_kode . " " . $row->nama ?> </option>
                        <?php
                        }
                        $i++;
                }
            }
        } else {
            $result = $this->model_kode->search_subkode2($this->session->kodesurat);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    if ($i===0){
                        ?>
                            <option value=<?=$row->id_kode?>> <?= $row->id_kode . " " . $row->nama ." (Dipilih) "?> </option>
                        <?php
                        } else {
                        ?>
                            <option value=<?= $row->id_kode ?>> <?= "&emsp; ".$row->id_kode . " " . $row->nama ?> </option>
                        <?php
                        }
                        $i++;
                }
            }
        }
    }

    public function set_kode()
    {
        if (is_array($_POST['kodevar']))
        $this->session->set_userdata("kodesurat", $_POST['kodevar']);
        else{
            $this->session->set_userdata("kodesurat", explode(".",$_POST['kodevar']));
        }
    }

    function cek_kode($idform)
    {
        if (!is_array($_POST['kodevar']))
        $_POST['kodevar'] = explode(".",$_POST['kodevar']);
        $this->load->model('model_kode');
        $count = $this->model_kode->check_kode($idform, $_POST['kodevar']);
        echo ($count);
    }
}
