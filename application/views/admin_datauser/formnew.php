<div class="form-group">
    <div>
        <label for="ad_email"><b class="text-danger">*</b>Email</label>
        <input type="text" class="form-control" name="email" id="ad_email" aria-describedby="ad_help" placeholder="">
        <!--<small id="lp_errorpass" class="text-danger" style="display: none"><i class="fas fa-exclamation-triangle mr-1"></i><span id="lp_error"></span></small>-->
    </div>

    <div class="mt-3">
        <label for="ad_username"><b class="text-danger">*</b>Username</label>
        <input type="text" class="form-control" name="username" id="ad_username" aria-describedby="ad_help" placeholder="">
        <!--<small id="lp_errorpass" class="text-danger" style="display: none"><i class="fas fa-exclamation-triangle mr-1"></i><span id="lp_error"></span></small>-->
    </div>

    <div class="mt-3">
        <label for="ad_password"><b class="text-danger">*</b>Password</label>
        <input type="password" class="form-control" name="password" id="ad_password" aria-describedby="ad_help" placeholder="">
        <!--<small id="lp_errorpass" class="text-danger" style="display: none"><i class="fas fa-exclamation-triangle mr-1"></i><span id="lp_error"></span></small>-->
    </div>
    <small id="ad_help" class="form-text text-muted border-bottom border-dark pb-3">Email dan Username ini akan digunakan untuk login. Salah satu harus di isi.</small>

    <div class="mt-3">
        <label for="ad_nama"><b class="text-danger">*</b>Nama</label>
        <input type="text" class="form-control" name="nama" id="ad_nama" aria-describedby="ad_help" placeholder="">
        <!--<small id="lp_errorpass" class="text-danger" style="display: none"><i class="fas fa-exclamation-triangle mr-1"></i><span id="lp_error"></span></small>-->
    </div>
    <div class="mt-3">
        <label for="ad_nip"><b class="text-danger">*</b>NIP</label>
        <input type="text" class="form-control" name="nip" id="ad_nip" aria-describedby="ad_help" placeholder="">
        <!--<small id="lp_errorpass" class="text-danger" style="display: none"><i class="fas fa-exclamation-triangle mr-1"></i><span id="lp_error"></span></small>-->
    </div>
    <div class="mt-3">
        <label for=""><b class="text-danger">*</b>Jenis Kelamin</label>
        <div class="form-check form-check-inline">
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="jeniskelamin" id="ad_jk" value="laki" checked> Laki-laki
            </label>
            <label class="form-check-label">
                <input class="form-check-input" type="radio" name="jeniskelamin" id="ad_jk" value="perempuan"> Perempuan
            </label>
        </div>
    </div>
    <div class="mt-3">
        <label for="ad_tgllahir"><b class="text-danger">*</b>Tgl. Lahir</label>
        <input type="text" class="form-control" name="tgllahir" id="ad_tgllahir" aria-describedby="ad_help" placeholder="">
        <!--<small id="lp_errorpass" class="text-danger" style="display: none"><i class="fas fa-exclamation-triangle mr-1"></i><span id="lp_error"></span></small>-->
    </div>
    <div class="mt-3">
        <div class="form-group">
          <label for="ad_jabatan">Jabatan</label>
          <select class="form-control" name="jabatan" id="ad_jabatan">
            <!--include from server -->
            <?= $jabatan ?>
          </select>
        </div>
    </div>

    <div class="my-3">
        <small id="ad_help" class="form-text text-muted">Jabatan akan mempengaruhi akses dari arsip surat tersebut.</small>
    </div>
</div>