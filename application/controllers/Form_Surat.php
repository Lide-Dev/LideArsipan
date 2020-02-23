<?php

class Form_Surat extends MY_Controller
{
    private $iddokumen = "";
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
        $data = $this->initConfig("form_surat","Registrasi Arsip");
        $data['statemessage'] = 0;
        $this->initView('form_surat/index',$data);
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
                    if ($i === 0) {
?>
                        <option value=<?= $row->id_kode ?>> <?= $row->id_kode . " " . $row->nama . " (Dipilih) " ?> </option>
                    <?php
                    } else {
                    ?>
                        <option value=<?= $row->id_kode ?>> <?= "&emsp; " . $row->id_kode . " " . $row->nama ?> </option>
                    <?php
                    }
                    $i++;
                }
            }
        } else if ($idtext === 'subkode1') {
            $result = $this->model_kode->search_subkode1($this->session->kodesurat);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    if ($i === 0) {
                    ?>
                        <option value=<?= $row->id_kode ?>> <?= $row->id_kode . " " . $row->nama . " (Dipilih) " ?> </option>
                    <?php
                    } else {
                    ?>
                        <option value=<?= $row->id_kode ?>> <?= "&emsp; " . $row->id_kode . " " . $row->nama ?> </option>
                    <?php
                    }
                    $i++;
                }
            }
        } else {
            $result = $this->model_kode->search_subkode2($this->session->kodesurat);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    if ($i === 0) {
                    ?>
                        <option value=<?= $row->id_kode ?>> <?= $row->id_kode . " " . $row->nama . " (Dipilih) " ?> </option>
                    <?php
                    } else {
                    ?>
                        <option value=<?= $row->id_kode ?>> <?= "&emsp; " . $row->id_kode . " " . $row->nama ?> </option>
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



    //-------------------------------- START FORM FUNCTION ----------------------------------//
    //-------------------------------- FORM FUNCTION ----------------------------------//
    //-------------------------------- FORM FUNCTION ----------------------------------//

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
        else {
            $this->session->set_userdata("kodesurat", explode(".", $_POST['kodevar']));
        }
    }

    public function form_submit()
    {
        $data['statemessage'] = true;
        $data['page'] = "form_surat";
        $this->validation_init();
        if ($this->form_validation->run() == FALSE) {
            $data['colormessage'] = "bg-danger";
            $data['message'] = "Kesalahan: Terdapat form penting yang belum terisi. Mohon di isi! (Error Code: 401) ";
            $this->initview('form_surat/index',$data);
        } else {
            $valid = $this->validation_kode();
            if ($valid === false) {
                $data['colormessage'] = "bg-danger";
                $data['message'] = "Kesalahan: Kode belum di isi! (Error Code: 403)";
                $this->initview('form_surat/index',$data);
            } else {
                $valid = $this->upload_doc();
                if ($valid === false) {
                    $data['colormessage'] = "bg-danger";
                    $data['message'] = "Kesalahan: Perhatikan ekstensi dan besar ukuran filenya (Error Code: 402)";
                    $this->initview('form_surat/index',$data);
                } else {
                    $value = $_POST;
                    $value['id_dokumen']= $this->iddokumen;
                    $value['klasifikasi']= $this->session->kodesurat;
                    $this->load->model('model_kode');
                    $value['desckode'] = $this->model_kode->get_desckode($this->session->kodesurat);
                    $this->load->model("model_surat");
                    $this->model_surat->TambahSurat($value);
                    $data['colormessage'] = "bg-info";
                    $data['message'] = "Berhasil! Surat berhasil di input ke arsip online.";
                    $this->initview('form_surat/index',$data);
                }
            }
        }
    }

    public function validation_init()
    {
        $config =
            array(
                array(
                    'field' => 'nosurat',
                    'label' => 'Nomor Surat',
                    'rules' => 'required',
                    'error' => array(
                        'required' => 'Nomor Surat perlu di isi!'
                    )
                ),
                array(
                    'field' => 'tglpenerimaansurat',
                    'label' => 'Tanggal Penerimaan Surat',
                    'rules' => 'required',
                    'error' => array(
                        'required' => 'Tanggal Penerimaan Surat perlu di isi!'
                    )

                ),
                array(
                    'field' => 'tglpembuatansurat',
                    'label' => 'Tanggal Pembuatan Surat',
                    'rules' => 'required',
                    'error' => array(
                        'required' => 'Tanggal Pembuatan Surat perlu di isi!'
                    )
                ),
                array(
                    'field' => 'asalsurat',
                    'label' => 'Asal Surat',
                    'rules' => 'required',
                    'error' => array(
                        'required' => 'Asal Surat perlu di isi!'
                    )
                ),
                array(
                    'field' => 'lokasiarsip',
                    'label' => 'Lokasi Arsip',
                    'rules' => 'required',
                    'error' => array(
                        'required' => 'Lokasi Arsip perlu di isi!'
                    )
                )
            );
        $this->form_validation->set_rules($config);
    }

    public function upload_doc()
    {
        $config['upload_path'] = './assets/doc';
        $config['allowed_types'] = 'pdf|jpg|png|doc|docx';
        $config['max_size']     = '10240';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('uploaddoc')) {
            $error = array('error' => $this->upload->display_errors());
            return false;
        } else {
            $data = $this->upload->data();
            $data['user']='ADM000000';
            $this->load->model('model_dokumen');
            $this->iddokumen = $this->model_dokumen->TambahDokumen($data);
            return true;
        }
    }

    function validation_kode()
    {
        if (!empty($this->session->kodesurat)) {
            $kode = $this->session->kodesurat;
            if (is_array($kode)){
                $kode = implode(".",$kode);
            }


            if ($kode === "000.0.0.0" || $kode === "000/0/0/0") {
                return false;

            } else {
                return true;

            }
        } else {
            return false;

        }
    }


    //-------------------------------- FORM FUNCTION ----------------------------------//
    //-------------------------------- FORM FUNCTION ----------------------------------//
    //-------------------------------- END FORM FUNCTION ----------------------------------//



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
            $_POST['kodevar'] = explode(".", $_POST['kodevar']);
        $this->load->model('model_kode');
        $count = $this->model_kode->check_kode($idform, $_POST['kodevar']);
        echo ($count);
    }



    function get_kode($page = null)
    {
        $result = $this->session->kodesurat;
        if (is_array($result)) {
            $result = implode(".", $result);
        }
        echo $result;
    }

    function get_desckode()
    {
        $this->load->model('model_kode');
        if (empty($this->input->post('desckode')))
        $result = $this->model_kode->get_desckode($this->session->kodesurat);
        else
        $result = $this->model_kode->get_desckode($this->input->post('desckode'));
        echo $result;
    }


    //------------------------------- GET FUNCTION ----------------------------------//
    //-------------------------------- GET FUNCTION ----------------------------------//
    //-------------------------------- END GET FUNCTION ----------------------------------//



}
