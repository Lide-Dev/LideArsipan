<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php if (!empty($title)) { ?>
        <title><?= $title ?></title>
    <?php } else { ?>
        <title>Admin Page</title>
    <?php } ?>

    <link rel="icon" type="image/png" sizes="32x32" href=<?= base_url('assets/img/favicon-32x32.png') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/lidearsip.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/sidebar.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/jquery-ui.min.css') ?>>
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Roboto&display=swap" rel="stylesheet">
    <!--For Font awesome only-->
    <script src="https://kit.fontawesome.com/c2282643fa.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/popper.min.js" integrity="sha256-O17BxFKtTt1tzzlkcYwgONw4K59H+r1iI8mSQXvSf5k=" crossorigin="anonymous"></script>
</head>
<body class="bg-blackpearl">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body bg-greenteal">
                        <h5 class="card-title text-center">Login Admin</h5>
                        <form class="form-signin">
                            <div class="form-label-group m-3">
                                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
                            </div>
                            <div class="form-label-group m-3">
                                <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-label-group m-3">
                                <a href="<?= base_url('Admin_Registrasi_User') ?>"><button type="button" name="button" class="btn btn-md btn-primary btn-block text-uppercase">Masuk</button></a>
                                <hr class="my-4">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src=<?= base_url('assets/js/jquery.js') ?>></script>

<script src=<?= base_url('assets/js/jquery-ui.min.js') ?>></script>
<script src=<?= base_url('assets/js/sidebar.js') ?>></script>
<script src=<?= base_url('assets/js/fontawesome.js') ?>></script>
<script src=<?= base_url('assets/js/bootstrap.min.js') ?>></script>
<script src=<?= base_url('assets/js/fontawesome.min.js') ?>></script>

</html>