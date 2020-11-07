<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Arsip extends MY_Controller
{
    public function index()
    {
        $data = $this->initConfig("arsip", "Data Arsip");
        $this->load->model("model_surat");
        if (empty($_SESSION['typearsip']) || $_SESSION['typearsip'] === 'none') {
            $type = '';
        } else {
            $type = $_SESSION['typearsip'];
        }
        $data['tablerow'] = $this->model_surat->getCountSurat($type);
        $config = array(
            "dialog_center" => false,
            "id" => array(
                "modal" => "modalarsip",
                "form" => "formarsip"
            ),
            "load" => "arsip/modalarsip",
            "text" => array(
                "ok" => "Terima",
                "cancel" => "Tutup"
            ),
            "show" => array(
                "form" => true
            )
        );
        $data['modal'] = $this->initModal($config);
        $this->initView('arsip/index', $data, true, true, true);
    }

    public function showTable($type)
    {

        switch ($type) {
            case 'sk':
                $this->session->set_userdata('typearsip', 'sk');
                redirect(base_url('arsip'));
                break;
            case 'dp':
                $this->session->set_userdata('typearsip', 'dp');
                redirect(base_url('arsip'));
                break;
            case 'sm':
                $this->session->set_userdata('typearsip', 'sm');
                redirect(base_url('arsip'));
                break;
            default:
                $this->session->set_userdata('typearsip', 'none');
                redirect(base_url('arsip'));
                break;
        }
    }


    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }

    public function file_check($str)
    {
        $str = substr($str, 1);
        $pdf = array('pdf', 'ps');
        $image = array('jpg', 'jpeg', 'png', 'bmp', 'svg');
        $doc = array('doc', 'docx', 'odt', 'rtf', 'tex', 'wpd');
        $type = '';

        if (in_array($str, $pdf)) {
            $type = 'pdf';
        } else if (in_array($str, $image)) {
            $type = 'img';
        } else if (in_array($str, $doc)) {
            $type = 'doc';
        } else {
            $type = 'other';
        }
        return $type;
    }

    public function getViewModal($type)
    {
        $this->ajaxFunction();
        $this->load->model("model_surat", "ms");
        $this->load->model("model_dokumen", "md");
        $this->load->model("model_kode", "mk");
        $this->load->model("model_datapengguna", "mdp");
        //AJAX View Modal
        //if (!$this->input->is_ajax_request()) exit("Unknown Address (401)");

        $permission = $this->rolePermission($_SESSION['idlogin']);
        switch ($_SESSION['typearsip']) {
            case 'sm':
                $validw = $permission->w_arsip;
                break;
            case 'sk':
                $validw = $permission->w_arsip;
                break;
            case 'dp':
                $validw = $permission->w_disposisi;
                break;
            default:
                $validw = 0;
                break;
        }

        if ($validw && $permission->dt_arsip){
            $validd = 1;
        }
        else{
            $validd = 0;
        }
        $request = $this->input->get('send');
        if (!empty($type)) {
            $data['arsip'] = $this->ms->GetSuratbyID($request, $_SESSION['typearsip']);
            if (!empty($data['arsip'])) {
                if ($type === "open") {
                    $data['arsip'] = $this->ms->GetSuratbyID($request, $_SESSION['typearsip']);
                    $data['klasifikasi'] = $this->mk->get_desckode($data['arsip']['id_kode']);
                    $data['user'] = $this->mdp->GetUserbyID($data['arsip']['id_upload'], "nama");
                    $data['namauploader'] = $data['user']->nama;
                    $data['dokumen'] = $this->md->GetDokumenbyID($data['arsip']['id_dokumen'], $_SESSION['typearsip']);
                    $data['dokumen']['byte_file'] = $this->formatBytes($data['dokumen']['byte_file']);
                    $data['extfile'] = $this->file_check($data['dokumen']['ekstensi']);
                    $load = $this->load->view("arsip/openpage", $data, true); //MODAL VIEW (ARSIP/OPENPAGE)
                } else if ($type === "delete" && $validd) {
                    //$data['arsip'] = $this->ms->GetSuratbyID($request, $_SESSION['typearsip']);
                    $this->session->set_tempdata('id_surat', $request, 120);
                    $load = $this->load->view("arsip/deletepage", $data, true);
                } else if ($type === 'edit' && $validw) {
                    $this->session->set_tempdata('id_surat', $request, 300);
                    $typearsip = $_SESSION['typearsip'];
                    $column = array_keys($data['arsip']);
                    $data['desc'] = array($data['arsip'][$column[4]], $data['arsip'][$column[5]], $data['arsip'][$column[6]], $data['arsip'][$column[7]], $data['arsip'][$column[8]]);
                    if ($typearsip === 'sm') {
                        $data['row'] = 5;
                        $data['label'] = array('No. Surat', 'Asal Surat', 'Isi Ringkas', 'Keterangan', 'Lokasi Arsip');
                        $data['id'] = array('id-nosurat', 'id-asalsurat', 'id-isiringkas', 'id-keterangan', 'id-lokasiarsip');
                        $data['name'] = array('nosurat', 'asalsurat', 'isiringkas', 'keterangan', 'lokasiarsip');
                        $data['type'] = array('text', 'text', 'textarea', 'textarea', 'text');
                        $data['helpon'] = array(false, false, false, false, false);
                        $data['help'] = array('', '', '', '', '');
                    } else if ($typearsip === 'sk') {
                        $data['row'] = 5;
                        $data['label'] = array('No. Surat', 'Pengirim', 'Isi Ringkas', 'Keterangan', 'Lokasi Arsip');
                        $data['id'] = array('id-nosurat', 'id-pengirim', 'id-isiringkas', 'id-keterangan', 'id-lokasiarsip');
                        $data['name'] = array('nosurat', 'pengirim', 'isiringkas', 'keterangan', 'lokasiarsip');
                        $data['type'] = array('text', 'text', 'textarea', 'textarea', 'text');
                        $data['helpon'] = array(false, false, false, false, false);
                        $data['help'] = array('', '', '', '', '');
                    }
                    $load = $this->load->view("arsip/editpage", $data, true);
                } else {
                    if (!$validw||!$validd) {
                        $data['title'] = 'Tidak di Ijinkan';
                        $data['desc'] = 'Aksi yang anda lakukan tidak di ijinkan!';
                    } else {
                        $data['title'] = 'Kesalahan Pengiriman';
                        $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
                    }

                    $load = $this->load->view("arsip/errorpage", $data, true);
                }
            } else {
                $data['title'] = 'Kesalahan Pengiriman';
                $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
                $load = $this->load->view("arsip/errorpage", $data, true);
            }
        } else {
            $data['title'] = 'Kesalahan Pengiriman';
            $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
            $load = $this->load->view("arsip/errorpage", $data, true);
        }
        echo $load;
    }

    function getDokumenDownload($id)
    {
        $this->load->model("model_dokumen", "md");
        $data = $this->md->GetDokumenbyID($id);
        if (file_exists('assets/doc/' . $data['nama_file'] . $data['ekstensi'])) {
            redirect(base_url('assets/doc/' . $data['nama_file'] . $data['ekstensi']));
        } else {
            $config['title'] = 'File Hilang';
            $config['code'] = '404';
            $config['desc'] = 'File ' . $data['nama'] . $data['ekstensi'] . ' tidak ditemukan atau hilang pada server. Cobalah untuk menkontak admin web ini.';
            $this->errorPage($config);
        }
    }

    function getCountAjax()
    {
        $this->ajaxFunction();
        if (empty($_SESSION['typearsip']) or $_SESSION['typearsip'] === 'none') {
            $type = 'emp';
            $tablerow = 0;
        } else {
            $this->load->model("model_surat");
            $type = $_SESSION['typearsip'];
            $tablerow = $this->model_surat->getCountSurat();
        }

        $callback = array(
            'rows' => $tablerow,
            'type' => $type,
            'session' => $_SESSION['typearsip'],
            'token' =>$this->security->get_csrf_hash()
        );
        header('Content-Type: application/json');
        echo json_encode($callback);
    }

    public function getTable()
    {
        $this->ajaxFunction();
        $role = $this->rolePermission($_SESSION['idlogin']);
        $role = $role->nama;

        $this->load->model("model_surat");
        $result = $this->model_surat->getDataTableSurat($this->input->post(null, true), $_SESSION['typearsip']);

        $callback = array(
            'draw' =>  $this->input->post('draw', true),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['totalFilter'],
            'data' => $result['data'],
            'custom' => array('role' => $this->security->xss_clean(strtolower($role)), 'typearsip' => $this->security->xss_clean($_SESSION['typearsip']), 'token' =>$this->security->get_csrf_hash())
        );

        header('Content-Type: application/json');
        echo json_encode($callback);
    }

    public function requestModal($request)
    {
        $this->ajaxFunction();
        //echo $request;
        //print_r($_SESSION);
        if (!empty($request)) {
            if ($request === 'delete') {
                $load = $this->deleteSurat($_SESSION['id_surat']);
            } else if ($request === 'patch') {
                //print_r($this->input->post('send'));
                $params = array();
                parse_str($this->input->post('send'), $params);
                $load = $this->editSurat($_SESSION['id_surat'], $params);
            } else {
                $this->output->set_status_header('400');
                $data['title'] = 'Kesalahan Pengiriman';
                $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
                $load = $this->load->view("arsip/errorpage", $data, true);
            }
        } else {
            $this->output->set_status_header('400');
            $data['title'] = 'Kesalahan Pengiriman';
            $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
            $load = $this->load->view("arsip/errorpage", $data, true);
        }

        $callback = array('html'=>$load,'token'=>$this->security->get_csrf_hash());
        header('Content-Type: application/json');
        echo json_encode($callback);
    }

    public function deleteSurat($id)
    {
        $request = $id;
        $this->load->model("model_surat", "ms");
        $data['arsip'] = $this->ms->GetSuratbyID($request, $_SESSION['typearsip']);
        if (!empty($data['arsip'])) {
            $this->ms->DeleteTempSuratbyID($request, $_SESSION['typearsip'], $_SESSION['idlogin']);
            $data['title'] = 'Berhasil Menghapus Arsip!';
            $data['desc'] = 'Penghapusan berhasil namun ini bersifat tidak permanen. Jika ingin menghapus secara permanen kontak web admin ini.';
            $load = $this->load->view("arsip/completepage", $data, true);
        } else {
            $this->output->set_status_header('400');
            $data['title'] = 'Kesalahan Pengiriman';
            $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
            $load = $this->load->view("arsip/errorpage", $data, true);
        }
        return $load;
    }

    public function editSurat($id, $data)
    {
        $request = $id;
        $this->load->model("model_surat", "ms");
        $get['arsip'] = $this->ms->GetSuratbyID($request, $_SESSION['typearsip']);
        if (!empty($get['arsip'])) {
            $valid = $this->ms->EditSuratValidatebyID($request, $_SESSION['typearsip'], $data);
            if (in_array(true, $valid['changes'], true)) {
                $changes = true;
            } else {
                $changes = false;
            }

            if ($changes) {
                $this->ms->EditSuratbyID($request, $_SESSION['typearsip'], $data, $_SESSION['idlogin']);
                $this->output->set_status_header('200');
                $data['title'] = 'Berhasil Mengubah Data Arsip!';
                $data['desc'] = 'Pengubahan data arsip telah dilakukan!';
                $load = $this->load->view("arsip/completepage", $data, true);
            } else {
                $this->output->set_status_header('200');
                $data['title'] = 'Tidak Ada Yang Berubah';
                $data['desc'] = 'Tidak ada perubahan data yang dimasukkan.';
                $load = $this->load->view("arsip/completepage", $data, true);
            }
        } else {
            $this->output->set_status_header('400');
            $data['title'] = 'Kesalahan Pengiriman';
            $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
            $load = $this->load->view("arsip/errorpage", $data, true);
        }
        return $load;
    }
}
