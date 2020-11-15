<?php
$imagefile = '';
$columns = array();

if ($extfile === 'pdf') {
    $imagefile = '<i class="fa fa-5x fa-file-pdf-o" aria-hidden="true"></i>';
    $type = 'PDF Dokumen/File Scan';
} else if ($extfile === 'doc') {
    $imagefile = '<i class="fa fa-5x fa-file-word-o"></i>';
    $type = 'Dokumen';
} else if ($extfile === 'img') {
    $imagefile = '<i class="fa fa-5x fa-file-image-o"></i>';
    $type = 'Gambar/File Scan';
} else {
    $imagefile = '<i class="fa fa-5x fa-file" aria-hidden="true"></i>';
    $type = 'Tidak diketahui';
}

if (!empty($_SESSION['typearsip'])) {
    if ($_SESSION['typearsip'] == 'sm') {
        $columnst = array('Tanggal Penerimaan', 'Tanggal Pembuatan', 'Nomor Surat', 'Klasifikasi', 'Perihal', 'Asal Surat', 'Isi Ringkas', 'Keterangan', 'Lokasi Arsip');
        $columns = array('tgl_penerimaan', 'tgl_pembuatan', 'no_surat', 'n',  'perihal', 'asal_surat',  'isi_ringkas', 'keterangan', 'lokasi_arsip');
        $dispt = array('Pengirim', 'Dituju Kepada', 'Isi Disposisi');
        $disp = array('pengirim', 'jabatan', 'isi_disposisi');
    } else if ($_SESSION['typearsip'] == 'sk') {
        $columnst = array('Tanggal Pembuatan', 'Nomor Surat',  'Klasifikasi', 'Perihal', 'Dituju Kepada', 'Isi Ringkas', 'Keterangan', 'Lokasi Arsip');
        $columns = array('tgl_pembuatan', 'no_surat',  'n', 'perihal', 'surat_dikirim', 'isi_ringkas', 'keterangan', 'lokasi_arsip');
        $dispt = array('Pengirim', 'Pengiriman', 'Isi Disposisi');
        $disp = array('pengirim', 'metode', 'isi_disposisi');
    }
}

?>

<div class="container my-3">
    <h3 id='id_showfile' class="chevronbtn"><small><i id='id_iconfile' class="fa fa-chevron-right" aria-hidden="true"></i></small> File Arsip</h3>

    <table id="id_tablefile" class='table table-responsive my-4' style="display:none">
        <tr>
            <td>
                <p>Nama File</p>
            </td>
            <td>
                <p>:</p>
            </td>
            <td>
                <p> <?= $this->security->xss_clean($dokumen['nama'] . $dokumen['ekstensi']) ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Ukuran File</p>
            </td>
            <td>
                <p>:</p>
            </td>
            <td>
                <p> <?= $this->security->xss_clean($dokumen['byte_file']) ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Tipe File</p>
            </td>
            <td>
                <p>:</p>
            </td>
            <td>
                <p> <?= $type ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Uploader</p>
            </td>
            <td>
                <p>:</p>
            </td>
            <td>
                <p> <?= $this->security->xss_clean($namauploader) ?></p>
            </td>
        </tr>
        <tr>
            <td>
                <p>Lihat Dokumen</p>
            </td>
            <td>
                <p>:</p>
            </td>
            <td>
                <a href="<?= base_url('arsip/document/get/') . $this->security->xss_clean($dokumen['id_dokumen']) ?>" target="_blank">Buka Disini</a>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="container my-3">
    <h3 id='id_showdisposisi' class="chevronbtn"><small><i id="id_icondisposisi" class="fa fa-chevron-right" aria-hidden="true"></small></i> Disposisi</h3>
    <table id="id_tabledisposisi" class='table table-responsive my-4' style="display:none">

        <?php if (empty($disposisi)) : ?>
            <tr>
                <td>
                    <p>Disposisi belum di proses.</p>
                </td>
            </tr>
        <?php else : ?>
            <?php foreach ($disp as $key => $value) : ?>
                <tr>
                    <td>
                        <p><?= $dispt[$key] ?></p>
                    </td>
                    <td>
                        :
                    </td>
                    <td>
                        <p><?= $this->security->xss_clean($disposisi[$value]) ?></p>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>


    </table>

</div>

<div class="container my-3">
    <h3 id='id_showdetail' class="chevronbtn"><small><i id="id_icondetail" class="fa fa-chevron-right" aria-hidden="true"></small></i> Detail Arsip</h3>
    <table id="id_tabledetail" class='table table-responsive my-4' style="display:none">
        <?php foreach ($columns as $key => $value) : ?>
            <tr>
                <td>
                    <p><?= $columnst[$key] ?></p>
                </td>
                <td>
                    <p>:</p>
                </td>
                <td>
                    <?php if ($value == 'n') : ?>
                        <p> <?= $this->security->xss_clean($klasifikasi . " ({$arsip['id_kode']})") ?></p>
                    <?php else : ?>
                        <p><?= $this->security->xss_clean($arsip[$value]) ?></p>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
</div>