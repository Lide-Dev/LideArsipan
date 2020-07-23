<div class="container h-100">
    <div class="d-flex justify-content-center h-100">
        <div class="user_card">
            <div class="d-none d-md-block">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container">
                    <img class="img-register brand_logo" src="<?= PATHIMG ?>Sleman.svg" alt="" />
                </div>
            </div>
            </div>
            <div class="d-block d-md-none">
            <div class="d-flex justify-content-center">
                <div class="brand_logo_container_child">
                    <img class="img-register brand_logo_child" src="<?= PATHIMG ?>Sleman.svg" alt="" />
                </div>
            </div>
            </div>

            <?=form_open("go/loginvalid/token",array('id'=>'login_form','method'=>"POST")) ;?>
                <div class="form_container">
                    <div class="row d-flex justify-content-center ">
                        <div class="col-md-10 input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="login_name" class="form-control input_user" value="" placeholder="username">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center ">
                        <div class="col-md-10 input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fa fa-key"></i></span>
                            </div>
                            <input type="password" name="login_pass" class="form-control input_pass" value="" placeholder="password">
                            <div class="input-group-addon">
                                <i id="pass_eye" class="fa fa-eye-slash" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>

                </div> <!-- form-group// -->
                <div class="d-flex justify-content-center mt-3 login_container">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
        
            <?=form_close()?>
            <?=!empty($_SESSION['message']) ? $_SESSION['message'] : ""?>
            <div class="mt-4">
                <div class="d-flex justify-content-center links">
                    <a href="#" class="ml-2" style="color: white;" data-toggle="modal" data-target="#modalID"><b>Lupa Password?</b></a>
                </div>
            </div>
        </div>
    </div>
</div>