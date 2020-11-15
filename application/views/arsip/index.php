<?php
$active = array('', '', '');
$th = '';
if (!empty($_SESSION['typearsip'])) {
    $th = 'Keterangan';
    if ($_SESSION['typearsip'] === 'sm') {
        $active[0] = 'active';
    } else if ($_SESSION['typearsip'] === 'sk') {
        $active[1] = 'active';
    } else if ($_SESSION['typearsip'] === 'dp') {
        $active[2] = 'active';
        $th = 'Perihal';
    } else
        $active = array('', '', '');
}
?>

<div class="container mb-5">
    <!-- Menu Surat -->
    <div class="p-3">
        <section class="page-section" id="services">
            <div class="container border border-hintofelusive rounded p-3">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <input type="hidden" class="inputhid" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                        <h4 class="section-heading text-uppercase mt-2 mb-4">Pilih jenis Surat</h4>
                    </div>
                </div>


                <div class="text-center p-3 ">
                    <div class="shadow row">
                    <div class="col-md-6 btn btn-hintofelusive  <?= $active[0] ?>">
                        <a href="<?= base_url('arsip/suratmasuk') ?>" class="text-decoration-none text-dark">
                            <div id="arsip-sm" class="">
                                <span class="fa-stack fa-4x">
                                    <i class="fas fa-circle fa-stack-2x text-info"></i>
                                    <i class="fas fa-arrow-circle-down fa-stack-1x fa-inverse"></i>
                                </span>
                                <h5 class="service-heading">Surat Masuk</h5>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 btn btn-hintofelusive <?= $active[1] ?>">
                        <a href="<?= base_url('arsip/suratkeluar') ?>" class="text-decoration-none text-dark">
                            <div id="arsip-sk">
                                <span class="fa-stack fa-4x">
                                    <i class="fas fa-circle fa-stack-2x text-info"></i>
                                    <i class="fas fa-arrow-circle-up fa-stack-1x fa-inverse"></i>
                                </span>
                                <h5 class="service-heading">Surat Keluar</h5>
                            </div>
                        </a>
                    </div>
                    <!-- <div class="col-md-4 btn btn-hintofelusive <?= $active[2] ?>">
                        <a href="<?= base_url('arsip/disposisi') ?>" class="text-decoration-none text-dark">
                            <div id="arsip-dp">
                                <span class="fa-stack fa-4x">
                                    <i class="fas fa-circle fa-stack-2x text-warning"></i>
                                    <i class="fas fa-inbox fa-stack-1x fa-inverse"></i>
                                </span>
                                <h5 class="service-heading">Disposisi</h5>
                            </div>
                        </a>
                    </div> -->
                    </div>
                </div>

            </div>
        </section>
    </div>
    <!-- End of Menu Surat -->


    <!--Tabel-->
    <?php if (empty($_SESSION['typearsip'])||$_SESSION['typearsip']==='emp') { ?>
        <div class="container" style="margin-top:20vh; margin-bottom:20vh; ">
            <p class="text-center">
                Silahkan memilih Tipe Arsip yang ingin dilihat. Setelah itu tabel akan muncul.
            </p>
        </div>
    <?php } else if (empty($tablerow) || $tablerow === 0 || (empty($_SESSION['typearsip']))) { ?>
        <div class="container" style="margin-top:20vh; margin-bottom:20vh; ">
            <p class="text-center">
                Tidak terdapat arsip disini. Silahkan di isi terlebih dahulu untuk melihat tabel data arsip.
            </p>
        </div>
    <?php } else { ?>
        <div id="nonerow" class="container" style="margin-top:20vh; margin-bottom:20vh; display:none; ">
            <p class="text-center">
                Tidak terdapat arsip disini. Silahkan di isi terlebih dahulu untuk melihat tabel data arsip.
            </p>
        </div>
        <div class="container" id="div-table">
            <div class='form-row my-3'>
                <div class="col-6">


                    <div class="input-group md-form form-sm form-2 pl-0">
                        <input class="form-control my-0 py-1 red-border" type="text" name="search" id="ar_search" aria-describedby="helpSearch" placeholder="Pencarian..." aria-label="Search">
                        <div class="input-group-append">
                            <button id="ar_btnsearch" class="btn disabled input-group-text red lighten-3" id="basic-text1"><i class="fas fa-search text-grey" aria-hidden="true"></i></button>
                        </div>
                    </div>

                    <small id='helpSearch' class="form-text text-muted">Pencarian akan dilakukan jika melebihi 2 karakter huruf di kolom pencarian.</small>
                    <small id='helpSearch' class="form-text text-muted">Kosongkan kolom pencarian jika ingin melihat semua arsip.</small>
                </div>
                <div class="col-3">

                </div>
            </div>

            <div class="table-responsive-lg">
                <table class="table hover table-striped table-borderless" id="tabel_arsip" style="width: 100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>No. Arsip</th>
                            <th>Klasifikasi</th>
                            <th><?= $th ?></th>
                            <th>Tgl. Masuk Arsip</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                </table>
            </div>
        </div>
    <?php } ?>

</div>