<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
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
        $validate = array(
            'w_suratmasuk' => 1,
            'w_suratkeluar' => 1,
            'w_disposisi' => 1
        );
        $init = $this->roleValidate($validate);
        if ($init['valid']) {
            $data = $this->initConfig("form_surat", "Registrasi Arsip");
            $data['permission'] = $init['upermission'];
            $data['statemessage'] = 0;
            $this->initView('form_surat/index', $data);
        } else {

            $config['title'] = 'Tidak di Ijinkan';
            $config['code'] = '403';
            $config['desc'] = 'Mohon maaf kami tidak bisa membawa anda kesana karena masalah perijinan';
            $this->errorPage($config);
        }
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
        if (!$this->input->is_ajax_request()) exit("Unauthorized Request (401)");

        $this->load->model('model_kode');
        $i = 0;
        $arr = array();
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
                        $arr['result'] = "<option value = '{$row->id_kode}' > {$row->id_kode}  {$row->nama} (Dipilih)  </option>";
                    } else {
                        $arr['result'] .= "<option value = '{$row->id_kode}' > &emsp; {$row->id_kode}  {$row->nama} </option>";
                    }
                    $i++;
                }
            }
            echo json_encode($arr);
        } else if ($idtext === 'subkode1') {
            $result = $this->model_kode->search_subkode1($this->session->kodesurat);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    if ($i === 0) {
                        $arr['result'] = "<option value = '{$row->id_kode}' > {$row->id_kode}  {$row->nama} (Dipilih)  </option>";
                    } else {
                        $arr['result'] .= "<option value = '{$row->id_kode}' > &emsp; {$row->id_kode}  {$row->nama} </option>";
                    }
                    $i++;
                }
            }
            echo json_encode($arr);
        } else {
            $result = $this->model_kode->search_subkode2($this->session->kodesurat);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    if ($i === 0) {
                        $arr['result'] = "<option value = '{$row->id_kode}' > {$row->id_kode}  {$row->nama} (Dipilih)  </option>";
                    } else {
                        $arr['result'] .= "<option value = '{$row->id_kode}' > &emsp; {$row->id_kode}  {$row->nama} </option>";
                    }
                    $i++;
                }
            }
            echo json_encode($arr);
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
        $kodevar = $this->input->post('kodevar');
        if (is_array($kodevar))
            $this->session->set_userdata("kodesurat", $kodevar);
        else {
            $this->session->set_userdata("kodesurat", explode(".", $kodevar));
        }
        header('Content-Type: application/json');
        echo json_encode(array('token' => $this->security->get_csrf_hash()));
    }

    public function form_submit()
    {
        $this->load->model('model_datapengguna', 'mdp');
        $user = $this->mdp->GetUserbyIDUser($_SESSION['idlogin'], 'id_datapengguna');
        $data['statemessage'] = true;
        $data['page'] = "form_surat";
        $value = $this->input->post();

        if ($value['tipesurat'] === 'disposisi') {
            $config = array(
                'w_disposisi' => 1
            );
            $valid = $this->roleValidate($config);
        } else if ($value['tipesurat'] === 'suratmasuk') {
            $config = array(
                'w_suratmasuk' => 1
            );
            $valid = $this->roleValidate($config);
        } else if ($value['tipesurat'] === 'suratkeluar') {
            $config = array(
                'w_suratkeluar' => 1
            );
            $valid = $this->roleValidate($config);
        } else {
            $valid['valid'] = false;
        }

        if ($valid['valid']) {
            $this->validation_init();
            if ($this->form_validation->run() == FALSE) {
                //echo '<br>Test1 IF 1';
                $message = "Kesalahan: Terdapat form penting yang belum terisi. Mohon di isi! (Error Code: 401) ";
                $this->messagePage($message, 3);
                header('Location: ' . base_url('registrasi-surat'));
                $this->session->unset_userdata('kodesurat');
            } else {
                //echo '<br>Test1 IF ELSE 1';
                $valid = $this->validation_kode();
                if ($valid === false) {
                    //echo '<br>Test1 IF ELSE 1 IF 2';
                    $message = "Kesalahan: Kode belum di isi! (Error Code: 403)";
                    $this->messagePage($message, 3);
                    header('Location: ' . base_url('form_surat'));
                    $this->session->unset_userdata('kodesurat');
                } else {
                    //echo '<br>Test1 IF ELSE 1 IF ELSE 2';
                    $valid = $this->upload_doc($user->id_datapengguna);
                    //echo $valid;
                    if ($valid === false) {
                        //echo '<br>Test1 IF ELSE 1 IF ELSE 2 IF 3';
                        $message = "Kesalahan: Perhatikan ekstensi dan besar ukuran filenya (Error Code: 402)";
                        $this->messagePage($message, 3);
                        header('Location: ' . base_url('registrasi-surat'));
                        $this->session->unset_userdata('kodesurat');
                    } else {
                        //echo '<br>Test1 IF ELSE 1 IF ELSE 2 IF ELSE 3';

                        $value['id_dokumen'] = $this->iddokumen;
                        $value['klasifikasi'] = $this->session->kodesurat;
                        $this->load->model('model_kode');
                        $value['desckode'] = $this->model_kode->get_desckode($this->session->kodesurat);
                        $this->load->model("model_surat");
                        //print_r($value);
                        $this->model_surat->TambahSurat($value, $user->id_datapengguna);
                        $message = "Berhasil! Surat berhasil di input ke arsip online.";
                        $this->messagePage($message, 1);
                        header('Location: ' . base_url('registrasi-surat'));
                        $this->session->unset_userdata('kodesurat');
                    }
                }
            }
        } else {
            $message = "Kesalahan: Aksi yang anda lakukan tidak di ijinkan! (Error Code: 403) ";
            $this->messagePage($message, 3);
            header('Location: ' . base_url('registrasi-surat'));
            $this->session->unset_userdata('kodesurat');
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

    public function upload_doc($id)
    {
        $config['upload_path'] = './assets/doc';
        $config['allowed_types'] = 'pdf|jpg|png|doc|docx';
        $config['max_size']     = '10240';
        $config['encrypt_name'] = true;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('uploaddoc')) {
            $error = array('error' => $this->upload->display_errors());
            echo $error;
            return false;
        } else {
            $data = $this->upload->data();
            $data['user'] = $id;
            $this->load->model('model_dokumen');
            $this->iddokumen = $this->model_dokumen->TambahDokumen($data);
            return true;
        }
    }

    function validation_kode()
    {
        if (!empty($this->session->kodesurat)) {
            $kode = $this->session->kodesurat;
            if (is_array($kode)) {
                $kode = implode(".", $kode);
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
        $kodevar = $this->input->get('kodevar');
        //print_r($kodevar);
        if (!is_array($kodevar))
            $kodevar = explode(".", $kodevar);
        $this->load->model('model_kode');
        $count = $this->model_kode->check_kode($idform, $kodevar);
        $arr = array('count' => $count);
        header('Content-Type: application/json');
        echo json_encode($arr);
    }



    function get_kode($page = null)
    {
        $result = $this->session->kodesurat;
        if (is_array($result)) {
            $result = implode(".", $result);
        }
        $arr = array('result' => $result);
        header('Content-Type: application/json');
        echo json_encode($arr);
    }

    function get_desckode()
    {
        $this->load->model('model_kode');
        if (empty($this->input->post('desckode')))
            $result = $this->model_kode->get_desckode($this->session->kodesurat);
        else
            $result = $this->model_kode->get_desckode($this->input->post('desckode'));
        $arr = array('result' => $result);
        header('Content-Type: application/json');
        echo json_encode($arr);
    }


    //------------------------------- GET FUNCTION ----------------------------------//
    //-------------------------------- GET FUNCTION ----------------------------------//
    //-------------------------------- END GET FUNCTION ----------------------------------//



}
