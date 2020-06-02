<div class="container " style="margin-top:20vh; margin-bottom:20vh">
    <div class="container">
        <div class="row my-5 bg-londonsquare rounded d-flex align-content-center">
            <div id="progress1" class='bg-mintygreen text-center text-white col-auto rounded-left' style="width: 0%;">
                <h3 style="color: rgba(0, 0, 0, 0);">30%</h3>
                <p style="color: rgba(0, 0, 0, 0);">Surat Aktif</p>
            </div>
            <div id="progress2" class='bg-chromeyellow text-center text-white col-auto' style="width: 0%;">
                <h3 style="color: rgba(0, 0, 0, 0);">10%</h3>
                <p style="color: rgba(0, 0, 0, 0);">Sampah Surat</p>
            </div>
            <div id="progress3" class='bg-londonsquare text-center text-white col-auto rounded-right' style="width: 0%;">
                <h3 style="color: rgba(0, 0, 0, 0);">60%</h3>
                <p style="color: rgba(0, 0, 0, 0);">Penyimpanan Server</p>
            </div>
        </div>
    </div>

    <div class="container my-3 rounded bg-light p-3">
        <h5>Besar Penyimpanan Arsip</h5>
        <div class="row p-2">
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>
                            <b>Surat Aktif</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            220 MB
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Sampah Surat</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            120 MB
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Disiapkan untuk Sistem</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            110 MB
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table">
                    <tr>
                        <td>
                            <b>Penyimpanan Tersisa</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            550 MB
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Total Penyimpanan Server</b>
                        </td>
                        <td>
                            :
                        </td>
                        <td>
                            1 GB
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class='form-row my-5'>
            <div class="col-6">
                <input type="text" class="form-control" name="search" id="ar_search" aria-describedby="helpSearch" placeholder="Pencarian ID">
                <small id='helpSearch' class="form-text text-muted">Pencarian akan dilakukan jika melebihi 2 karakter huruf di kolom pencarian.</small>
                <small id='helpSearch' class="form-text text-muted">Kosongkan kolom pencarian jika ingin melihat semua arsip.</small>
            </div>
            <div class="col-2">
                <button id="ar_btnsearch" class='btn disabled'>Cari</button>
            </div>
            <div class="col-4">
                  <input type="text" class="form-control" name="tglhapus" id="ar_tglhapus" placeholder="Tanggal Hapus">
            </div>
        </div>
    </div>

    <div class="container my-3">
        <div class="table-responsive">
            <table class="table table-inverse " id='table-sampah'>
                <thead class="thead-inverse">
                    <tr>
                        <th>ID Surat</th>
                        <th>Tanggal Hapus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>