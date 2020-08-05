<div class="container h-100">
    <?=!empty($_SESSION['message']) ? $_SESSION['message'] : ""?>
    <div class="card my-5" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="card-body col-lg-10 text-justify mx-3">
            <h4>Konfigurasi Awal Akun</h4>
            <p>Anda dapat mengkonfigurasi nama, username, email (optional), password dan lain-lain untuk pertama kali login dengan username bawaan. Penyebab anda ke konfigurasi ini karena :</p>
            <ul>
                <li>Anda melewati konfigurasi awal akun.</li>
                <li>Anda belum mengganti username atau masih menggunakan bawaan dari sistem. Contohnya <i>"usl2130101"</i>.</li>
            </ul>
            <p>Jika username telah diganti maka anda tidak bisa menggantinya lagi. Anda bisa menkontak admin web ini jika ingin mengganti data-data ini selanjutnya.</p>
            <small class="form-text text-muted">
                Jika anda masih dibawa ke page ini tanpa ada masalah diatas, cobalah kontak web admin ini.
            </small>
        </div>
    </div>

    <div class="card bg-light my-4">
        <article class="card-body mx-3">
            <?= form_open(base_url("newuser/go/change"))?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="ne_username">Username<b class="text-danger">*</b></label>
                            <input type="text" class="form-control" name="username" id="ne_username" aria-describedby="helpId2" placeholder="" value="<?=$data_login->username?>">
                            <small id="helpId2" class="form-text text-muted">Username dibutuhkan untuk login ke akun anda. Username harus lebih dari 3 karakter.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="ne_username">Email</label>
                            <input type="text" class="form-control" name="email" id="ne_email" aria-describedby="helpId2" placeholder="" value="<?=$data_login->email==="undefined"?"":$data_login->email ?>">
                            <small id="helpId2" class="form-text text-muted">Email dibutuhkan untuk opsional login ke akun anda. Email bersifat opsional untuk sekarang.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="ne_pass">Password<b class="text-danger">*</b></label>
                            <input type="password" class="form-control" name="pass" id="ne_pass" aria-describedby="helpId3" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="ne_passc">Ulangi Password<b class="text-danger">*</b></label>
                            <input type="password" class="form-control" name="passc" id="ne_passc" aria-describedby="helpId3" placeholder="">
                        </div>
                    </div>
                    <div class="col-lg-12 mb-4">
                        <small id="helpId3" class="form-text text-muted">Password memerlukan 8 karakter dengan alfabet dan numerik bisa di pakai kecuali karakter-karakter lain.</small>
                    </div>
                </div>
                <div class="row border-hintofelusive border-top">
                    <div class="col-lg-6 mt-4">
                        <div class="form-group">
                            <label for="ne_nama">Nama Lengkap<b class="text-danger">*</b></label>
                            <input type="text" class="form-control" name="nama" id="ne_nama" aria-describedby="helpId1" placeholder="" value="<?=$data_account->nama?>">
                            <small id="helpId1" class="form-text text-muted">Nama lengkap anda akan digunakan kedepannya.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="ne_nip">NIP</label>
                            <input type="text" class="form-control" name="nip" id="ne_nip" aria-describedby="helpId4" placeholder="" value="<?=!empty($data_account->nip)?$data_account->nip:"" ?>">
                            <small id="helpId4" class="form-text text-muted">Data NIP bersifat optional untuk sekarang.</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="ne_jabatan">Jabatan</label>
                            <input type="text" class="form-control" name="nip" id="ne_nip" aria-describedby="helpId5" placeholder="" disabled value="<?=$data_account->jabatan?>">
                            <small id="helpId5" class="form-text text-muted">Jika terjadi kesalahan pada data jabatan, silahkan kontak admin web ini.</small>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-row-reverse mt-4">
                    <a name="" id="" class="btn btn-hintofelusive mx-4 px-3" href='<?=base_url("dashboard")?>' role="button">Lewati</a>
                    <button type="submit" class="btn btn-greenteal px-3">Ubah</button>
                </div>
            <?=form_close() ?>
        </article>
    </div>
</div>