<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_Dashboard extends MY_Controller
{

    public function index()
    {
        $this->load->model('model_surat', 'ms');
        $this->load->model('model_login', 'ml');
        $data = $this->initConfig('adm_dashboard', 'Dashboard', 'false', true);
        $data['countsurat'] = $this->ms->getCountSurat();
        $count['sm'] = $this->ms->getCountSurat('sm');
        $count['sk'] = $this->ms->getCountSurat('sk');
        // $count['dp'] = $this->ms->getCountSurat('dp');
        if (empty($count['sm']))
        $data['chartcount']['sm']= 0;
        else
        $data['chartcount']['sm']= number_format(floatval($count['sm']/$data['countsurat']*100),2);

        if (empty($count['sk']))
        $data['chartcount']['sk']=0;
        else
        $data['chartcount']['sk']= number_format(floatval($count['sk']/$data['countsurat']*100),2);

        // if (empty($count['dp']))
        // $data['chartcount']['dp']=0;
        // else
        // $data['chartcount']['dp']= number_format(floatval($count['dp']/$data['countsurat']*100),2);

        $data['countlogin'] = $this->ml->getCountLogin();
        $data['countfile'] = $this->countBytes();
        $arr['sm'] = $this->dataCharts($this->ms->getSuratbyGroup('create_time', 'surat_masuk'));
        $arr['sk'] = $this->dataCharts($this->ms->getSuratbyGroup('create_time', 'surat_keluar'));
        // $arr['dp'] = $this->dataCharts($this->ms->getSuratbyGroup('create_time', 'disposisi'));
//        print_r ($arr);
        $data['chartdata'] = array(
            array(
                'name' => 'Surat Masuk',
                'data' => $arr['sm']
            ),
            array(
                'name' => 'Surat Keluar',
                'data' => $arr['sk']
            ),
            // array(
            //     'name' => 'Disposisi',
            //     'data' => $arr['dp']
            // )
        );

        $this->initView('admin_dashboard/index', $data, true, false);
    }

    function dataCharts($array)
    {
        $date = new DateTime('6 days ago midnight');
        //var_dump($date);
        $time = $date->getTimestamp();
        $timeoffset = $time;
        $time = strtotime('+1 day', $time);
        //var_dump($time);
        //echo $time."aaa";

        $arr = $array;
        $result = array();
        $a = 0;
        for ($i = 0; $i < 7; $i++) {
            if (!empty($arr[$a]) && ($arr[$a]['create_time'] > $timeoffset && $arr[$a]['create_time'] < $time)) {
                    array_push($result, array('x' => intval($timeoffset * 1000), 'y' => intval($arr[$a]['count'])));
                $a++;
            } else {
                array_push($result, array('x' => intval($timeoffset * 1000), 'y' => intval(0)));
            }
            $timeoffset= $time;
            $time = strtotime('+1 day', $time);
        }
        // $sort = $
        // print_r(array_column($result, 'create_time'));
        //array_multisort (array_column($result, 'create_time'), SORT_DESC, $array);
        return $result;
    }

    function countBytes()
    {
        $this->load->model('model_dokumen', 'md');
        $arr = $this->md->GetByteFile();
        $sum = 0.0;
        foreach ($arr as $a) {
            $sum += $a['byte_file'];
        }
        return $this->formatBytes($sum);
    }

    function formatBytes($size, $precision = 2)
    {
        $base = log($size, 1024);
        $suffixes = array('KB', 'MB', 'GB', 'TB');

        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }


}
