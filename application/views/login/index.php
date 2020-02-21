<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img class="img-register brand_logo" src="<?= PATHIMG ?>Sleman.svg" alt="" />
                </div>
            </div>
            <div class="d-flex justify-content-center form_container">
                <form>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="" class="form-control input_user" value="" placeholder="username">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="" class="form-control input_pass" value="" placeholder="password">
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-building"></i> </span>
                        </div>
                        <select class="form-control">
                            <option selected=""> Pilih Jabatan</option>
                            <option>Lurah</option>
                            <option>Sekretaris</option>
                            <option>Pegawai</option>
                        </select>
                    </div>
            </div> <!-- form-group// -->
            <div class="d-flex justify-content-center mt-3 login_container">
                <a href="<?= base_url('Home') ?>"><button type="button" name="button" class="btn login_btn">Login</button></a>
            </div>
            </form>
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    <a href="#" class="ml-2" style="color: white;" data-toggle="modal" data-target="#modalID"><b>Lupa Password?</b></a>
                </div>
            </div>
        </div>
    </div>
</div>