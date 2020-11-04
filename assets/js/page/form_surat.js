if (typeof config !== 'undefined') {
  var baseurl = config.baseurl();
}
else {
  var baseurl = "https://arsipcondongcatur.com/"
}
var csrfN = "vldt";
var csrfH = "";

$(document).ready(function () {
  csrfH = $("input[name='vldt']").val();
  $("#form_tipesurat2").prop("checked", false);
  $("#form_tipesurat3").prop("checked", true);
  $("#form_tipesurat1").prop("checked", true);
  $("#form_perihal").rules("remove");
  $("#form_noagenda").rules("remove");
  $("#div_noagenda").hide();
  $("#div_keterangan").show();
  $("#label-asalsurat").html("<b class='text-danger'>*</b>Asal Surat");
  $("#label-lokasiarsip").html("<b class='text-danger'>*</b>Lokasi Arsip");
  $("#label-isi").html("Isi Ringkas");
});

$(".form-tgl").datepicker({
  changeMonth: true,
  changeYear: true,
  showButtonPanel: true,
  dateFormat: 'dd/mm/yy',
  maxDate: 0
});

$("#label_tipesurat1").click(function () {
  $("#form_tipesurat1").prop("checked", true);
  $("#form_tipesurat2").prop("checked", false);
  $("#form_tipesurat3").prop("checked", false);
  $("#form_perihal").rules("remove");
  $("#form_noagenda").rules("remove");
  $("#div_noagenda").hide();
  $("#div_keterangan").show();
  $("#label-asalsurat").html("<b class='text-danger'>*</b>Asal Surat");
  $("#label-lokasiarsip").html("<b class='text-danger'>*</b>Lokasi Arsip");
  $("#label-isi").html("Isi Ringkas");
});

$("#label_tipesurat2").click(function () {
  $("#form_tipesurat2").prop("checked", true);
  $("#form_tipesurat3").prop("checked", false);
  $("#form_tipesurat1").prop("checked", false);
  $("#form_perihal").rules("remove");
  $("#form_noagenda").rules("remove");
  $("#div_noagenda").hide();
  $("#div_keterangan").show();
  $("#label-asalsurat").html("<b class='text-danger'>*</b>Dituju Kepada");
  $("#label-lokasiarsip").html("<b class='text-danger'>*</b>Lokasi Arsip");
  $("#label-isi").html("Isi Ringkas");
});

$("#label_tipesurat3").click(function () {
  $("#form_tipesurat3").prop("checked", true);
  $("#form_tipesurat1").prop("checked", false);
  $("#form_tipesurat2").prop("checked", false);
  $("#div_noagenda").show();
  $("#div_keterangan").hide();
  $("#label-asalsurat").html("<b class='text-danger'>*</b>Dituju Kepada");
  $("#label-lokasiarsip").html("<b class='text-danger'>*</b>Pengirim/Asal Surat");
  $("#label-isi").html("Isi Disposisi");
  $("#form_noagenda").rules("add", {
    required: true,
    maxlength: 254,
    messages: {
      required: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Mohon di isi nomor agenda!</small>",
      maxlength: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Teks tidak boleh melebihi 254 karakter!</small>",
    }
  });
  $("#form_perihal").rules("add", {
    required: true,
    maxlength: 254,
    messages: {
      required: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Mohon di isi perihal!</small>",
      maxlength: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Teks tidak boleh melebihi 254 karakter!</small>",
    }
  });

});


$("#form_kategori").autocomplete({
  source: function (request, response) {
    // Fetch data
    $.ajax({
      url: baseurl + "registrasi_surat/kode/search/get/kategori",
      type: 'get',
      dataType: "JSON",
      data: {
        search: request.term
      },
      success: function (data) {
        response(data.slice(0, 10));
      }
    });
  }, // Kode php untuk prosesing data.

  select: function (event, ui) {
    $(".btn_form_pilih").prop("disabled", false);
    $(".btn_form_ulang").prop("disabled", false);
    var valid = "";
    var str = ui.item.label;
    var tentang = str.split(" ");
    var kode = tentang[0].split(".");
    var tentangstr = "";
    for (var i = 0; i < tentang.length; i++) {
      if (i == 0) {
        continue;
      }
      tentangstr += tentang[i] + " ";
    }
    var kodestr = kode.join("/");
    $.ajax({
      url: baseurl + "registrasi-surat/kode/patch",
      type: 'post',
      data: {
        kodevar: kode, //[csrfN]: csrfH
      },
      dataType: 'JSON',
      success: function (data) {
        // $("input[name='vldt']").val(data.token);
        // csrfH = $("input[name='vldt']").val();
      }
    });
    $("#form_kategori").val();
    $("#kode").html("Kode yang dipilih: " + kodestr);
    $("#tentang").html(tentangstr);
    $("#div_form_kategori").hide(500);
    $.ajax({
      url: baseurl + "registrasi-surat/kode/valid/get/kode",
      type: 'get',
      data: {
        kodevar: kode
      },
      dataType: "JSON",
      success: function (data) {

        valid = data.count;
        if (valid != 0) {
          $("#div_form_kode").delay(550).show(500);
          $.ajax({
            url: baseurl + "registrasi_surat/kode/search/get/kodeutama",
            type: 'get',
            dataType: "JSON",
            success: function (data) {
              $("#form_kode").html(data.result);
            }
          });
        }
        else
          $("#div_form_done").delay(550).show(500);
      }
    });
  }
});


$("#form_kode").on('change', function () {
  var kode = $("#form_kode option:selected").val();

  $.ajax({
    url: baseurl + "registrasi-surat/kode/patch",
    type: 'post',
    data: {
      kodevar: kode//, [csrfN]: csrfH
    },
    dataType: 'JSON',
    success: function (data) {
      // $("input[name='vldt']").val(data.token);
      // csrfH = $("input[name='vldt']").val();
      $.ajax({
        url: baseurl + "registrasi-surat/kode/get/description",
        type: 'get',
        dataType: 'JSON',
        success: function (data) {

          $("#tentang").html("Deskripsi Kode: " + data.result);
        }
      });
    }
  });
  $("#kode").html("Kode yang dipilih: " + kode);
  $.ajax({
    url: baseurl + "registrasi-surat/kode/valid/get/subkode1",
    type: 'get',
    data: {
      kodevar: kode
    },
    dataType: "JSON",
    success: function (data) {

      valid = data.count;
      if (valid != 0) {
        $("#div_form_kode").delay(550).show(500);
        $.ajax({
          url: baseurl + "registrasi_surat/kode/search/get/subkode1",
          type: 'get',
          dataType: "JSON",
          success: function (data) {
            $("#div_form_subkode1").show(500);
            $("#form_subkode1").html(data.result);
          }
        });
      }
      else
        $("#div_form_subkode1").hide(500);
        $("#div_form_subkode2").hide(500);
    }
  });
});



$("#form_subkode1").on('change', function () {
  var kode = $("#form_subkode1 option:selected").val();
  $.ajax({
    url: baseurl + "registrasi-surat/kode/patch",
    type: 'post',
    data: {
      kodevar: kode, [csrfN]: csrfH
    },
    dataType: 'JSON',
    success: function (data) {
      $("input[name='vldt']").val(data.token);
      csrfH = $("input[name='vldt']").val();
      $.ajax({
        url: baseurl + "registrasi-surat/kode/get/description",
        type: 'get',
        dataType: 'JSON',
        success: function (data) {

          $("#tentang").html("Deskripsi Kode: " + data.result);
        }
      });
    }
  });

  $("#kode").html("Kode yang dipilih: " + kode);
  $.ajax({
    url: baseurl + "registrasi-ssurat/kode/valid/get/subkode2",
    type: 'get',
    data: {
      kodevar: kode
    },
    dataType: "JSON",
    success: function (data) {

      valid = data.count;
      if (valid != 0) {
        $("#div_form_kode").delay(550).show(500);
        $.ajax({
          url: baseurl + "registrasi_surat/kode/search/get/subkode2",
          type: 'get',
          dataType: "JSON",
          success: function (data) {
            $("#div_form_subkode2").show(500);
            $("#form_subkode2").html(data);
          }
        });
      }
      else
        $("#div_form_subkode2").hide(500);
    }
  });

});

$("#form_subkode2").on('change', function () {
  var kode = $("#form_subkode2 option:selected").val();
  $.ajax({
    url: baseurl + "registrasi-surat/kode/patch",
    type: 'post',
    data: {
      kodevar: kode,// [csrfN]: csrfH
    },
    dataType: 'JSON',
    success: function (data) {
      // $("input[name='vldt']").val(data.token);
      // csrfH = $("input[name='vldt']").val();
      $.ajax({
        url: baseurl + "registrasi-surat/kode/get/description",
        type: 'get',
        dataType: 'JSON',
        success: function (data) {
          $("#tentang").html("Deskripsi Kode: " + data.result);
        }
      });
    }
  });
  $("#kode").html("Kode yang dipilih: " + kode);
});

$(".btn_form_ulang").click(function () {
  $("#div_container_donekode").hide(1000);
  $("#div_container_kode").delay(1000).show(500);
  $.ajax({
    url: baseurl + "registrasi-surat/kode/patch",
    type: 'post',
    data: {
      kodevar: "000/0/0/0",// [csrfN]: csrfH
    },
    dataType: 'JSON',
    success: function (data) {
      // $("input[name='vldt']").val(data.token);
      // csrfH = $("input[name='vldt']").val();
    }
  });
  $("#kode").html("Kode yang dipilih: 000/0/0/0")
  $("#tentang").html("Deskripsi Kode: Belum dipilih")
  $("#div_form_kode").hide(500);
  $("#div_form_subkode1").hide(500);
  $("#div_form_subkode2").hide(500);
  $("#div_form_done").hide(500);
  $("#form_kode").html("");
  $("#form_subkode1").html("");
  $("#form_subkode2").html("");
  $("#form_kategori").val("");
  $("#div_form_kategori").delay(550).show(500);
  $(".btn_form_ulang").prop('disabled', true);
  $(".btn_form_pilih").prop('disabled', true);
});

$(".btn_form_pilih").click(function () {
  $("#div_container_kode").hide(500);
  $("#div_container_donekode").delay(550).show(500);
  $.ajax({
    url: baseurl + "registrasi-surat/kode/get/description",
    type: 'get',
    dataType: 'JSON',
    success: function (data) {
      $('#tentang_pilih').html(data.result);
    }
  });
  $.ajax({
    url: baseurl + "registrasi-surat/kode/get",
    type: 'get',
    dataType: 'json',
    success: function (data) {
      $("#kode_pilih").html(data.result);
    }
  });
  $(".btn_form_pilih").prop('disabled', true);
});


$('#form_suratdoc').change(function (e) {
  var fileName = e.target.files[0].name;
  $("#label_suratdoc").html(fileName);
});


$("#form_surat").validate({
  rules: {
    kategori: "required",
    nosurat: {
      required: true
    },
    tglpenerimaansurat: {
      required: true,
      minlength: 10,
      maxlength: 10,
      pattern: /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/
    },
    tglpembuatansurat: {
      required: true,
      minlength: 10,
      maxlength: 11,
      pattern: /^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/
    },
    asalsurat: {
      required: true,
      maxlength: 255
    },
    lokasiarsip: {
      required: true,
      maxlength: 255
    },
    uploaddoc: {
      required: true,
    }
  },
  messages: {
    kategori: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Setidaknya memilih satu klasifikasi surat.</small>",
    nosurat: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Mohon di isi nomor suratnya</small>",
    lokasiarsip: {
      required: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Mohon di isi bagian ini</small>",
      maxlength: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Maksimal karakter kata adalah 255.</small>",
    },
    asalsurat: {
      required: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Mohon di isi bagian ini</small>",
      maxlength: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Maksimal karakter kata adalah 255.</small>",
    },
    tglpenerimaansurat: {
      required: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Mohon di isi tanggal penerimaan suratnya</small>",
      minlength: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Format tanggal tidak benar!</small>",
      maxlength: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Format tanggal tidak benar!</small>",
      pattern: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Format tanggal tidak benar!</small>"
    },
    tglpembuatansurat: {
      required: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Mohon di isi tanggal pembuatan suratnya</small>",
      minlength: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Format tanggal tidak benar!</small>",
      maxlength: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Format tanggal tidak benar!</small>",
      pattern: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Format tanggal tidak benar!</small>"
    },
    uploaddoc: {
      required: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Mohon di pilih file surat yang ingin di upload!</small>",
      accept: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Format file tidak benar!</small>",
    },
    submitHandler: function (form) {
      form.submit();
    }

  },
});