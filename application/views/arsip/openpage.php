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
        $columnst = array('Tanggal Penerimaan', 'Tanggal Pembuatan', 'Nomor Surat', 'Klasifikasi', 'Asal Surat', 'Isi Ringkas', 'Keterangan', 'Lokasi Arsip');
        $columns = array('tgl_penerimaan', 'tgl_pembuatan', 'no_surat', 'n', 'asal_surat', 'isi_ringkas', 'keterangan', 'lokasi_arsip');
    } else if ($_SESSION['typearsip'] == 'sk') {
        $columnst = array('Tanggal Penerimaan', 'Tanggal Pembuatan', 'Nomor Surat',  'Klasifikasi', 'Pengirim', 'Isi Ringkas', 'Keterangan', 'Lokasi Arsip');
        $columns = array('tgl_penerimaan', 'tgl_pembuatan', 'no_surat',  'n', 'surat_dikirim', 'isi_ringkas', 'keterangan', 'lokasi_arsip');
    } else {
        $columnst = array('Tanggal Penerimaan', 'Tanggal Pembuatan', 'Nomor Agenda', 'Klasifikasi', 'Pengirim', 'Dituju ke', 'Perihal', 'Isi Disposisi');
        $columns = array('tgl_penerimaan', 'tgl_pembuatan', 'no_agenda', 'n', 'pengirim', 'dituju', 'perihal', 'isi_disposisi');
    }
}

?>

<div class="container my-2">
    <h3>File Arsip: </h3>
    <div class="row justify-content-center">
        <div class="col-auto">
            <div class="">
            <table class='table table-responsive my-4'>
                <tbody>
                <tr>
                    <td colspan=3 class='text-center'>
                        <?= $imagefile ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Nama File</p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $dokumen['nama'] . $dokumen['ekstensi'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Ukuran File</p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $dokumen['byte_file'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Tipe File</p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $type ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Uploader</p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $namauploader ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Link Download</p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                         <a href="<?= base_url('arsip/dokumen/get/') . $dokumen['id_dokumen'] ?>">Download Disini</a>
                    </td>
                </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>


<div class="container my-2">
    <h3>Detail Arsip: </h3>
    <div class="row justify-content-center">
        <div class="">
            <table class='table my-4'>
                <tr>
                    <td>
                        <p><?= $columnst[0] ?></p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p><?= $arsip[$columns[0]] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><?= $columnst[1] ?></p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $arsip[$columns[1]] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><?= $columnst[2] ?></p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $arsip[$columns[2]] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><?= $columnst[3] ?></p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $klasifikasi . " ({$arsip['id_kode']})" ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><?= $columnst[4] ?></p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $arsip[$columns[4]] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><?= $columnst[5] ?></p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $arsip[$columns[5]] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><?= $columnst[6] ?></p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $arsip[$columns[6]] ?></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><?= $columnst[7] ?></p>
                    </td>
                    <td><p>:</p></td>
                    <td>
                        <p> <?= $arsip[$columns[7]] ?></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>