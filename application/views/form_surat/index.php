<?php
/**
 * Pages: Form Surat
 * Pages ini berfungsi untuk membuat surat.
 */
?>

<div class="container">
  <div style="text-align: center;" class="mt-3 mb-3">
    <h2>REGISTRASI SURAT</h2>
  </div>
  <form>
  <div class="my-5">
    <p>Kode Surat</p>
    <div class="container p-3" style="background-color: #808e9b; border-radius: 5px;">
      <div class="row">
        <div class="col-md-6">
        <p id="kode">Kode yang dipilih: 000/0/0/0</p>
        </div>
        <div class="col-md-6">
        <p id="tentang">Tentang: Belum dipilih</p>
        </div>
      </div>
      <div class="form-row" id="form_row">
        <div id="div_form_kategori"  class="form-group col-md-6">
          <label class="" for="form_kategori">Kategori</label>
          <input type="text" class="form-control" id="form_kategori">
        </div>
        <div id="div_form_kode" class="form-group col-md-6" style="display: none">
          <label for="form_kode">Kode Utama</label>
          <input type="text" class="form-control" id="form_kode">
        </div>
        <div id="div_form_subkode1" class="form-group col-md-6" style="display: none">
          <label for="form_subkode1">Sub Kode 1</label>
          <input type="text" class="form-control" id="form_subkode1">
        </div>
        <div id="div_form_subkode2"  class="form-group col-md-6" style="display: none">
          <label for="form_subkode2">Sub Kode 2</label>
          <input type="text" class="form-control" id="form_subkode2">
        </div>
        <small class="form-text text-white col-md-12">Pemilihan kode surat awalnya memilih kategori. Setelah itu kode utama dan seterusnya.</small>
      </div>
      <div class="row">
        <div class="col-md-12 mt-2">
        <button type="button" class="btn btn-success btn-md"><span class="fas fa-check"></span></button>
        <button type="button" class="btn btn-danger btn-md"><span class="fas fa-times"></span></button>
        <!-- button type="button" class="btn btn-freespeechblue px-3" disabled>Pilih</button -->
        </div>
      </div>
    </div>
    </div><!-- End of form surat -->

    <div class="form-group">
    <label for="nama">Pilih Surat</label>
    <div class="input-group mb-3">
      <div class="custom-file">
       <input type="file" class="custom-file-input" id="inputGroupFile02">
        <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
      </div>
      <div class="input-group-append">
        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
      </div>
    </div>
    </div>

    <div class="form-group">
      <label for="nama">Asal Surat</label>
      <input type="text" id="nama" class="form-control" placeholder="">
    </div>

    <div class="form-group">
      <label for="umur">Isi Ringkas</label>
      <textarea type="number" id="umur" class="form-control" placeholder=""></textarea>
    </div>

    <div class="form-group">
      <label for="alamat">Keterangan</label>
      <textarea class="form-control" id="alamat" rows="3" placeholder=""></textarea>
    </div>

    <button type="submit" class="btn btn-primary mb-3">Submit</button>
  </form>
</div>