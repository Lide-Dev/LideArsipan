<div class="container mb-5">
    <div class="container">
        <div id="flip_arsip" class="bg-white mt-2 text-center">
            <div class="col-md-12"><i class="fa fa-search" aria-hidden="true"></i> <strong>Klik disini untuk memulai pencarian</strong></div>
            <div class="col-md-12"><i id="chevron_nav" class="fas fa-chevron-down fa-lg"></i></div>
        </div>

        <div id="panel_arsip">
            <div class="card shadow mb-2 bg-white rounded">
                <!--Card-Body-->
                <div class="mt-2 mb-2">
                    <div id="div_container_kode" class="container p-3">
                        <div class="row">
                            <div class="col-md-6">
                                <p id="kode">Kode yang dipilih: 000/0/0/0</p>
                            </div>
                            <div class="col-md-6">
                                <p id="tentang">Tentang: Belum dipilih</p>
                            </div>
                        </div>
                        <div class="form-row" id="form_row">
                            <div id="div_form_kategori" class="form-group col-md-6 ">
                                <label class="" for="form_kategori">Kategori</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-search" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="form_kategori" name="kategori">
                                </div>


                            </div>
                            <div id="div_form_kode" class="form-group col-md-6" style="display: none">
                                <label for="form_kode">Kode Utama</label>
                                <select class="form-control" id="form_kode">
                                </select>
                            </div>
                            <div id="div_form_subkode1" class="form-group col-md-6" style="display: none">
                                <label for="form_subkode1">Sub Kode 1</label>
                                <select class="form-control" id="form_subkode1">
                                </select>
                            </div>
                            <div id="div_form_subkode2" class="form-group col-md-6" style="display: none">
                                <label for="form_subkode2">Sub Kode 2</label>
                                <select class="form-control" id="form_subkode2">
                                </select>
                            </div>
                            <div id="div_form_done" class="form-group col-md-6" style="display: none">
                                <p class=" font-weight-bold">Tidak terdapat pilihan lagi.</p>
                            </div>
                            <small class="form-text text-white col-md-12">Pemilihan kode surat awalnya memilih kategori. Setelah itu kode utama dan seterusnya.</small>
                            <small id="div_form_count" class="form-text text-warning col-md-12 text-center">Tombol akan aktif jika telah memilih kategori!</small>
                            <label id='form-kategori-error' class="form-text error col-md-12" for="form_kategori"></label>
                        </div>
                    </div>
                    <div id="div_container_donekode" class="container border border-hintofelusive rounded pt-3" style="display: none">
                        <div class="row">
                            <p class="col-md-6">Kode yang dipilih adalah: <b id="kode_pilih"></b></p>
                            <p class="col-md-6">Deskripsi Kode: <b id="tentang_pilih"></b></p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2 text-center">
                            <span class="d-none d-md-inline-block">
                                <button id="" type="button" class="btn btn-success btn-md btn_form_pilih" disabled>
                                    <span class="fas fa-search"></span> Cari
                                </button>
                            </span>
                            <span class="d-none d-md-inline-block">
                                <button id="" type="button" class="btn btn-danger btn-md btn_form_ulang" disabled><span class="fas fa-times"> </span> Ulang</button>
                            </span>
                            <button id="" type="button" class="btn btn-success btn-md d-md-none btn_form_pilih" disabled><span class="fas fa-check"></span></button>
                            <button id="" type="button" class="btn btn-danger btn-md d-md-none btn_form_ulang" disabled><span class="fas fa-times"></span></button>
                            <!-- button type="button" class="btn btn-freespeechblue px-3" disabled>Pilih</button -->
                        </div>
                    </div>
                </div>
                <!-- End Form -->
            </div>
        </div>
    </div>

    <!-- Menu Surat -->
    <div class="p-3">
    <section class="page-section" id="services">
    <div class="container border border-hintofelusive rounded p-3">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h4 class="section-heading text-uppercase mt-2 mb-4">Pilih jenis Surat</h4>
        </div>
      </div>
      <div class="shadow row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-info"></i>
            <i class="fas fa-arrow-circle-down fa-stack-1x fa-inverse"></i>
          </span>
          <h5 class="service-heading">Surat Masuk</h5>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-info"></i>
            <i class="fas fa-arrow-circle-up fa-stack-1x fa-inverse"></i>
          </span>
          <h5 class="service-heading">Surat Keluar</h5>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fas fa-circle fa-stack-2x text-warning"></i>
            <i class="fas fa-inbox fa-stack-1x fa-inverse"></i>
          </span>
          <h5 class="service-heading">Disposisi</h5>
        </div>
      </div>
    </div>
  </section>
    </div>
    <!-- End of Menu Surat -->
    <!--Tabel-->

    <?php if (empty($tablerow) || $tablerow === 0) { ?>
        <div class="container" style="margin-top:20vh; margin-bottom:20vh">
            <p class="text-center">
                Tidak terdapat arsip disini. Silahkan di isi terlebih dahulu untuk melihat tabel data arsip!
            </p>
        </div>
    <?php } else { ?>
        <div class="container table-responsive">
            <table class="table table-striped table-bordered" id="tabel_arsip" style="width: 100%">
                <thead class="">
                    <tr>
                        <th>No. Arsip</th>
                        <th>Keterangan</th>
                        <th>Tgl. Masuk Arsip</th>
                        <th>Klasifikasi</th>
                        <th>Jenis Arsip</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

            </table>
        </div>
    <?php } ?>

</div>