<?php

class Form_Surat extends CI_Controller
{
    //-------------------------------- START VIEW FUNCTION ----------------------------------//
    //-------------------------------- VIEW FUNCTION ----------------------------------//
    //-------------------------------- VIEW FUNCTION ----------------------------------//


    /**
     * Inisialisasi page form_surat. Semua inisiasi data harus ada disini sebelum memulai
     * page
     *
     * @return void
     */
    public function index()
    {
        $data['page'] = "form_surat";
        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('templates/navbar');
        $this->load->view('form_surat/index');
        $this->load->view('templates/footer', $data);
    }

    /**
     * Mencari data kode dan mengeluarkan output sesuai id form kode pada page.
     * Operasi fungsi ini ada pada form_surat.js
     *
     * @param string $idtext
     * - "kategori" = mencari kode kategori dan mengoutputkan ke JS UI Autocomplete.
     * - "kodeutama" = mencari kode utama dan mengoutputkan ke Select Option id form_kode
     * - "subkode1" = mencari kode utama dan mengoutputkan ke Select Option id form_subkode1
     * - "subkode2" = mencari kode utama dan mengoutputkan ke Select Option id form_subkode2
     * @return html,JSON
     * Hasil akan di proses di form_surat.js
     */
    public function get_autocomplete($idtext)
    {
        $this->load->model('model_kode');
        $i = 0;
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

    //-------------------------------- VIEW FUNCTION ----------------------------------//
    //-------------------------------- VIEW FUNCTION ----------------------------------//
    //-------------------------------- END VIEW FUNCTION ----------------------------------//



    //-------------------------------- START SET FUNCTION ----------------------------------//
    //-------------------------------- SET FUNCTION ----------------------------------//
    //-------------------------------- SET FUNCTION ----------------------------------//

    /**
     * Set session kode pilihan user untuk sementara agar tak terubah. Ketika page ke reload
     * maka session akan di ulang.
     *
     * @return void
     */
    public function set_kode()
    {
        if (is_array($_POST['kodevar']))
        $this->session->set_userdata("kodesurat", $_POST['kodevar']);
        else{
            $this->session->set_userdata("kodesurat", explode(".",$_POST['kodevar']));
        }
    }


    //-------------------------------- SET FUNCTION ----------------------------------//
    //-------------------------------- SET FUNCTION ----------------------------------//
    //-------------------------------- END SET FUNCTION ----------------------------------//



    //-------------------------------- START GET FUNCTION ----------------------------------//
    //-------------------------------- GET FUNCTION ----------------------------------//
    //-------------------------------- GET FUNCTION ----------------------------------//

    /**
     * Berfungsi untuk mengecek apakah kode ada atau tidak.
     *
     * @param string $idform
     * @return void
     */
    function cek_kode($idform)
    {
        if (!is_array($_POST['kodevar']))
        $_POST['kodevar'] = explode(".",$_POST['kodevar']);
        $this->load->model('model_kode');
        $count = $this->model_kode->check_kode($idform, $_POST['kodevar']);
        echo ($count);
    }

    function get_kode($page=null){
        $result = $this->session->kodesurat;
        if(is_array($result)){
            $result=implode(".",$result);
        }
        echo $result;
    }

    function get_desckode(){
        $this->load->model('model_kode');
        $result = $this->model_kode->get_desckode($this->session->kodesurat);
        echo $result;
    }


     //------------------------------- GET FUNCTION ----------------------------------//
    //-------------------------------- GET FUNCTION ----------------------------------//
    //-------------------------------- END GET FUNCTION ----------------------------------//



}
