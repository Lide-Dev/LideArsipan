<?php
defined('BASEPATH') or exit('No direct script access allowed');
$shadowdefault = '0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)';
?>
<div>

    <!--START Data Dashboard-->
    <div class="container rounded mt-5">
        <div class="row bg-light rounded">
            <div class="col-4">
                <div class="row m-1 bg-freshturquoise rounded" style='box-shadow:<?= $shadowdefault ?>;'>
                    <div class="col-8 my-3">
                        <h6 class='text-white text-center'> Total arsip yang disimpan </h6>
                        <h3 class='text-white text-center'> 54 </h3>
                        <div class="text-white text-center"><i class="fas fa-chevron-down fa-sm "></i></div>
                    </div>
                    <div class="col-4 d-flex justify-content-center ">
                        <i class="fas fa-mail-bulk fa-4x text-white align-self-center"></i>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row m-1 bg-londonsquare rounded" style='box-shadow:<?= $shadowdefault ?>;'>
                    <div class="col-8 my-3">
                        <h6 class='text-white text-center'> User Yang Terdaftar </h6>
                        <h3 class='text-white text-center'> 31 </h3>
                        <div class="text-white text-center"><a href="" class="text-white"><i class="fas fa-chevron-circle-right fa-sm"></i> Data User</a></div>
                    </div>
                    <div class="col-4 d-flex justify-content-center">
                        <i class="fas fa-user fa-4x text-white align-self-center "></i>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row m-1 bg-narenjiorange rounded" style='box-shadow:<?= $shadowdefault ?>;'>
                    <div class="col-8 my-3">
                        <h6 class='text-white text-center'> Total File Arsip </h6>
                        <h3 class='text-white text-center'> 23.12 MB </h3>
                        <div class="text-white text-center"><a href="" class="text-white"><i class="fas fa-chevron-circle-right fa-sm"></i> Data Penyimpanan</a></div>
                    </div>
                    <div class="col-4 d-flex justify-content-center ">
                        <i class="fas fa-database fa-4x text-white align-self-center"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--END Data Dashboard-->

    <div class="container my-5 p-3 bg-light rounded">
        <div>
            <div class="row">
                <div id="chart1" class='col-6' style="height:50vh;"></div>
                <div id="chart2" class='col-6' style="height:50vh;"></div>
            </div>
        </div>
    </div>
</div>