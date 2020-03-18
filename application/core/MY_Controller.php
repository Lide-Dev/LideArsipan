<?php

/**
 * Kelas untuk inisialisasi semua page.
 */
class MY_Controller extends CI_Controller
{

    /**
     * Fungsi untuk konfigurasi sebuah data page.
     *
     * @param string $page Nama alias dari page tersebut.
     * @param string $title Judul page tersebut yang akan muncul pada tab browser
     * @param boolean $footerext Menambahkan footer link, copyright dan lain-lain jika nilai "true"
     * @return array Pengembalian akan berbentuk array $data['...']
     */
    public function initConfig($page, $title = null, $footerext = true)
    {
        strtolower($page);
        if (!empty($page)) {
            $data['page'] = $page;
        } else {
            $data['page'] = "undefined";
        }

        if (!empty($title)) {
            $data['title'] = $title;
        } else {
            $data['title'] = "Lide Arsipan";
        }

        if (is_bool($footerext) && $footerext === true) {
            $data['footerext'] = true;
        }


        return $data;
    }

    /**
     * Fungsi untuk mengkonfigurasi modal pada page. Jika anda tahu modal bootstrap, disini adalah cara instan untuk konfigurasi
     * modal agar bisa dipakai di page mana saja dengan keterangan yang berbeda-beda
     *
     * @param array $config Data konfigurasi.
     * - Konfigurasi modal di $config[] sebagai berikut:
     * @param string $config['title'] Untuk mengatur judul modal. Nilai default "" atau tidak ada judul.
     * @param string $config['id']['modal']
     * ID modal untuk mengkonfigurasi jalannya modal. Biasanya diperlukan pada button untuk memunculkan modal dll. Nilai
     * default "modalID".
     * @param string $config['id']['form']
     * ID form untuk mengkonfigurasi jalannya modal. Biasanya diperlukan pada form untuk seluruh modal. Nilai
     * default "formID".
     * @param string $config['id']['ok']
     * ID button ok untuk mengkonfigurasi jalannya modal. Nilai default "okID".
     * @param string $config['id']['cancel']
     * ID button cancel untuk mengkonfigurasi jalannya modal. Nilai default "cancelID".
     * @param string $config['id']['option3']
     * ID button option ke tiga untuk mengkonfigurasi jalannya modal. Nilai default "option3ID"
     * @param boolean $config['dialog_center']
     * Membuat tampilan modal menjadi ketengah. Nilai default "false"
     * @param string||URI $config['load']
     * Isi konten modal untuk penulisan dengan library load CI. Nilai default adalah pernyataan warning.
     * @param string||URI $config['loaddata']
     * Isi konten modal untuk penulisan dengan library load CI. Ini adalah bagian datanya. Jika kosong maka data tidak ada.
     * @param string||HTML $config['body']
     * Isi konten modal untuk penulisan manual tanpa library load CI. Perlu diketahui bahwa jika load terdefinisi maka
     * body tidak akan terpanggil. Nilai default sama seperti load.
     * @param string $config['text']['ok'='Accept'||'cancel'='Cancel'||'option3'='Tambahan']
     * Text pilihan OK,Cancel, dan Option 3 yang akan ditampilkan pada modal. Nilai default pasti ada.
     * @param string $config['color']['ok'='btn-primary'||'cancel'='btn-danger'||'option3'='btn-secondary']
     * Pewarnaan button untuk pilihan OK,Cancel,Option 3 yang akan ditampilkan pada modal. Pewarnaan sesuai btn Bootstrap
     * @param boolean $config['show']['ok'=true||'cancel'=true||'option3'=false||'form'=false]
     * Menampilkan pilihan ok,cancel,option3,form untuk modal.
     *
     *
     * @return array Konfigurasi modal tersebut pastikan disimpan dengan array seperti ini $namavariabel['modal'].
     */
    public function initModal($config = null)
    {
        if (empty($config['title'])) {
            $config['title'] = "";
        }

        if (empty($config['id']['modal'])) {
            $config['id']['modal'] = "modalID";
        }
        if (empty($config['id']['form'])) {
            $config['id']['form'] = "formID";
        }
        if (empty($config['id']['ok'])) {
            $config['id']['ok'] = "okID";
        }
        if (empty($config['id']['cancel'])) {
            $config['id']['cancel'] = "cancelID";
        }
        if (empty($config['id']['option3'])) {
            $config['id']['option3'] = "option3ID";
        }

        if (empty($config['text']['ok'])) {
            $config['text']['ok'] = "Accept";
        }
        if (empty($config['text']['cancel'])) {
            $config['text']['cancel'] = "Cancel";
        }
        if (empty($config['text']['option3'])) {
            $config['text']['option3'] = "Tambahan";
        }

        if (empty($config['color']['ok'])) {
            $config['color']['ok'] = "btn-primary";
        }
        if (empty($config['color']['cancel'])) {
            $config['color']['cancel'] = "btn-danger";
        }
        if (empty($config['color']['option3'])) {
            $config['color']['option3'] = "btn-secondary";
        }

        if (empty($config['load'])) {
            if (empty($config['body'])) {
                $config["body"] = "There is no description.";
            }
        } else {
            if (!empty($config["loaddata"]))
                $config["body"] = $this->load->view($config['load'], $config["loaddata"], true);
            else
                $config["body"] = $this->load->view($config['load'], "", true);
        }

        if (empty($config['dialog_center'])) {
            $config['dialog_center'] = "";
        } else {
            is_bool($config['dialog_center']) ? $config['dialog_center'] = "modal-dialog-centered" : $config['dialog_center'] = "";
        }

        if (empty($config['show']['ok'])) {
            $config['show']['ok'] = 1;
        } else {
            if (!is_bool($config['show']['ok'])) {
                $config['show']['ok'] = 1;
            }
        }

        if (empty($config['show']['cancel'])) {
            $config['show']['cancel'] = 1;
        } else {
            if (!is_bool($config['show']['cancel'])) {
                $config['show']['cancel'] = 1;
            }
        }

        if (empty($config['show']['option3'])) {
            $config['show']['option3'] = 0;
        } else {
            if (!is_bool($config['show']['option3'])) {
                $config['show']['option3'] = 0;
            }
        }

        if (empty($config['show']['form'])) {
            $config['show']['form'] = 0;
        } else {
            if (!is_bool($config['show']['form'])) {
                $config['show']['form'] = 0;
            }
        }

        return $config;
    }

    /**
     * Fungsi ini untuk menginisialisasi sebuah view page yang akan di outputkan ke browser.
     *
     * @param string $pageURI URI untuk view page yang ingin ditampilkan.
     * @param array $config Konfigurasi page yang ingin ditampilkan. Yang diperlukan adalah :
     * - Page : Untuk konfigurasi seperti pemilahan JS dan CSS agar tidak terjadi konflik.
     * - Semua ada pada fungsi initConfig(). Jadi pastikan fungsi ini dipanggil sebelum initConfig()
     * @param boolean $navbar Konfigurasi navbar. Jika "TRUE" maka akan ditampilkan navbarnya. Default nilainya "TRUE".
     * @param boolean $sidebar Konfigurasi sidebar. Jika "TRUE" maka akan ditampilkan sidebarnya. Default nilainya "TRUE".
     * @param boolean $modal Konfigurasi modal. Jika "TRUE" maka akan ditampilkan modalnya. Default nilainya "TRUE".
     * - Perlu diingat untuk konfigurasi modal perlu memanggil fungsi initModal().
     * - Konfigurasi disimpan di variable seperti => $data['modal']
     * @return void
     */
    public function initView($pageURI, $config, $navbar = true, $sidebar = true, $modal = false,$login= false)
    {
        if (empty($_SESSION['idlogin'])){
            if ($pageURI==="login/index"){
                $message = "Anda telah logout dari Arsip ini. Silahkan login lagi.";
                $this->messagePage($message,1);
                $this->load->view('templates/header', $config);

                if ($navbar)
                    $this->load->view('templates/sidebar', $config);
                if ($sidebar)
                    $this->load->view('templates/navbar', $config);
        
                $this->load->view($pageURI, $config);
                if ($modal)
                    $this->load->view('templates/modal', $config);
                $this->load->view('templates/footer', $config);
            }
            else{
                $message = "Anda telah logout dari Arsip ini. Silahkan login lagi.";
                header('Location: '.base_url("login"));
                $this->messagePage($message,1);
            }

        }
        else{
        $this->load->view('templates/header', $config);

        if ($navbar)
            $this->load->view('templates/sidebar', $config);
        if ($sidebar)
            $this->load->view('templates/navbar', $config);

        $this->load->view($pageURI, $config);
        if ($modal)
            $this->load->view('templates/modal', $config);
        $this->load->view('templates/footer', $config);
        }
    }

    /**
     * Fungsi untuk memanggil sebuah pesan informasi pada page seperti pemberitahuan info login dll.
     *
     * @param string $message
     * @param integer $type
     * - 1 : Tipe info.
     * - 2 : Tipe warning.
     * - 3 : Tipe danger.
     * @return array
     * konten dari message tersebut.
     */
    public function messagePage($message, $type)
    {
        if ($type === 1) {
            $colormessage='bg-info';
            $tcolormessage='text-white';
        } else if ($type === 2) {
            $colormessage= 'bg-warning';
            $tcolormessage= 'text-white';
        } else {
            $colormessage= 'bg-danger';
            $tcolormessage='text-white';
        }

        $config = array(
            'messagepage' => $message,
            'colormessage' => $colormessage,
            'tcolormessage' => $tcolormessage
        );

        $message = $this->load->view('templates/message', $config,true);
        $this->session->set_flashdata('message', $message);
    }
}

?>