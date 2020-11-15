 <section class="page-section" id="services">
     <div class="">

         <!-- jumbotron -->
         <div class="jumbotron jumbotron-fluid bg-dark">
             <?= !empty($_SESSION['message']) ? $_SESSION['message'] : "" ?>
             <div class="jumbotron-background">
                 <img src=<?= base_url(PATHIMG . 'bg1.svg') ?> class="blur" style="width: 100%; height: 100%;" alt="Sleman">
             </div>

             <div class="container text-white">

                 <div class="row">
                     <div class="col-lg-12 text-center">
                         <h2 class="section-heading text-uppercase mt-2 mb-4">Website Arsip Pemerintah Desa Condongcatur</h2>
                     </div>
                 </div>

                 <div class="row text-center">
                     <div class="col-md-6">
                         <a href="<?= base_url('registrasi-surat') ?>" style="text-decoration: none; color: white;">
                             <div class="d-none d-lg-block">
                                 <div class="button">
                                     <div class="icons">
                                         <i class="fas fa-save icon-default"></i>
                                         <i class="fa fa-arrow-circle-down icon-hover"></i>
                                     </div>
                                 </div>
                             </div>
                             <h4 class="service-heading">Simpan Arsip</h4>
                             <p class="">Simpan arsip anda berdasarkan kode surat.</p>
                         </a>
                     </div>
                     <div class="col-md-6">
                         <a href="<?= base_url('Arsip') ?>" style="text-decoration: none; color: white;">
                             <div class="d-none d-lg-block">
                                 <div class="button">
                                     <div class="icons">
                                         <i class="fas fa-search icon-default"></i>
                                         <i class="fa fa-arrow-circle-down icon-hover"></i>
                                     </div>
                                 </div>
                             </div>
                             <h4 class="service-heading">Telusuri Arsip</h4>
                             <p class="">Telusuri arsip anda yang tersimpan di website ini.</p>
                         </a>
                     </div>
                 </div>
             </div>
             <!-- /.container -->
         </div>
         <!-- /.jumbotron -->
         <!-- counter -->
         <div class="container">
             <div class="row">
                 <div class="col text-center mb-4 mt-3">
                     <h2>Jumlah Data Tersimpan</h2>
                 </div>
             </div>
             <div class="row text-center">
             
                 <div class="col">
                 <a href="<?= base_url('Arsip') ?>" style="text-decoration: none; color: black;">
                     <div class="counter">
                         <i class="fa fa-arrow-circle-down fa-2x"></i>
                         <h2 class="timer count-title count-number" data-to=<?= $count_sm ?> data-speed="1500"></h2>
                         <p class="count-text ">Surat Masuk</p>
                     </div>
                     </a>
                 </div>
            
                 <div class="col">
                 <a href="<?= base_url('Arsip') ?>" style="text-decoration: none; color: black;">
                     <div class="counter">
                         <i class="fa fa-arrow-circle-up fa-2x"></i>
                         <h2 class="timer count-title count-number" data-to=<?= $count_sk ?> data-speed="1500"></h2>
                         <p class="count-text ">Surat Keluar</p>
                     </div>
                 </a>
                 </div>
                 <!-- <div class="col">
                     <div class="counter">
                         <i class="fa fa-inbox fa-2x"></i>
                         <h2 class="timer count-title count-number" data-to=<?= $count_dp ?> data-speed="1500"></h2>
                         <p class="count-text ">Disposisi</p>
                     </div>
                 </div> -->
                 <div class="col">
                     <div class="counter">
                         <i class="fa fa-file fa-2x"></i>
                         <h2 class="timer count-title count-number" data-to=<?= $count_all ?> data-speed="1500"></h2>
                         <p class="count-text ">Total Arsip</p>
                     </div>
                 </div>
             </div>
         </div>
         <!-- end of counter -->

         <div class="container">

             <div class="row">
                 <div class="col text-center mb-4 mt-3">
                     <h2>Klasifikasi dan Kode Surat</h2>
                 </div>
             </div>

             <div class="table-responsive mb-5">
                 <table class="table">
                     <tbody>
                         <tr class="thead-dark">
                             <th scope='row'><b>140.0.0.0</b> PEMERINTAHAN DESA / KELURAHAN</th>
                         <tr>
                             <td><b>141.0.0.0</b> Pamong Desa, Meliputi: Pencalonan, Pemilihan, Meninggal, Pengangkatan, Pemberhenian.</td>
                         <tr>
                             <td><b>142.0.0.0</b> Penghasilan Pamong Desa</td>
                         <tr>
                             <td><b>143.0.0.0</b> Kekayaan Desa</td>
                         <tr>
                             <td><b>144.0.0.0</b> Dewan Tingkat Desa, Dewan Marga, Rembug Desa</td>
                         <tr>
                             <td><b>145.0.0.0</b> Administrasi Desa</td>
                         <tr>
                             <td><b>146.0.0.0</b> Kewilayahan</td>
                         <tr>
                             <td><b>146.1.0.0</b> Pembentukan Desa/Kelurahan</td>
                         <tr>
                             <td><b>146.2.0.0</b> Pemekaran Desa/Kelurahan</td>
                         <tr>
                             <td><b>146.3.0.0</b> Perubahan Batas Wilayah / Perluasan Desa / Kelurahan</td>
                         <tr>
                             <td><b>146.4.0.0</b> Perubahan Nama Desa / Kelurahan</td>
                         <tr>
                             <td><b>146.5.0.0</b> Kerjasama Antar Desa / Kelurahan</td>
                         <tr>
                             <td><b>147.0.0.0</b> Lembaga-lembaga Tingkat Desa</td>
                         <tr>
                             <td><b>148.0.0.0</b> Perangkat Kelurahan</td>
                         <tr>
                             <td><b>148.1.0.0</b> Kepala Kelurahan</td>
                         <tr>
                             <td><b>148.2.0.0</b> Sekretaris Kelurahan</td>
                         <tr>
                             <td><b>148.3.0.0</b> Staf Kelurahan</td>
                         <tr>
                             <td><b>149.0.0.0</b> Dewan Kelurahan</td>
                         <tr>
                             <td><b>149.1.0.0</b> Rukun Tetangga</td>
                         <tr>
                             <td><b>149.2.0.0</b> Rukun Warga</td>
                         <tr>
                             <td><b>149.3.0.0</b> Rukun Kampung</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>150.0.0.0</b> Legislatif MPR/DPR/DPD</th>
                         <tr>
                             <td><b>151.0.0.0</b> Keanggotaan MPR</td>
                         <tr>
                             <td><b>151.1.0.0</b> Pencalonan</td>
                         <tr>
                             <td><b>151.2.0.0</b> Pemberhentian</td>
                         <tr>
                             <td><b>151.3.0.0</b> Recall</td>
                         <tr>
                             <td><b>151.4.0.0</b> Pelanggaran</td>
                         <tr>
                             <td><b>152.0.0.0</b> Persidangan</td>
                         <tr>
                             <td><b>153.0.0.0</b> Kesejahteraan</td>
                         <tr>
                             <td><b>153.1.0.0</b> Keuangan</td>
                         <tr>
                             <td><b>153.2.0.0</b> Penghargaan</td>
                         <tr>
                             <td><b>154.0.0.0</b> Hak</td>
                         <tr>
                             <td><b>155.0.0.0</b> Keanggotaan DPR Pencalonan Pengangkatan</td>
                         <tr>
                             <td><b>156.0.0.0</b> Persidangan Sidang Pleno Dengan Pendapat / Rapat Komisi Reces</td>
                         <tr>
                             <td><b>157.0.0.0</b> Kesejahteraan</td>
                         <tr>
                             <td><b>157.1.0.0</b> Keuangan</td>
                         <tr>
                             <td><b>157.2.0.0</b> Penghargaan</td>
                         <tr>
                             <td><b>158.0.0.0</b> Jawaban Pemerintah</td>
                         <tr>
                             <td><b>159.0.0.0</b> Hak</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>160.0.0.0</b> DPRD PROVINSI TAMBAHKAN KODE WILAYAH</th>
                         <tr>
                             <td><b>161.0.0.0</b> Keanggotaan</td>
                         <tr>
                             <td><b>161.1.0.0</b> Pencalonan</td>
                         <tr>
                             <td><b>161.2.0.0</b> Pengangkatan</td>
                         <tr>
                             <td><b>161.3.0.0</b> Pemberhentian</td>
                         <tr>
                             <td><b>161.4.0.0</b> Recall</td>
                         <tr>
                             <td><b>161.5.0.0</b> Meninggal</td>
                         <tr>
                             <td><b>161.6.0.0</b> Pelanggaran</td>
                         <tr>
                             <td><b>162.0.0.0</b> Persidangan</td>
                         <tr>
                             <td><b>162.1.0.0</b> Reses</td>
                         <tr>
                             <td><b>163.0.0.0</b> Kesejahteraan</td>
                         <tr>
                             <td><b>163.1.0.0</b> Keuangan</td>
                         <tr>
                             <td><b>163.2.0.0</b> Penghargaan</td>
                         <tr>
                             <td><b>164.0.0.0</b> Hak</td>
                         <tr>
                             <td><b>165.0.0.0</b> Sekretaris DPRD Provinsi</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>170.0.0.0</b> DPRD KABUPATEN TAMBAHKAN KODE WILAYAH</th>
                         <tr>
                             <td><b>171.0.0.0</b> Keanggotaan</td>
                         <tr>
                             <td><b>171.1.0.0</b> Pencalonan</td>
                         <tr>
                             <td><b>171.2.0.0</b> Pengangkatan</td>
                         <tr>
                             <td><b>171.3.0.0</b> Pemberhentian</td>
                         <tr>
                             <td><b>171.4.0.0</b> Recall</td>
                         <tr>
                             <td><b>171.5.0.0</b> Pelanggaran</td>
                         <tr>
                             <td><b>172.0.0.0</b> Persidangan</td>
                         <tr>
                             <td><b>173.0.0.0</b> Kesejahteraan</td>
                         <tr>
                             <td><b>173.1.0.0</b> Keuangan</td>
                         <tr>
                             <td><b>173.2.0.0</b> Penghargaan</td>
                         <tr>
                             <td><b>174.0.0.0</b> Hak</td>
                         <tr>
                             <td><b>175.0.0.0</b> Sekretaris DPRD Kabupaten / Kota</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>180.0.0.0</b> HUKUM</th>
                         <tr>
                             <td><b>180.1.0.0</b> Konstitusi</td>
                         <tr>
                             <td><b>180.1.1.0</b> Dasar Negara</td>
                         <tr>
                             <td><b>180.1.2.0</b> Undang – Undang Dasar</td>
                         <tr>
                             <td><b>180.2.0.0</b> GBHN</td>
                         <tr>
                             <td><b>180.3.0.0</b> Amnesti, Abolisi, dan Grasi</td>
                         <tr>
                             <td><b>181.0.0.0</b> Perdata</td>
                         <tr>
                             <td><b>181.1.0.0</b> Tanah</td>
                         <tr>
                             <td><b>181.2.0.0</b> Rumah</td>
                         <tr>
                             <td><b>181.3.0.0</b> Utang / Piutang</td>
                         <tr>
                             <td><b>181.3.1.0</b> Gadai</td>
                         <tr>
                             <td><b>181.3.2.0</b> Hipotik</td>
                         <tr>
                             <td><b>181.4.0.0</b> Notariat</td>
                         <tr>
                             <td><b>182.0.0.0</b> Pidana</td>
                         <tr>
                             <td><b>182.1.0.0</b> Penyidik Pegawai Negeri Sipil (PPNS)</td>
                         <tr>
                             <td><b>183.0.0.0</b> Peradilan</td>
                         <tr>
                             <td><b>183.1.0.0</b> Bantuan Hukum</td>
                         <tr>
                             <td><b>184.0.0.0</b> Hukum International</td>
                         <tr>
                             <td><b>185.0.0.0</b> Imigrasi</td>
                         <tr>
                             <td><b>185.1.0.0</b> Visa</td>
                         <tr>
                             <td><b>185.2.0.0</b> Paspor</td>
                         <tr>
                             <td><b>185.3.0.0</b> Exit</td>
                         <tr>
                             <td><b>185.4.0.0</b> Reentry</td>
                         <tr>
                             <td><b>185.5.0.0</b> Lintas Batas / Batas antar Negara</td>
                         <tr>
                             <td><b>186.0.0.0</b> Kepenjaraan</td>
                         <tr>
                             <td><b>187.0.0.0</b> Kejaksaan</td>
                         <tr>
                             <td><b>188.0.0.0</b> Peraturan Perundang-undangan</td>
                         <tr>
                             <td><b>188.1.0.0</b> TAP MPR</td>
                         <tr>
                             <td><b>188.2.0.0</b> Undang-undang</td>
                         <tr>
                             <td><b>188.3.0.0</b> Peraturan</td>
                         <tr>
                             <td><b>188.3.1.0</b> Peraturan Pemerintah</td>
                         <tr>
                             <td><b>188.3.2.0</b> Peraturan Menteri</td>
                         <tr>
                             <td><b>188.3.3.0</b> Peraturan Lembaga Non Departemen</td>
                         <tr>
                             <td><b>188.3.4.0</b> Peraturan Daerah</td>
                         <tr>
                             <td><b>188.3.4.1</b> Peraturan</td>
                         <tr>
                             <td><b>188.3.4.2</b> Peraturan Kabupaten / Kota</td>
                         <tr>
                             <td><b>188.4.0.0</b> Keputusan</td>
                         <tr>
                             <td><b>188.4.1.0</b> Presiden</td>
                         <tr>
                             <td><b>188.4.2.0</b> Menteri</td>
                         <tr>
                             <td><b>188.4.3.0</b> Lembaga Non Departemen</td>
                         <tr>
                             <td><b>188.4.4.0</b> Gubernur</td>
                         <tr>
                             <td><b>188.4.5.0</b> Bupati / Walikota</td>
                         <tr>
                             <td><b>188.5.0.0</b> Instruksi</td>
                         <tr>
                             <td><b>188.5.1.0</b> Presiden</td>
                         <tr>
                             <td><b>188.5.2.0</b> Menteri</td>
                         <tr>
                             <td><b>188.5.3.0</b> Lembaga Non Departemen</td>
                         <tr>
                             <td><b>188.5.4.0</b> Gubernur</td>
                         <tr>
                             <td><b>188.5.5.0</b> Bupati / Walikota</td>
                         <tr>
                             <td><b>189.0.0.0</b> Hukum Adat</td>
                         <tr>
                             <td><b>189.1.0.0</b> Tokoh Adat / Masyarakat</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>190.0.0.0</b> HUBUNGAN LUAR NEGERI</th>
                         <tr>
                             <td><b>191.0.0.0</b> Perwakilan Asing</td>
                         <tr>
                             <td><b>192.0.0.0</b> Tamu Negara</td>
                         <tr>
                             <td><b>193.0.0.0</b> Kerjasama dengan Negara Asing</td>
                         <tr>
                             <td><b>193.1.0.0</b> Asean</td>
                         <tr>
                             <td><b>193.2.0.0</b> Bamtuan Luar Negeri / Hibah</td>
                         <tr>
                             <td><b>194.0.0.0</b> Perwakilan RI DI Luar Negeri / Hibah</td>
                         <tr>
                             <td><b>195.0.0.0</b> PBB</td>
                         <tr>
                             <td><b>196.0.0.0</b> Laporan Luar Negeri</td>
                         <tr>
                             <td><b>197.0.0.0</b> Hutang Luar Negeri PHLN / LOAN</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>200.0.0.0</b> POLITIK</th>
                         <tr>
                             <td><b>201.0.0.0</b> Kebijaksanaan Umum</td>
                         <tr>
                             <td><b>202.0.0.0</b> Orde Baru</td>
                         <tr>
                             <td><b>203.0.0.0</b> Reformasi</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>210.0.0.0</b> KEPARTAIAN</th>
                         <tr>
                             <td><b>211.0.0.0</b> Lambang Partai</td>
                         <tr>
                             <td><b>212.0.0.0</b> Kartu Tanda Anggota</td>
                         <tr>
                             <td><b>213.0.0.0</b> Bantuan Keuangan Parpol</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>220.0.0.0</b> ORGANISASI KEMASYARAKATAN</th>
                         <tr>
                             <td><b>221.0.0.0</b> Berdasarkan Perjuangan</td>
                         <tr>
                             <td><b>221.1.0.0</b> Perintis Kemerdekaan</td>
                         <tr>
                             <td><b>221.2.0.0</b> Angkatan 45</td>
                         <tr>
                             <td><b>221.3.0.0</b> Veteran</td>
                         <tr>
                             <td><b>222.0.0.0</b> Berdasarkan Kekaryaan</td>
                         <tr>
                             <td><b>222.1.0.0</b> PEPBAPKI</td>
                         <tr>
                             <td><b>222.2.0.0</b> Wredatama</td>
                         <tr>
                             <td><b>223.0.0.0</b> Berdasarkan Kerohanian</td>
                         <tr>
                             <td><b>224.0.0.0</b> Lembaga Adat</td>
                         <tr>
                             <td><b>225.0.0.0</b> Lembaga Swadaya Masyarakat</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>230.0.0.0</b> ORGANISASI PROFESI DAN FUNGSIONAL</th>
                         <tr>
                             <td><b>231.0.0.0</b> Ikatan Dokter Indonesia</td>
                         <tr>
                             <td><b>232.0.0.0</b> Persatuan Guru Republik Indonesia</td>
                         <tr>
                             <td><b>233.0.0.0</b> PERSATUAN SARJANA HUKUM INDONESIA</td>
                         <tr>
                             <td><b>234.0.0.0</b> Persatuan Advokat Indonesia</td>
                         <tr>
                             <td><b>235.0.0.0</b> Lembaga Bantuan Hukum</td>
                         <tr>
                             <td><b>236.0.0.0</b> Korps Pegawai Republik Indonesia</td>
                         <tr>
                             <td><b>237.0.0.0</b> Persatuan Wartawan Indonesia</td>
                         <tr>
                             <td><b>238.0.0.0</b> Ikatan Cendekiawan Muslim Indonesia (ICMII)</td>
                         <tr>
                             <td><b>239.0.0.0</b> Organisasi Profesi dan Fungsional lainnya</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>240.0.0.0</b> ORGANISASI PEMUDA</th>
                         <tr>
                             <td><b>241.0.0.0</b> Komite Nasional Pemuda Indonesia</td>
                         <tr>
                             <td><b>242.0.0.0</b> Organisasi Mahasiswa</td>
                         <tr>
                             <td><b>243.0.0.0</b> Organisasi Pelajar</td>
                         <tr>
                             <td><b>244.0.0.0</b> Gerakan Pemuda Ansor</td>
                         <tr>
                             <td><b>245.0.0.0</b> Gerakan Pemuda Islam Indonesia</td>
                         <tr>
                             <td><b>246.0.0.0</b> Gerakan Pemuda Marhaenis</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>250.0.0.0</b> ORGANISASI BURUH, TANI, NELAYAN DAN ANGKUTAN</th>
                         <tr>
                             <td><b>251.0.0.0</b> Federasi Buruh Seluruh Indonesia</td>
                         <tr>
                             <td><b>252.0.0.0</b> Organisasi Buruh International</td>
                         <tr>
                             <td><b>253.0.0.0</b> Himpunan Kerukunan Tani Indonesia</td>
                         <tr>
                             <td><b>254.0.0.0</b> Himpunan Nelayan Seluruh Indonesia</td>
                         <tr>
                             <td><b>255.0.0.0</b> Keluarga Supir Proposional Seluruh Indoneisa (SPSI)</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>260.0.0.0</b> ORGANISASI WANITA</th>
                         <tr>
                             <td><b>261.0.0.0</b> Dharma Wanita</td>
                         <tr>
                             <td><b>262.0.0.0</b> Persatuan Wanita Indonesia</td>
                         <tr>
                             <td><b>263.0.0.0</b> Pemberdayaan Perempuan (Wanita)</td>
                         <tr>
                             <td><b>264.0.0.0</b> Kongres Wanita</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>270.0.0.0</b> PEMILIHAN UMUM</th>
                         <tr>
                             <td><b>271.0.0.0</b> Pencalonan</td>
                         <tr>
                             <td><b>272.0.0.0</b> Nomor Urut Partai / Tanda Gambar </td>
                         <tr>
                             <td><b>273.0.0.0</b> Kampanye</td>
                         <tr>
                             <td><b>274.0.0.0</b> Petugas Pemilu</td>
                         <tr>
                             <td><b>275.0.0.0</b> Pemilih / Daftar Pemilh</td>
                         <tr>
                             <td><b>276.0.0.0</b> Sarana</td>
                         <tr>
                             <td><b>276.1.0.0</b> TPS</td>
                         <tr>
                             <td><b>276.2.0.0</b> Kendaraan</td>
                         <tr>
                             <td><b>276.3.0.0</b> Surat Suara</td>
                         <tr>
                             <td><b>276.4.0.0</b> Kotak Suara</td>
                         <tr>
                             <td><b>276.5.0.0</b> Dana</td>
                         <tr>
                             <td><b>277.0.0.0</b> Pemungutan Suara / Penghitungan Suara</td>
                         <tr>
                             <td><b>278.0.0.0</b> Penetapan Hasil Pemilu</td>
                         <tr>
                             <td><b>279.0.0.0</b> Penetapan Perolehan Jumlah Kursi Dan Calon Terpilih</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>280.0.0.0</b> Pengucapan Sumpah Janji MPR, DPR, DPD</th>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>300.0.0.0</b> KEAMANAN / KETERTIBAN</th>
                         <tr>
                             <td><b>301.0.0.0</b> Keamanan</td>
                         <tr>
                             <td><b>302.0.0.0</b> Ketertiban</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>310.0.0.0</b> PERTAHANAN</th>
                         <tr>
                             <td><b>311.0.0.0</b> Darat</td>
                         <tr>
                             <td><b>312.0.0.0</b> Laut</td>
                         <tr>
                             <td><b>313.0.0.0</b> Udara</td>
                         <tr>
                             <td><b>314.0.0.0</b> Perbatasan</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>320.0.0.0</b> KEMILITERAN</th>
                         <tr>
                             <td><b>321.0.0.0</b> Latihan Militer</td>
                         <tr>
                             <td><b>322.0.0.0</b> Wajib Militer</td>
                         <tr>
                             <td><b>323.0.0.0</b> Operasi Militer</td>
                         <tr>
                             <td><b>324.0.0.0</b> Kekayaan TNI Pejabat Sipil dari TNI</td>
                         <tr>
                             <td><b>324.1.0.0</b> TMMD</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>330.0.0.0</b> KEAMANAN</th>
                         <tr>
                             <td><b>331.0.0.0</b> Kepolisian</td>
                         <tr>
                             <td><b>331.1.0.0</b> Polisi Pamong Praja</td>
                         <tr>
                             <td><b>331.2.0.0</b> Kamra</td>
                         <tr>
                             <td><b>331.3.0.0</b> Kamling</td>
                         <tr>
                             <td><b>331.4.0.0</b> Jaga Wana</td>
                         <tr>
                             <td><b>332.0.0.0</b> Huru – hara / Demonstrasi</td>
                         <tr>
                             <td><b>333.0.0.0</b> Senjata Api / Tajam</td>
                         <tr>
                             <td><b>334.0.0.0</b> Bahan Peledak</td>
                         <tr>
                             <td><b>335.0.0.0</b> Surat- surat kaleng</td>
                         <tr>
                             <td><b>336.0.0.0</b> Perjudian</td>
                         <tr>
                             <td><b>337.0.0.0</b> Pengaduan</td>
                         <tr>
                             <td><b>338.0.0.0</b> Himbauan / Larangan</td>
                         <tr>
                             <td><b>339.0.0.0</b> Terroris</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>340.0.0.0</b> PERTAHANAN SIPIL</th>
                         <tr>
                             <td><b>341.0.0.0</b> Perlindungan Sipil</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>350.0.0.0</b> KEJAHATAN</th>
                         <tr>
                             <td><b>351.0.0.0</b> Makar / Pemberontakan</td>
                         <tr>
                             <td><b>352.0.0.0</b> Pembunuhan</td>
                         <tr>
                             <td><b>353.0.0.0</b> Penganiayaan, Pencurian</td>
                         <tr>
                             <td><b>354.0.0.0</b> Subversi / Penyelundupan / Narkotika</td>
                         <tr>
                             <td><b>355.0.0.0</b> Pemalsuan</td>
                         <tr>
                             <td><b>356.0.0.0</b> Korupsi / Penyelewengan / Penyalahgunaan / Penyalahgunaan Jabatan</td>
                         <tr>
                             <td><b>357.0.0.0</b> Perkosaan / Perbuatan Cabul</td>
                         <tr>
                             <td><b>358.0.0.0</b> Kenakalan</td>
                         <tr>
                             <td><b>359.0.0.0</b> Kejahatan Lainnya</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>360.0.0.0</b> BENCANA</th>
                         <tr>
                             <td><b>361.0.0.0</b> Gunung Berapi / Gempa</td>
                         <tr>
                             <td><b>362.0.0.0</b> Banjir / Tanah Longsor</td>
                         <tr>
                             <td><b>363.0.0.0</b> Angin Topan</td>
                         <tr>
                             <td><b>364.0.0.0</b> Kebakaran</td>
                         <tr>
                             <td><b>364.1.0.0</b> Pemadam Kebakaran</td>
                         <tr>
                             <td><b>365.0.0.0</b> Kekeringan</td>
                         <tr>
                             <td><b>366.0.0.0</b> Tsunami</td>
                         </tr>
                         <tr class="thead-dark">
                             <th scope='row'><b>370.0.0.0</b> KECELAKAAN / SAR</th>
                         <tr>
                             <td><b>371.0.0.0</b> Darat</td>
                         <tr>
                             <td><b>372.0.0.0</b> Udara</td>
                         <tr>
                             <td><b>373.0.0.0</b> Laut</td>
                         <tr>
                             <td><b>374.0.0.0</b> Sungai / Danau</td>

                     </tbody>
                 </table>

             </div>
         </div>

     </div>
 </section>