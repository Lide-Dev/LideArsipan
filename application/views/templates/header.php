<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="arsip" />
    <meta name="keywords" content="arsip" />
    <meta name="author" content="LideDev" />

    <?php if (!empty($title)) { ?>
        <title><?= $title ?></title>
    <?php } else { ?>
        <title>Condongcatur</title>
    <?php } ?>

    <link rel="icon" type="image/png" sizes="32x32" href=<?= base_url('assets/img/favicon-32x32.png') ?>>

    <?php if(empty($landing)||(!empty($landing)&&!$landing)){?>
    <link rel="stylesheet" href=<?= base_url('assets/css/lidearsip.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/sidebar.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/jquery-ui.min.css') ?>>
    <?php } else { ?>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="icon" type="image/png" sizes="32x32" href=<?= base_url('assets/img/favicon-32x32.png') ?>>
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href=<?= base_url('assets/css/animation_landing.css') ?>>
    <?php } ?>
<!--For CSS Pages-->
    <?php if (!empty($page)&&$page==="login"){ ?>
    <link rel="stylesheet" href=<?= base_url('assets/css/login_css.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/bug_report.css') ?>>
    <?php }?>
    <?php if (!empty($page)&&$page==="form_surat"){ ?>
    <link rel="stylesheet" href=<?= base_url('assets/css/ceklis_form_surat.css') ?>>
    <?php }?>
    <?php if (!empty($page)&&$page==="dashboard"){ ?>
    <link rel="stylesheet" href=<?= base_url('assets/css/tutorial_dashboard.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/jumbotron_dashboard.css') ?>>
    <link rel="stylesheet" href=<?= base_url('assets/css/page/style.css') ?>>
    <?php }?>
    <?php if (!empty($page)&&$page==="arsip"){ ?>
    <link rel="stylesheet" href=<?= base_url('assets/css/button_table.css') ?>>
    <?php }?>
<!--End CSS Pages-->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/b-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sp-1.0.1/sl-1.3.1/datatables.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Roboto&display=swap" rel="stylesheet">
<!--For Font awesome only-->
    <script src="https://kit.fontawesome.com/c2282643fa.js" crossorigin="anonymous"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>


</head>

<body>
    <div id="wrapper" class="">