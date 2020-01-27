<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
        <title>Test</title>
    <?php } ?>

    <link rel="stylesheet" href=<?= base_url('assets/css/bootstrap.min.css') ?>>

</head>

<body>