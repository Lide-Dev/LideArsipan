<div class="container mb-5">
    <div class="container">
        <div id="flip_arsip">
            <div class="col-md-12"><i class="fa fa-search" aria-hidden="true"></i> Klik disini untuk memulai pencarian</div>
            <div class="col-md-12"><i id="chevron_nav" class="fas fa-chevron-down fa-lg"></i></div>
        </div>

        <div id="panel_arsip">
            <div class="card shadow mb-5 bg-white rounded">
                <!--Card-Body-->
                <div class="card-body">
                    <!--Card-Title-->
                    <p class="card-title text-center shadow mb-5 rounded">Cari Arsip</p>
                    <hr>
                    <p class="searchText"><strong>Cari Arsip Anda</strong></p>
                    <!--First Row-->

                    <!--Second Row-->
                    <div class="row">
                        <div class="col-sm-6"> <select class="browser-default custom-select mb-4" id="select">
                                <option value="" disabled="" selected="">Kategori Surat</option>
                                <option value="1">Surat Masuk</option>
                                <option value="2">Surat Keluar</option>
                                <option value="3">Doposisi</option>
                            </select> </div>
                        <div class="col-sm-6"> <select class="browser-default custom-select mb-4" id="select">
                                <option value="" disabled="" selected="">To City/Airport</option>
                                <option value="1">New Delhi</option>
                                <option value="2">Mumbai</option>
                                <option value="3">Bangalore</option>
                            </select> </div>
                    </div>
                    <!--Third Row-->
                    <div class="row">
                        <div class="col-sm-6"> <input placeholder="&#xf073; Departing" type="text" id="date-picker-example" class="form-control datepicker mb-4" style="font-family:Arial, FontAwesome"> </div>
                        <div class="col-sm-6"> <input placeholder="&#xf073; Arriving" type="text" id="date-picker-example" class="form-control datepicker" style="font-family:Arial, FontAwesome"> </div>
                    </div>
                    <!--Fourth Row-->
                    <div class="row mt-4">
                        <div class="col-sm-6"> <select class="browser-default custom-select mb-4" id="select">
                                <option value="" disabled="" selected="">Anytime</option>
                                <option value="1">6:00 AM</option>
                                <option value="2">3:00 PM</option>
                                <option value="3">6:00 PM</option>
                            </select> </div>
                        <div class="col-sm-6"> <select class="browser-default custom-select mb-4" id="select">
                                <option value="" disabled="" selected="">Anytime</option>
                                <option value="1">6:00 AM</option>
                                <option value="2">3:00 PM</option>
                                <option value="3">6:00 PM</option>
                            </select> </div>
                    </div>
                    <!--Fifth Row-->
                    <div class="row">
                        <div class="col-sm-4"> <select class="browser-default custom-select mb-4" id="select">
                                <option value="" disabled="" selected="">Kids(0-14)</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select> </div>
                        <div class="col-sm-4"> <select class="browser-default custom-select mb-4" id="select">
                                <option value="" disabled="" selected="">Adults(15-64)</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select> </div>
                        <div class="col-sm-4"> <select class="browser-default custom-select mb-4" id="select">
                                <option value="" disabled="" selected="">Seniors(65+)</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select> </div>
                    </div> <a href="#" class="btn btn-primary float-right mt-5">Cari Surat</a>
                </div>
            </div>
        </div>
    </div>
    <!--Tabel-->

    <?php if (empty($tablerow)||$tablerow===0) { ?>
       <div class="container" style="margin-top:20vh; margin-bottom:20vh">
            <p class="text-center">
                Tidak terdapat arsip disini. Silahkan di isi terlebih dahulu untuk melihat tabel data arsip!
            </p>
        </div>
    <?php } else { ?>
        <div class="container table-responsive">
            <table class="table table-striped table-bordered" id="tabel_arsip" style="width: 100%">
                <thead class="">
                    <tr>
                        <th>No. Arsip</th>
                        <th>Keterangan</th>
                        <th>Tgl. Masuk Arsip</th>
                        <th>Klasifikasi</th>
                        <th>Jenis Arsip</th>
                    </tr>
                </thead>

            </table>
        </div>
    <?php } ?>

</div>