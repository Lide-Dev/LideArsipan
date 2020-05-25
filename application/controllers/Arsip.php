<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Arsip extends MY_Controller
{

    public function index()
    {
        $data = $this->initConfig("arsip", "Data Arsip");
        $this->load->model("model_surat");
        $data['tablerow'] = $this->model_surat->getCountSurat();
        $this->initView('arsip/index', $data);
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
