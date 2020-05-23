<?php

class MY_Model extends CI_Model
{
    public function cekIdAvailable($id, $tipe)
    {
        if ($tipe === 'dokumen') {
            $this->db->where('id_dokumen', $id);
            $num_rows = $this->db->count_all_results('dokumen');
        } else if ($tipe === 'datapengguna') {
            $this->db->where('id_datapengguna', $id);
            $num_rows = $this->db->count_all_results('datapengguna');
        } else if ($tipe === 'disposisi') {
            $this->db->where('id_disposisi', $id);
            $num_rows = $this->db->count_all_results('disposisi');
        } else if ($tipe === 'userlogin') {
            $this->db->where('id_user', $id);
            $num_rows = $this->db->count_all_results('userlogin');
        } else if ($tipe === 'suratkeluar') {
            $this->db->where('id_suratkeluar', $id);
            $num_rows = $this->db->count_all_results('surat_keluar');
        } else if ($tipe === 'suratmasuk') {
            $this->db->where('id_suratmasuk', $id);
            $num_rows = $this->db->count_all_results('surat_masuk');
        } else if ($tipe === 'lupapass') {
            $this->db->where('id_lupapass', $id);
            $num_rows = $this->db->count_all_results('surat_masuk');
        } else {
            $this->db->where('id_log', $id);
            $num_rows = $this->db->count_all_results('log_activity');
        }
        if ($num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Fungsi untuk membuat ID secara acak dengan atau tidak menambah alias didalamnya seperti "AB1294asi03".
     * Fungsi ini akan melakukan looping jika ID yang didapatkan sama.
     * @param string $tipe
     * Variabel ini perlu di isi untuk mengecek tipe apa yang akan di cek.
     * - $tipe = 'log'
     * - $tipe = 'dokumen'
     * - $tipe = 'suratmasuk'
     * - $tipe = 'suratkeluar'
     * - $tipe = 'lupapass'
     * - $tipe = 'userlogin'
     * - $tipe = 'datapengguna'
     * - Nilai default null maka dia tidak akan mengecek availability dari ID.
     * @param integer $idsize
     * Ukuran ID tersebut. Jika ada alias maka alias akan masuk dalam ukuran tersebut. Contoh:
     * - $idsize=10, $alias="AA", Maka menjadi "AA12345678".
     * - $idsize=10, $alias=null, Maka menjadi "1234567890".
     * - Default $idsize=10. Jika variabel di isi selain integer maka nilai default.
     * @param string $alias
     * Alias untuk ID agar terdapat huruf khas di ID tersebut.
     * - Huruf Alias tidak boleh lebih dari $idsize atau ($idsize - 4).
     * - Jika ukuran kurang dari atau sama dengan 4 maka Alias di nonaktifkan.
     * - Default $alias = null.
     * @param string $positionAlias
     * Posisi Alias tersebut berada pada depan ID atau belakang ID.
     * - $positionAlias = "front", maka Alias akan berada pada depan ID.
     * - $positionAlias = "behind", maka Alias akan berada pada belakang ID
     * - Default $positionAlias = "front"
     * @return void
     */
    public function getIdRandom($tipe, $idsize = 10, $alias = null, $positionAlias = "front")
    {
        $len = strlen($alias);
        if ($idsize <= 4) {
            $alias = "";
            $len = 0;
        } else if ($len >= $idsize) {
            $slice = $len - ($len - $idsize + 4);
            $alias = substr($alias, 0, $slice);
            $len = $slice;
        }
        $id = bin2hex(random_bytes($idsize - $len));
        $id = substr($id,0,$idsize - $len);
        if (!empty($alias))
            $uid = $alias;
        else
            $uid = "";
        $result = true;

        while ($result) {
            if ($positionAlias === "behind")
                $cid = $id . $uid;
            else
                $cid = $uid . $id;
            if (!empty($tipe)) {
                $result = $this->cekIdAvailable($cid, $tipe);
                if ($result) {
                    $id = bin2hex(random_bytes($idsize - $len));
                    $id = substr($id,0,$idsize - $len);
                } else {
                    break;
                }
            }
            else {
                $result = true;
                break;
            }
        }
        return $cid;
    }

    /*
    ("LT001","New Account"),
    ("LT002","Delete Account"),
    ("LT003","Edit Account"),
    ("LT004","Change Password"),
    ("LT005","New Surat"),
    ("LT006","Edit Surat"),
    ("LT007","Delete Surat"),
    ("LT008","Upload Document"),
    ("LT009","Ban Account"),
    ("LT010","Unban Account"),
    ("LT011","Default Value");
    */

    /**
     * Membuat jejak kaki sebuah aksi pada website anda.
     *
     * @param string $tipe
     * Tipe berisi angka untuk identitas log. Di isi tiga digit nomor. Tipe yang ada adalah:
     * - 001 = New Account
     * - 002 = Delete Account
     * - 003 = Edit Account
     * - 004 = Change Password
     * - 005 = New Surat
     * - 006 = Edit Surat
     * - 007 = Delete Surat
     * - 008 = Upload Document
     * - 009 = Ban Account
     * - 010 = Unban Account
     * - 011 = Default Value
     * - Nilai diluar jangkauan akan menjadi nilai default. Nilai yang kurang dari tiga digit akan di konversi kan menjadi tiga digit.
     * @param string $desc
     * Deskripsi log yang dimasukkan atau berubah. Biasanya berisi siapa yang mengubah dll.
     * - Nilai default null. Jika null maka deskripsi tidak ada.
     * @return void
     */
    public function createLog($tipe = "011", $desc = null)
    {
        if (strlen($tipe) > 3) {
            $tipe = "011";
        } else if (strlen($tipe) < 3) {
            $tipe = sprintf("%03d", $tipe);
        }
        $temp = intval($tipe);
        if ($temp < 1 || $temp > 11) {
            $tipe = "011";
        }
        if (empty($data)) {
            $data = "undefined";
        }
        if (empty($desc)) {
            $desc = "undefined";
        }
        if (substr($tipe, 0, 2) != "LT") {
            $tipe = "LT" . $tipe;
        }
        $id = $this->getIdRandom('log', 20, 'LG');
        if (is_array($data)) {
            $data = print_r($data, true);
        }
        $data = array(
            'id_log' => $id,
            'id_logtipe' => $tipe,
            'description' => $desc
        );
        $this->db->insert('log_activity', $data);
    }
}
