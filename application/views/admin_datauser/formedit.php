<div class="form-group">
    <div>
        <div class="form-check">
          <label class="form-check-label">
            <input type="checkbox" class="form-check-input" name="cek_email" id="ad_cekemail" value="checkedValue" checked>
            Tambahkan Email ?
          </label>
        </div>
    </div>
    <div>
        <label for="ad_email"><b class="text-danger">*</b>Email</label>
        <input type="text" class="form-control" name="email" id="ad_email" aria-describedby="ad_help" placeholder="">
        <small id="lp_emailavailable" class="text-muted" style="display: none"></small>
    </div>

    <div class="mt-3">
        <label for="ad_username"><b class="text-danger">*</b>Username</label>
        <input type="text" class="form-control" name="username" id="ad_username" aria-describedby="ad_help" placeholder="">
        <!--<small id="lp_errorpass" class="text-danger" style="display: none"><i class="fas fa-exclamation-triangle mr-1"></i><span id="lp_error"></span></small>-->
    </div>
    <small id="ad_help" class="form-text text-muted">Email atau Username ini akan digunakan untuk login. Pastikan Username lebih dari 3 karakter</small>

    <div class="my-3">
        <a class="link-edit" href="<?=base_url("admdatauser/gantipass/id/")?>" aria-describedby="ad_helppass">Ubah Password</a>
        <small id="ad_passwordlink" class="form-text text-muted">Jika ingin mengubah password silahkan klik link diatas.</small>
    </div>
</div>