<?php
    //$valid=true;
?>

<div class="container my-5">

    <div class="card" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
        <div class="card-body <?= $valid ? '' : 'my-5' ?>">
            <?php if ($valid){?>
            <form id="gp_form" method="post" action="accept/go">
                <div class="row">
                    <div class="col-md-6 d-md-none pb-3">
                        <h3 class="card-title">Ganti Password</h3>
                        <p class="card-text">Password memerlukan 8 karakter dengan alfabet dan numerik bisa di pakai kecuali
                            karakter-karakter lain.
                        </p>
                        <div class="border-bottom p-2"></div>
                    </div>
                    <div class="col-md-6 border-right d-none d-md-block">
                        <h3 class="card-title">Ganti Password</h3>
                        <p class="card-text">Password memerlukan 8 karakter dengan alfabet dan numerik bisa di pakai kecuali
                            karakter-karakter lain.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <div class="d-md-none mt-3"></div>
                        <div class="form-group">
                            <label for="gp_newpass">Password Baru</label>
                            <input type="text" class="form-control" name="newpass" id="gp_newpass" aria-describedby="helpId" placeholder="">
                            <small id="gp_warningnew" class="form-text text-danger"></small>
                        </div>
                        <div class="form-group">
                            <label for="gp_cekpass">Ulangi Password Baru</label>
                            <input type="text" class="form-control" name="cekpass" id="gp_cekpass" aria-describedby="helpId" placeholder="">
                            <small id="gp_warningcek" class="form-text text-danger"></small>
                        </div>
                        <div class="d-md-none border-bottom p-2"></div>
                        <div class="d-flex justify-content-end mt-3">
                            <button type="submit" class="btn btn-primary px-3">Ganti</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php } else { ?>
                <h3> Terjadi Kesalahan </h3>
                <p class="my-3">Link yang anda masukkan terdapat kesalahan atau cobalah kontak ke admin web ini.</p>
            <?php } ?>
        </div>
    </div>
</div>