<?php
class Model_Kode extends CI_Model
{

    function check_kode($idform, $kode)
    {
        //print_r($kode);
        if ($idform === "kode") {
            $this->db->like('id_kode', '0.0', 'before');
            $this->db->like('id_kode', $kode[0], 'after');
            $this->db->where('id_kode >',$kode[0].".0.0.0");
        } else if ($idform == "subkode1") {
            //echo $kode[0].".".$kode[1];
            $this->db->like('id_kode', '0', 'before');
            $this->db->like('id_kode', $kode[0].".".$kode[1], 'after');
            $this->db->where('id_kode >',$kode[0].".".$kode[1].".0.0");
        } else {
            $this->db->like('id_kode', $kode[0] . "." . $kode[1] . "." . $kode[2], 'after');
            $this->db->where('id_kode >',$kode[0].".".$kode[1].".".$kode[2].".0");
        }
        $this->db->from('kode');
        $count = $this->db->count_all_results();
        return $count;
    }

    function search_kategori($title)
    {
        $this->db->like('id_kode', '0.0.0', 'before');
        $this->db->like('nama', $title, 'both');
        $this->db->order_by('nama', 'ASC');
        $this->db->limit(10);
        return $this->db->get('kode')->result();
    }

    function search_kode( $kode)
    {
        if ($kode[0] === '160') {
            $this->db->where('id_kode >=', '160.0.0.0');
            $this->db->where('id_kode <', '162.0.0.0');
            //print_r($result);
        } else {
            $this->db->like('id_kode', '0.0', 'before');
            $this->db->like('id_kode', $kode[0], 'after');
            $this->db->where('id_kode >=',$kode[0].".0.0.0");
        }
        $this->db->order_by('id_kode', 'ASC');
        $this->db->limit(10);
        //echo "<br><br>";
        //print_r($result);
        return $this->db->get('kode')->result();;
    }

    function search_subkode1($kode)
    {
        //$kode = explode(".",$kode);
        $this->db->like('id_kode', $kode[0] . "." . $kode[1], 'after');
        $this->db->like('id_kode', '0', 'before');
        $this->db->where('id_kode >=',$kode[0].".".$kode[1].".0.0");
        $this->db->order_by('id_kode', 'ASC');
        $this->db->limit(10);
        return $this->db->get('kode')->result();

    }

    function search_subkode2( $kode)
    {
        //$kode = explode(".",$kode);
        $this->db->like('id_kode', $kode[0] . "." . $kode[1] . "." . $kode[2], 'after');
        $this->db->where('id_kode >=',$kode[0].".".$kode[1].".".$kode[2].".0");
        $this->db->order_by('id_kode', 'ASC');
        $this->db->limit(10);
        return $this->db->get('kode')->result();
    }
}
