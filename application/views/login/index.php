<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="arsip" />
    <meta name="keywords" content="arsip">
    <meta name="author" content="LideDev" />

    <link rel="stylesheet" href=<?= base_url('assets/css/lidearsip.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/sidebar.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/jquery-ui.min.css') ?>>
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Roboto&display=swap" rel="stylesheet">
<!--For Font awesome only-->
    <script src="https://kit.fontawesome.com/c2282643fa.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/popper.min.js" integrity="sha256-O17BxFKtTt1tzzlkcYwgONw4K59H+r1iI8mSQXvSf5k=" crossorigin="anonymous"></script>

</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-content container">
            <div class="card">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="card-body">
                        <i class="fas fa-sign-in-alt"></i>
                            <h4 class="mb-3 f-w-400">Login</h4>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-mail"></i></span>
                                </div>
                                <input type="email" class="form-control" placeholder="ID">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="feather icon-lock"></i></span>
                                </div>
                                <input type="password" class="form-control" placeholder="Password">
                            </div>
                            <a href="<?=base_url('Home')?>"><button class="btn btn-primary shadow-2 mb-4">Login</button></a>
                            <p class="mb-2 text-muted">Lupa Password? <a href="auth-reset-password.html" class="f-w-400">Reset</a></p>
                        </div>
                    </div>
                    <div class="col-md-6 d-none d-md-block">
                        <img src="<?=PATHIMG?>Sleman.svg" alt="Sleman" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Js -->
    <script src=<?= base_url('assets/js/jquery.js') ?>></script>
  
    <script src=<?=base_url('assets/js/jquery-ui.min.js')?>></script>
    <script src=<?=base_url('assets/js/sidebar.js')?>></script>
    <script src=<?=base_url('assets/js/fontawesome.js')?>></script>
    <script src=<?= base_url('assets/js/bootstrap.min.js') ?>></script>
    <script src=<?= base_url('assets/js/fontawesome.min.js') ?>></script>
</body>
</html>
