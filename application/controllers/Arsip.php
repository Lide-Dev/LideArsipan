<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Arsip extends MY_Controller
{

    public function index()
    {
        $data = $this->initConfig("arsip", "Data Arsip");
        $this->load->model("model_surat");
        $data['tablerow'] = $this->model_surat->getCountSurat();
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
        $this->initView('arsip/index', $data, true,true,true);
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
        $str = substr($str,1);
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
        //AJAX View Modal
        //if (!$this->input->is_ajax_request()) exit("Unknown Address (401)");
        if ($type === "open") {
            $_SESSION['typearsip'] === "sm" ? $typearsip = "suratmasuk" : 'disposisi';
            $_SESSION['typearsip'] === "sk" ? $typearsip = "suratkeluar" : 'disposisi';
            $_SESSION['typearsip'] === "dp" ? $typearsip = "disposisi" : '';
            $request=$this->input->get('send');
            $this->load->model("model_surat", "ms");
            $this->load->model("model_dokumen", "md");
            $this->load->model("model_datapengguna","mdp");
            //print_r($this->input->get('send'));
           //print_r($request['id_'.$typearsip]);
            $data['arsip'] = $this->ms->GetSuratbyID($request['id_'.$typearsip], $_SESSION['typearsip']);
            $data['klasifikasi'] = $this->ms->get_desckode($data['arsip']['id_kode']);
            $data['user'] = $this->mdp->GetUserbyID($data['arsip']['id_upload'], "nama");
            $data['namauploader'] = $data['user']->nama;
            $data['dokumen'] = $this->md->GetDokumenbyID($data['arsip']['id_dokumen'], $_SESSION['typearsip']);
            //print_r($data['arsip']);
            //print_r($data['dokumen']);
            $data['dokumen']['byte_file']= $this->formatBytes($data['dokumen']['byte_file']);
            $data['extfile'] = $this->file_check($data['dokumen']['ekstensi']);

            $load = $this->load->view("arsip/openpage", $data, true);
        }
        echo $load;
    }

    function getDokumenDownload($id){
        $this->load->model("model_dokumen", "md");
        $data=$this->md->GetDokumenbyID($id);
        if (file_exists('assets/doc/'.$data['nama'].$data['ekstensi'])){
            redirect(base_url('assets/doc/'.$data['nama'].$data['ekstensi']));
        }
        else{
            $config['title']='File Hilang';
            $config['code']='404';
            $config['desc']='File '.$data['nama'].$data['ekstensi'].' tidak ditemukan atau hilang pada server. Cobalah untuk menkontak admin web ini.';
            $this->errorPage($config);
        }


    }


    function getCountAjax()
    {
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
            'type' => $type
        );
        header('Content-Type: application/json');
        echo json_encode($callback);
    }

    public function getTest()
    {
        $this->load->model("model_surat");
        $this->load->model("model_kode", "mk");
        $result = $this->model_surat->getDataTableSurat($this->input->post(null, true));
        $a = 0;
        foreach ($result['data'] as $i) {
            $data = (array) $i;
            $data['klasifikasi'] = $this->mk->get_desckode($data['id_kode']);
            $i = (object) $data;
            $result['data'][$a] = $i;
            $a++;
        }
    }

    public function getTable()
    {
        $this->load->model("model_surat");
        $result = $this->model_surat->getDataTableSurat($this->input->post(null, true), $_SESSION['typearsip']);
        $callback = array(
            'draw' =>  $this->input->post('draw', true),
            'recordsTotal' => $result['total'],
            'recordsFiltered' => $result['totalFilter'],
            'data' => $result['data']
        );

        header('Content-Type: application/json');
        echo json_encode($callback);
    }
}
