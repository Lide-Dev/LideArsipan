<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Boxsampah extends MY_Controller
{
    public function index()
    {
        $this->load->model("model_dokumen", "md");
        $data = $this->initConfig('adm_boxsampah', 'Box Sampah', 'false', true);
        $data['totalarsip']=floatval($this->md->GetByteFileArsip());
        $data['totalsampah']=floatval($this->md->GetByteFileArsip(true));
        $data['totalserver']=floatval(1048576); //1GB Static value
        $data['reservedsystem']=floatval(153600); //150MB Static value
        $data['percentagearsip']=number_format(floatval($data['totalarsip']/$data['totalserver']*100),2);
        $data['percentagesampah']=number_format(floatval($data['totalsampah']/$data['totalserver']*100),2);
        $data['percentagesystem']=number_format(floatval($data['reservedsystem']/$data['totalserver']*100),2);
        $data['percentagetotal']=number_format(floatval(100-$data['percentagearsip']-$data['percentagesampah']-$data['percentagesystem']),2);
        $data['space']= $this->formatBytes($data['totalserver']-$data['totalarsip']-$data['totalsampah']-$data['reservedsystem']);
        $data['totalserver'] = $this->formatBytes($data['totalserver']);
        $data['reservedsystem'] = $this->formatBytes($data['reservedsystem']);
        $data['totalarsip']=$this->formatBytes($data['totalarsip']);
        $data['totalsampah']=$this->formatBytes($data['totalsampah']);

        $config = array(
            "dialog_center" => false,
            "id" => array(
                "modal" => "modalbox",
                "form" => "formbox"
            ),
            "load" => "admin_boxsampah/modalbox",
            "text" => array(
                "ok" => "Terima",
                "cancel" => "Tutup"
            ),
            "show" => array(
                "form" => true
            )
        );
        $data['modal'] = $this->initModal($config);
        $this->initView('admin_boxsampah/index', $data, true, false, true);
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

    public function getTable()
    {
        $this->ajaxFunction();
        $this->load->model("model_surat", "ms");
        $result = $this->ms->getDataTableSurat($this->input->get(null, true),'',true);
        $callback = array(
            'draw' =>  $this->input->get('draw', true),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['totalFilter'],
            'data' => $result['data']

        );
        //header('Content-Type: application/json');
        echo json_encode($callback);
    }

    public function recoverArsip($id)
    {
        //$this->
        $this->ajaxFunction();
        $this->load->model("model_surat",'ms');

    }

    public function getViewModal($type)
    {
        $this->ajaxFunction();
        $this->load->model("model_surat", "ms");
        $this->load->model("model_dokumen", "md");
        $this->load->model("model_datapengguna", "mdp");
        $this->load->model("model_kode", "mk");
        //AJAX View Modal
        //if (!$this->input->is_ajax_request()) exit("Unknown Address (401)");
        $request = $this->input->get('send');
        $valid= false;
        $typear= strtolower(substr($request,0,2));
        if ($typear==='sk'){
            $valid=true;
        }
        else   if ($typear==='sm'){
            $valid=true;
        }
        else   if ($typear==='di'){
            $valid=true;
        }
        else{
            $valid=false;
        }
        if (!empty($type)&&$valid) {
            $data['arsip'] = $this->ms->GetSuratbyID($request,$typear);
            if (!empty($data['arsip'])) {
                if ($type === "open") {
                    $data['arsip'] = $this->ms->GetSuratbyID($request, $typear);
                    $data['klasifikasi'] = $this->mk->get_desckode($data['arsip']['id_kode']);
                    $data['user'] = $this->mdp->GetUserbyID($data['arsip']['id_upload'], "nama");
                    if (empty($data['user']->nama))
                    $data['namauploader']= 'Deleted User';
                    else
                    $data['namauploader'] = $data['user']->nama;
                    $data['dokumen'] = $this->md->GetDokumenbyID($data['arsip']['id_dokumen'], $typear);
                    $data['dokumen']['byte_file'] = $this->formatBytes($data['dokumen']['byte_file']);
                    $data['extfile'] = $this->file_check($data['dokumen']['ekstensi']);
                    $data['typearsip']= $typear;
                    $load = $this->load->view("admin_boxsampah/openpage", $data, true); //MODAL VIEW (ARSIP/OPENPAGE)
                } else if ($type === "delete") {
                    //$data['arsip'] = $this->ms->GetSuratbyID($request, $typear);
                    $this->session->set_tempdata('id_surat', $request, 120);
                    $load = $this->load->view("admin_boxsampah/deletepage", $data, true);
                } else if ($type === 'recover') {
                    $this->session->set_tempdata('id_surat', $request, 120);
                    $load = $this->load->view("admin_boxsampah/recoverpage", $data, true);
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
        } else {
            $data['title'] = 'Kesalahan Pengiriman';
            $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
            $load = $this->load->view("arsip/errorpage", $data, true);
        }
        echo $load;
    }

    public function requestModal($request)
    {
        $this->ajaxFunction();
        //echo $request;
        //print_r($_SESSION);
        $result['token']=  $this->security->get_csrf_hash();
        $typear= strtolower(substr($_SESSION['id_surat'],0,2));
        //echo $_SESSION['id_surat'];
        if ($typear==='sk'){
            $valid=true;
        }
        else   if ($typear==='sm'){
            $valid=true;
        }
        else   if ($typear==='di'){
            $valid=true;
        }
        else{
            $valid=false;
        }
        if (!empty($request)&&$valid) {
            if ($request === 'delete') {
                $result['load'] = $this->deleteSurat($_SESSION['id_surat'],$typear);
            } else if ($request === 'recover') {
                $result['load'] = $this->recoverSurat($_SESSION['id_surat'],$typear);
            } else {
                //echo 'kosong';
                $this->output->set_status_header('400');
                $data['title'] = 'Kesalahan Pengiriman';
                $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
                $request['load'] = $this->load->view("arsip/errorpage", $data, true);
            }
        } else {
            //echo 'galat';
            $this->output->set_status_header('400');
            $data['title'] = 'Kesalahan Pengiriman';
            $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
            $result['load'] = $this->load->view("arsip/errorpage", $data, true);
        }
        echo json_encode($result);
    }


    public function deleteSurat($id,$typear)
    {
        $request = $id;
        $this->load->model("model_surat", "ms");
        $this->load->model("model_dokumen", "md");
        $data['arsip'] = $this->ms->GetSuratbyID($request, $typear);
        if (!empty($data['arsip'])) {
            $this->ms->DeletePermSuratbyID($request, $typear, $_SESSION['idlogin']);
            $dokumen=$this->md->GetDokumenbyID($data['arsip']['id_dokumen']);
            $file='./assets/doc/'.$dokumen['nama'];
            if (is_readable($file)){
                unlink($file);
                $desclog = "File ditemukan";
            }
            else{
                $desclog = "File hilang dari server";
            }
            $this->md->DeleteDokumenbyID($data['arsip']['id_dokumen']);
            $data['title'] = 'Berhasil Menghapus Arsip!';
            $data['desc'] = 'Penghapusan berhasil. '.$desclog.'. File ini tidak akan bisa ditemukan dan di kembalikan lagi.';
            $load = $this->load->view("arsip/completepage", $data, true);
        } else {
            $this->output->set_status_header('400');
            $data['title'] = 'Kesalahan Pengiriman';
            $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
            $load = $this->load->view("arsip/errorpage", $data, true);
        }
        return $load;
    }

    public function recoverSurat($id,$typear)
    {

        $request = $id;
        $this->load->model("model_surat", "ms");
        $get['arsip'] = $this->ms->GetSuratbyID($request, $typear);
        if (!empty($get['arsip'])) {
            $this->ms->RecoverSuratbyID($request,$typear,$_SESSION['idlogin']);
            $data['title'] = 'Berhasil Mengembalikan Arsip!';
            $data['desc'] = 'Pengembalian Arsip berhasil. Arsip ini dapat dilihat kembali oleh user.';
            $load = $this->load->view("arsip/completepage", $data, true);
        } else {
            $this->output->set_status_header('400');
            $data['title'] = 'Kesalahan Pengiriman';
            $data['desc'] = 'Terjadi kesalahan pada pengiriman data. Silahkan kontak ke web admin ini untuk lebih lanjutnya.';
            $load = $this->load->view("arsip/errorpage", $data, true);
        }
        return $load;
    }
}

