<?php
$csrf = array(
    'name' => $this->security->get_csrf_token_name(),
    'hash' => $this->security->get_csrf_hash()

)
?>

<div class="container" style="margin-top:10vh; margin-bottom:20vh">
    <div class="container">

        <div class="row my-5 bg-londonsquare rounded d-flex align-content-center">
            <div id="progress1" class='bg-mintygreen text-center text-white rounded-left' style="width: 0%;" data-percentage=<?= $percentagearsip ?>>
                <?php if ($percentagearsip > 10) { ?>
                    <h3 style="color: rgba(0, 0, 0, 0);"><?= $this->security->xss_clean($percentagearsip) ?>%</h3>
                    <p style="color: rgba(0, 0, 0, 0);">Surat Aktif</p>
                <?php } ?>
            </div>
            <div id="progress2" class='bg-chromeyellow text-center text-white' style="width: 0%;" data-percentage=<?= $percentagesampah ?>>
                <?php if ($percentagesampah > 10) { ?>
                    <h3 style="color: rgba(0, 0, 0, 0);"><?= $this->security->xss_clean($percentagesampah) ?>%</h3>
                    <p style="color: rgba(0, 0, 0, 0);">Sampah Surat</p>
                <?php } ?>
            </div>
            <div id="progress3" class='bg-blackpearl text-center text-white ' style="width: 0%;" data-percentage=<?= $percentagesystem ?>>
                <?php if ($percentagesystem > 10) { ?>
                    <h3 style="color: rgba(0, 0, 0, 0);"><?= $this->security->xss_clean($percentagesystem) ?>%</h3>
                    <p style="color: rgba(0, 0, 0, 0);">Reserved System</p>
                <?php } ?>
            </div>
            <div id="progress4" class='bg-londonsquare text-center text-whiteo rounded-right' style="width: 0%;" data-percentage=<?= $percentagetotal ?>>
                <?php if ($percentagetotal > 10) { ?>
                    <h3 style="color: rgba(0, 0, 0, 0);"><?= $this->security->xss_clean($percentagetotal) ?>%</h3>
                    <p style="color: rgba(0, 0, 0, 0);">Penyimpanan Server</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <div class="container my-3 rounded bg-light p-3">
        <h5>Besar Penyimpanan Arsip</h5>
        <div class="row p-2">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>
                            <b>Surat Aktif</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <?= $this->security->xss_clean($totalarsip) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Sampah Surat</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <?= $this->security->xss_clean($totalsampah) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Disiapkan untuk Sistem</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <?= $this->security->xss_clean($reservedsystem) ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>
                            <b>Penyimpanan Tersisa</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <?= $this->security->xss_clean($space) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Total Penyimpanan Server</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            <?= $this->security->xss_clean($totalserver) ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class='form-row my-5'>
            <div class="col-6">
                <input type="hidden" name="<?= $csrf['name']; ?>" value="<?= $csrf['hash']; ?>" />
                <input type="text" class="form-control" name="search" id="ar_search" aria-describedby="helpSearch" placeholder="Pencarian ID">
                <small id='helpSearch' class="form-text text-muted">Pencarian akan dilakukan jika melebihi 2 karakter huruf di kolom pencarian.</small>
                <small id='helpSearch' class="form-text text-muted">Kosongkan kolom pencarian jika ingin melihat semua arsip.</small>
            </div>
            <div class="col-2">
                <button id="ar_btnsearch" class='btn disabled'>Cari</button>
            </div>
            <div class="col-4">
                <input type="text" class="form-control" name="tglhapus" id="ar_tglhapus" placeholder="Tanggal Hapus">
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="table-responsive">
            <table class="table table-inverse " id='table_sampah'>
                <thead class="thead-dark">
                    <tr>
                        <th>ID Surat</th>
                        <th>Tanggal Hapus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>