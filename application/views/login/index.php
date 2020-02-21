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
<<<<<<< HEAD
                </div> <!-- form-group// -->
                <div class="d-flex justify-content-center mt-3 login_container">
                    <a href="<?= base_url('Home') ?>"><button type="button" name="button" class="btn login_btn">Login</button></a>
                </div>
                </form>
                <div class="mt-4">
                    <div class="d-flex justify-content-center links">
                        <b>Lupa Password? <!-- Fitur Report Bug --> <a href="#" class="ml-2" style="color: white;"><button type="button" class="feedback btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bantuan</b></button></a>
                                
                                <div class="btn-group dropup">
                                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-form">
                                        <li>
                                            <div class="report">
                                                <h2 class="text-center">Report Bug</h2>
                                                <form class="doo" method="post" action="report.php">
                                                    <div class="col-sm-12">
                                                        <textarea required name="comment" class="form-control" placeholder="Please tell us what bug or issue you've found, provide as much detail as possible."></textarea>
                                                        <input name="screenshot" type="hidden" class="screen-uri">
                                                        <span class="screenshot pull-right"><i class="fa fa-camera cam" title="Take Screenshot"></i></span>
                                                    </div>
                                                    <div class="col-sm-12 clearfix">
                                                        <button class="btn btn-primary btn-block">Submit Report</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="loading text-center hideme">
                                                <h2>Please wait...</h2>
                                                <h2><i class="fa fa-refresh fa-spin"></i></h2>
                                            </div>
                                            <div class="reported text-center hideme">
                                                <h2>Thank you!</h2>
                                                <p>Your submission has been received, we will review it shortly.</p>
                                                <div class="col-sm-12 clearfix">
                                                    <button class="btn btn-success btn-block do-close">Close</button>
                                                </div>
                                            </div>
                                            <div class="failed text-center hideme">
                                                <h2>Oh no!</h2>
                                                <p>It looks like your submission was not sent.<br><br><a href="mailto:">Try contacting us by the old method.</a></p>
                                                <div class="col-sm-12 clearfix">
                                                    <button class="btn btn-danger btn-block do-close">Close</button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
=======
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
>>>>>>> a96324232a06c6408c1b15a217a155fd8362283a

                    <!-- Fitur Report Bug
                    <div class="btn-group dropup" data-toggle="modal" data-target="#modalID">
                        <ul class="dropdown-menu dropdown-menu-right dropdown-menu-form">
                            <li>
                                <div class="report">
                                    <h2 class="text-center">Report Bug</h2>
                                    <form class="doo" method="post" action="report.php">
                                        <div class="col-sm-12">
                                            <textarea required name="comment" class="form-control" placeholder="Please tell us what bug or issue you've found, provide as much detail as possible."></textarea>
                                            <input name="screenshot" type="hidden" class="screen-uri">
                                            <span class="screenshot pull-right"><i class="fa fa-camera cam" title="Take Screenshot"></i></span>
                                        </div>
                                        <div class="col-sm-12 clearfix">
                                            <button class="btn btn-primary btn-block">Submit Report</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="loading text-center hideme">
                                    <h2>Please wait...</h2>
                                    <h2><i class="fa fa-refresh fa-spin"></i></h2>
                                </div>
                                <div class="reported text-center hideme">
                                    <h2>Thank you!</h2>
                                    <p>Your submission has been received, we will review it shortly.</p>
                                    <div class="col-sm-12 clearfix">
                                        <button class="btn btn-success btn-block do-close">Close</button>
                                    </div>
                                </div>
                                <div class="failed text-center hideme">
                                    <h2>Oh no!</h2>
                                    <p>It looks like your submission was not sent.<br><br><a href="mailto:">Try contacting us by the old method.</a></p>
                                    <div class="col-sm-12 clearfix">
                                        <button class="btn btn-danger btn-block do-close">Close</button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    End Of Fitur Report Bug -->
                </div>
            </div>
        </div>
    </div>
</div>