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
    public function initConfig($page, $title = null, $footerext = true, $admin = false)
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
            $data['title'] = "Condongcatur";
        }

        if (is_bool($footerext) && $footerext === true) {
            $data['footerext'] = true;
        }

        if (is_bool($admin) && $admin === true) {
            $data['admin'] = true;
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
     * Menvalidasi role pengguna. Sangat berguna untuk inisialisasi page yang mempunyai permission.
     * Perlu diketahui key array config harus sama dengan yang ada di jelaskan dibawah. Jika config
     * string maka yang akan dikomparasi adalah semua key walaupun $mode = 'key'.
     *
     * @param array|string $config
     * v.1
     * - Array key pada config:
     * 1. 'r_arsip' = Read Arsip
     * 2. 'w_suratmasuk' / 'w_suratkeluar' / 'w_disposisi' = Write Arsip sesuai tipe (Perlu dimasukkan semua jika komparasi key ini)
     * 3. 'dt_arsip' = Delete Temporary Arsip
     * 4. 'dtu_arsip' = Delete Temporary Arsip hanya berlaku untuk Arsip yang di Upload pengguna akun
     * 5. 'dp_arsip' = Delete Permanent Arsip
     * 6. 'admin' = Akses Page Admin dan fitur-fitur lainnya.
     * - String key pada config: 'admin', 'operator', 'chief', 'member'
     * 
     * v.2
     * - Array key pada config:
     * 1. 'r_arsip' = Read Arsip
     * 2. 'w_arsip' / 'w_disposisi' = Write Arsip sesuai tipe (Perlu dimasukkan semua jika komparasi key ini)
     * 3. 'dt_arsip' = Delete Temporary Arsip
     * 4. 'dtu_arsip' = Delete Temporary Arsip hanya berlaku untuk Arsip yang di Upload pengguna akun
     * 5. 'dp_arsip' = Delete Permanent Arsip
     * 6. 'admin' = Akses Page Admin dan fitur-fitur lainnya.
     * - String key pada config: 'admin', 'operator', 'chief', 'member'
     *
     * @param string $mode
     * - Mode komparasi antar array. Ada dua value:
     * 1. 'all' = Mengkomparasi semua array role permission dengan array $config
     * 2. 'key' (Default) = Mengkomparasi beberapa array tergantung key yang dimasukkan.
     * @return array
     * - Pengembalian key array:
     * 1. 'valid' = Bertipe bool. Mengembalikan validasi role.
     * 2. 'upermission' =  Bertipe array. Mengembalikan data permission dari user.
     *
     */
    public function roleValidate($config, $mode = 'key')
    {
        $this->load->model('model_login', 'mdl');
        $this->load->model('model_datapengguna', 'mdp');
        //$init = $this->mdp->getAllRole();

        if (empty($configv) && !is_array($config)) {
            $configv = [
                'r_arsip' => 0,
                'w_arsip' => 0,
                'w_disposisi' => 0,
                'dt_arsip' => 0,
                'dtu_arsip' => 0,
                'dp_arsip' => 0,
                'admin' => 0
            ];
        } else {
            $configv = $config;
            unset($configv['id_role']);
            unset($configv['nama']);
        }
       // print_r($configv);
        $permission = (array) $this->rolePermission($_SESSION['idlogin']);
        $valid = true;
        $validarr=[];
        if (empty($config)) {
            $valid = false;
        } else {
            if ($mode === 'all')
                $valid = ($permission === $configv);
            else {
                foreach ($configv as $key => $value) {
                    $perm_key= array_keys($permission);
                    if (in_array($key,$perm_key)) {
                        array_push($validarr, (intval($permission[$key]) === 1));
                    }
                }
                if (empty($validarr)){
                    $valid=false;
                }
                else{
                    $valid = !in_array(false,$validarr);
                }
            }
        }

        return array('valid' => $valid, 'upermission' => $permission);
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
     * @param boolean $landing Konfigurasi agar landing page tidak ke login.
     * @return void
     */
    public function initView($pageURI, $config, $navbar = true, $sidebar = true, $modal = false, $landing = false)
    {
        $this->load->model('model_login', 'mdl');
        $this->load->model('model_datapengguna', 'mdp');
        $config['sidebar'] = $sidebar;
        $config['landing'] = $landing;
        if ($landing) {
            $this->load->view('templates/header', $config);

            if ($sidebar)
                $this->load->view('templates/sidebar', $config);
            if ($navbar)
                $this->load->view('templates/navbar', $config);

            $this->load->view($pageURI, $config);
            if ($modal)
                $this->load->view('templates/modal', $config);
            $this->load->view('templates/footer', $config);
        } else {
            if (empty($_SESSION['idlogin'])) {
                if ($pageURI === "login/index") {
                    // $message = "Anda telah logout dari Arsip ini. Silahkan login lagi.";
                    // $this->messagePage($message, 1);
                    $this->load->view('templates/header', $config);

                    if ($sidebar)
                        $this->load->view('templates/sidebar', $config);
                    if ($navbar)
                        $this->load->view('templates/navbar', $config);


                    $this->load->view($pageURI, $config);
                    if ($modal)
                        $this->load->view('templates/modal', $config);

                    $this->load->view('templates/footer', $config);
                } else {
                    $message = "Anda telah logout dari Arsip ini. Silahkan login lagi.";
                    header('Location: ' . base_url("login"));
                    $this->messagePage($message, 1);
                }
            } else {

                $permission = $this->rolePermission($_SESSION['idlogin']);
                $config['permission'] = $permission;
                $accadmin = $permission->admin;

                $row = $this->mdl->validBan($_SESSION['idlogin']);
                empty($row) ? '' : $bandate = strtotime($row->finish_date);
                $date = strtotime(date("Y-m-d H:i:s"));
                //echo $config['admin'].$accadmin;
                if ((!empty($config['admin']) && $config['admin']) && ($accadmin == 0)) {

                    $config['title'] = 'Tidak di Ijinkan';
                    $config['code'] = '403';
                    $config['desc'] = 'Mohon maaf kami tidak bisa membawa anda kesana karena masalah perijinan.';
                    $this->errorPage($config);
                } else if (!empty($row) && $date < $bandate) {
                    $message = "Anda telah di ban sampai tanggal " . date("d-m-Y", strtotime($row->finish_date)) . " dengan alasan: " . $row->alasan;
                    header('Location: ' . base_url("login"));
                    $this->messagePage($message, 3);
                } else {
                    $this->load->view('templates/header', $config);
                    if ($sidebar) {
                        if (!empty($config['admin']) && $config['admin'])
                            $this->load->view('templates/sidebar_admin', $config);
                        else
                            $this->load->view('templates/sidebar', $config);
                    }


                    if ($navbar) {
                        if (!empty($config['admin']) && $config['admin'])
                            $this->load->view('templates/navbar_admin', $config);
                        else
                            $this->load->view('templates/navbar', $config);
                    }

                    $this->load->view($pageURI, $config);
                    if ($modal)
                        $this->load->view('templates/modal', $config);
                    $this->load->view('templates/footer', $config);
                }
            }
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
     * - Panggil message ke view dengan $this->session->flashdata('message')
     */
    public function messagePage($message, $type)
    {
        if ($type === 1) {
            $colormessage = 'bg-info';
            $tcolormessage = 'text-white';
        } else if ($type === 2) {
            $colormessage = 'bg-warning';
            $tcolormessage = 'text-white';
        } else {
            $colormessage = 'bg-danger';
            $tcolormessage = 'text-white';
        }

        $config = array(
            'messagepage' => $message,
            'colormessage' => $colormessage,
            'tcolormessage' => $tcolormessage
        );

        $message = $this->load->view('templates/message', $config, true);
        $this->session->set_flashdata('message', $message);
    }

    /**
     * Fungsi untuk membawa user ke page Error.
     *
     * @param array $config
     * - Konfigurasi untuk page error. Mempunyai nilai default.
     * - $config['title'] : Judul page error.
     * - $config['code'] : Code response dari page error tadi.
     * - $config['desc'] : Deskripsi error.
     * @return void
     */
    public function errorPage($config)
    {
        if (empty($config['title']))
            $config['title'] = 'Kesalahan Halaman';
        if (empty($config['code']))
            $config['code'] = '404';
        if (empty($config['desc']))
            $config['desc'] = 'Terjadi sebuah kesalahan pada halaman web ini. Coba di refresh page atau perhatikan
        url web dengan benar. Jika masih berlanjut cobalah kontak admin web ini';

        $this->session->set_flashdata('configer', $config);
        redirect(base_url('error'));
    }

    /**
     * Fungsi untuk memberikan validasi fungsi jika ini adalah request AJAX
     *
     * @return void
     */
    public function ajaxFunction()
    {
        if (!$this->input->is_ajax_request()) {
            $config['title'] = 'Tidak di Ijinkan';
            $config['code'] = '403';
            $config['desc'] = 'Mohon maaf kami tidak bisa membawa anda kesana karena masalah perijinan';
            $this->errorPage($config);
        }
    }

    /**
     * Fungsi untuk mendapatkan data permission user bisa melakukan aksi apa saja di sistem ini.
     *
     * @param string $id_user
     * - Id yang sedang login.
     * @return object Data permission akan dikembalikan didalamnya. Key array dijelaskan dibawah:
     * - r_arsip = Read Arsip
     * - w_suratmasuk / w_suratkeluar / w_disposisi = Write Arsip sesuai tipe
     * - dt_arsip = Delete Temporary Arsip
     * - dtu_arsip = Delete Temporary Arsip hanya berlaku untuk Arsip yang di Upload pengguna akun
     * - dp_arsip = Delete Permanent Arsip
     * - admin = Akses Page Admin dan fitur-fitur lainnya
     */
    public function rolePermission($id_user)
    {
        //echo $id_user;
        $this->load->model('model_login', 'mdl');
        $this->load->model('model_datapengguna', 'mdp');
        $user = $this->mdl->getDataUser($id_user);
        $dp = $this->mdp->GetUserbyIDUser($user->id_user, 'id_jabatan');
        $this->load->model('model_role', 'mr');
        $data = $this->mr->getRole($dp->id_jabatan);
        return $data;
    }
}
