<?php

/**
 * Pages: Form Surat
 * Pages ini berfungsi untuk membuat surat.
 */
$typeallowed = array('sm' => false, 'sk' => false, 'dp' => false);
$active = array('', '', '');
$ariaactive = array('false', 'false', 'false');
$role = strtolower($permission->nama);

if ($role === 'admin') {
  $typeallowed['sm'] = $typeallowed['sk'] = $typeallowed['dp'] = true;
  $active[0] = 'active';
  $ariaactive[0] = 'true';
} else if ($role === 'operator') {
  $typeallowed['sm'] = $typeallowed['sk'] = true;
  $active[0] = 'active';
  $ariaactive[0] = 'true';
} else {
  $typeallowed['dp'] = true;
  $active[2] = 'active';
  $ariaactive[2] = 'true';
}



?>

<div class="container">
  <div style="text-align: center;" class="mt-3 mb-3">
    <h2>REGISTRASI SURAT</h2>
  </div>
  <?= (empty($this->session->flashdata('message'))) ? ""  : $this->session->flashdata('message')  ?>
  <?php $hidden = array('vldt' => '');
  echo form_open_multipart(base_url('registrasi-surat/form'), array("id" => "form_surat")) //<form> tag tetapi di panggil lewat CodeIgniter
  ?>

  <!-- form disposisi -->
  <p><b>Form Disposisi</b></p>
  <div class="container border border-hintofelusive rounded p-3">

  <div class="form-group">
    <label id="label-ditujukan" for="form_ditujukan"><b class="text-danger">*</b>Ditujukan kepada</label>
    <input type="text" id="form_ditujukan" class="form-control" placeholder="" name="">
  </div>

  <div class="form-group">
    <label id="label-pengirimsurat" for="form_pengirimsurat"><b class="text-danger">*</b>Pengirim surat</label>
    <input type="text" id="form_pengirimsurat" class="form-control" placeholder="" name="">
  </div>

  <div class="form-group">
    <label id="label-isi_disposisi" for="form_isi_disposisi">Isi Disposisi</label>
    <textarea type="text" id="form_isi_disposisi" class="form-control" placeholder="" name=""></textarea>
  </div>

  </div>

  <!-- end of form disposisi -->

  <div class="mt-2 mb-3">
    <p><b class="text-danger ">*</b>Klasifikasi Surat</p>
    <div class="container border border-hintofelusive rounded p-3">
      <div id="div_container_kode">
        <div class="row">
          <div class="col-md-6">
            <p id="kode">Kode yang dipilih: 000/0/0/0</p>
          </div>
          <div class="col-md-6">
            <p id="tentang">Tentang: Belum dipilih</p>
          </div>
        </div>

        <div class="form-row" id="form_row">
          <div id="div_form_kategori" class="form-group col-md-6 ">
            <label class="" for="form_kategori">Kategori</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-search" aria-hidden="true"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="form_kategori" name="kategori">
            </div>


          </div>
          <div id="div_form_kode" class="form-group col-md-6" style="display: none">
            <label for="form_kode">Kode Utama</label>
            <select class="form-control" id="form_kode">
            </select>
          </div>
          <div id="div_form_subkode1" class="form-group col-md-6" style="display: none">
            <label for="form_subkode1">Sub Kode 1</label>
            <select class="form-control" id="form_subkode1">
            </select>
          </div>
          <div id="div_form_subkode2" class="form-group col-md-6" style="display: none">
            <label for="form_subkode2">Sub Kode 2</label>
            <select class="form-control" id="form_subkode2">
            </select>
          </div>
          <div id="div_form_done" class="form-group col-md-6" style="display: none">
            <p class=" font-weight-bold">Tidak terdapat pilihan lagi.</p>
          </div>
          <small class="form-text col-md-12"><i>Pemilihan kode surat awalnya memilih kategori. Setelah itu kode utama dan seterusnya.</i></small>
          <small id="div_form_count" class="form-text text-warning col-md-12">Tombol akan aktif jika telah memilih kategori!</small>
          <label id='form-kategori-error' class="form-text error col-md-12" for="form_kategori"></label>
        </div>
      </div>
      <div id="div_container_donekode" class="container pt-3" style="display: none">
        <div class="row">
          <p class="col-md-6">Kode yang dipilih adalah: <b id="kode_pilih"></b></p>
          <p class="col-md-6">Deskripsi Kode: <b id="tentang_pilih"></b></p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 mt-2">
          <span class="d-none d-md-inline-block">
            <button id="" type="button" class="btn btn-outline-success btn-md btn_form_pilih" disabled>
              <span class="fas fa-check"></span> Pilih
            </button>
          </span>
          <span class="d-none d-md-inline-block">
            <button id="" type="button" class="btn btn-outline-danger btn-md btn_form_ulang" disabled><span class="fas fa-times"> </span> Ulang</button>
          </span>
          <button id="" type="button" class="btn btn-success btn-md d-md-none btn_form_pilih" disabled><span class="fas fa-check"></span></button>
          <button id="" type="button" class="btn btn-danger btn-md d-md-none btn_form_ulang" disabled><span class="fas fa-times"></span></button>
          <!-- button type="button" class="btn btn-freespeechblue px-3" disabled>Pilih</button -->
        </div>
      </div>
    </div>

  </div><!-- End of form surat -->

  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="form_nosurat"><b class="text-danger">*</b>Nomor Surat</label>
      <input type="text" id="form_nosurat" class="form-control" name="nosurat" placeholder="">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-3">
      <label for="form_penerimaansurat"><b class="text-danger">*</b>Tanggal Penerimaan Surat</label>
      <input type="text" id="form_penerimaansurat" class="form-control form-tgl" name="tglpenerimaansurat" placeholder="">
    </div>
    <div class="form-group col-md-3">
      <label for="form_pembuatansurat"><b class="text-danger">*</b>Tanggal Pembuatan Surat</label>
      <input type="text" id="form_pembuatansurat" class="form-control form-tgl" name="tglpembuatansurat" placeholder="">
    </div>
  </div>

  <div class="form-row" id="div_noagenda">
    <div class="form-group col-md-6">
      <label id="label-noagenda" for="form_noagenda"><b class="text-danger">*</b>Nomor Agenda</label>
      <input type="text" id="form_noagenda" class="form-control" placeholder="" name="noagenda">
    </div>
    <div class="form-group col-md-6">
      <label id="label-perihal" for="form_perihal"><b class="text-danger">*</b>Perihal</label>
      <input type="text" id="form_perihal" class="form-control" placeholder="" name="perihal">
    </div>
  </div>

  <div class="form-group">
    <label id="label-lokasiarsip" for="form_lokasiarsip"><b class="text-danger">*</b>Lokasi Arsip</label>
    <input type="text" id="form_lokasiarsip" class="form-control" placeholder="" name="lokasiarsip">
  </div>

  <div class="form-group">
    <label id="label-isi" for="form_isi">Isi Ringkas</label>
    <textarea type="text" id="form_isi" class="form-control" placeholder="" name="isiringkas"></textarea>
  </div>

  <div id="div_keterangan" class="form-group">
    <label for="form_keterangan">Keterangan</label>
    <textarea class="form-control" id="form_keterangan" rows="3" placeholder="" name="keterangan"></textarea>
  </div>

  <div class="form-group">
    <label for="nama">Pilih File Surat</label>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text bg-hintofelusive" id="form_suratdocspan">Surat : </span>
      </div>
      <div class="custom-file col-md-6">
        <input type="file" class="custom-file-input" id="form_suratdoc" name="uploaddoc" accept="application/pdf,image/jpg,image/jpeg,image/png,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document">
        <label class="custom-file-label" for="form_suratdoc" id="label_suratdoc">Pilih file...</label>
      </div>
    </div>
    <small class="form-text text-muted">File yang diterima adalah: Gambar (jpg,png,jpeg), PDF, dan Dokumen. Maksimal 10 MB.</small>
    <label id='form_suratdoc-error' class="error" for="form_suratdoc"></label>
  </div>


  <button type="submit" class="btn btn-outline-primary mb-4"><i class="fas fa-save"></i> Simpan Arsip</button>
  </form>
</div>