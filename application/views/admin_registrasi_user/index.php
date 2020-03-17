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
    <link rel="stylesheet" href=<?= base_url('assets/css/admin_registrasi.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/register_admin.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/sidebar.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/jquery-ui.min.css') ?>>
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Roboto&display=swap" rel="stylesheet">
    <!--For Font awesome only-->
    <script src="https://kit.fontawesome.com/c2282643fa.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/popper.min.js" integrity="sha256-O17BxFKtTt1tzzlkcYwgONw4K59H+r1iI8mSQXvSf5k=" crossorigin="anonymous"></script>

</head>

<body>
<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
	<h4 class="card-title mt-3 text-center">Buat Akun</h4>
	<form>
	<div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Nama Lengkap" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Username" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Alamat Email" type="email">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Alamat Lengkap" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Tempat Lahir" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="" class="form-control" placeholder="Tanggal Lahir" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
		</div>
		<select class="custom-select" style="max-width: 120px;">
		    <option selected="">+62</option>
		    <option value="1">+972</option>
		    <option value="2">+198</option>
		    <option value="3">+701</option>
		</select>
    	<input name="" class="form-control" placeholder="Nomor Telepon" type="text">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-building"></i> </span>
		</div>
		<select class="form-control">
			<option selected="">Pilih Agama</option>
			<option>Islam</option>
			<option>Katolik</option>
            <option>Kristen</option>
            <option>Hindu</option>
            <option>Budha</option>
		</select>
	</div> <!-- form-group end.// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Buat password" type="password">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input class="form-control" placeholder="Ulangi password" type="password">
    </div> <!-- form-group// -->                                      
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block"> Buat Account  </button>
    </div> <!-- form-group// -->                                                                       
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

</body>
<script src=<?= base_url('assets/js/jquery.js') ?>></script>

<script src=<?= base_url('assets/js/jquery-ui.min.js') ?>></script>
<script src=<?= base_url('assets/js/sidebar.js') ?>></script>
<script src=<?= base_url('assets/js/fontawesome.js') ?>></script>
<script src=<?= base_url('assets/js/bootstrap.min.js') ?>></script>
<script src=<?= base_url('assets/js/fontawesome.min.js') ?>></script>

</html>