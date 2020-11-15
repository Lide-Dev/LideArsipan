<?php
$imagefile = '';
$columns = array();
// print_r($arsip);

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

if (!empty($typearsip)) {
    if ($typearsip == 'sm') {
        $columnst = array('Tanggal Penerimaan', 'Tanggal Pembuatan', 'Nomor Surat', 'Klasifikasi', 'Asal Surat', 'Isi Ringkas', 'Keterangan', 'Lokasi Arsip');
        $columns = array('tgl_penerimaan', 'tgl_pembuatan', 'no_surat', 'n', 'asal_surat', 'isi_ringkas', 'keterangan', 'lokasi_arsip');
    } else if ($typearsip == 'sk') {
        $columnst = array('Tanggal Pembuatan', 'Nomor Surat',  'Klasifikasi', 'Pengirim', 'Isi Ringkas', 'Keterangan', 'Lokasi Arsip');
        $columns = array('tgl_pembuatan', 'no_surat',  'n', 'surat_dikirim', 'isi_ringkas', 'keterangan', 'lokasi_arsip');
    } else {
        $columnst = array('Tanggal Penerimaan', 'Tanggal Pembuatan', 'Nomor Agenda', 'Klasifikasi', 'Pengirim', 'Dituju ke', 'Perihal', 'Isi Disposisi');
        $columns = array('tgl_penerimaan', 'tgl_pembuatan', 'no_agenda', 'n', 'pengirim', 'dituju', 'perihal', 'isi_disposisi');
    }
}

?>

<div class="container my-2">
    <h3>File Arsip: </h3>
    <div class="text-center">
        <?= $imagefile ?>
    </div>
    <!-- <div class="row justify-content-center">
        <div class=""> -->
    <table class='table table-responsive my-4'>

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
                <p> <?= $this->security->xss_clean($type) ?></p>
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
        </tbody>
    </table>
    <!-- </div>
    </div> -->
</div>


<div class="container my-2">
    <h3>Detail Arsip: </h3>
    <!-- <div class="row justify-content-center">
        <div class=""> -->
    <table class='table table-responsive my-4'>
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
    <!-- </div>
    </div> -->
</div>