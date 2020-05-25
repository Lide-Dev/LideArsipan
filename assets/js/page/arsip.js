


$(document).ready(function () {
  $.ajax({
    url: "http://localhost/LideArsipan/ajaxarsip/count",
    type: 'post',
    dataType: "JSON",
    success: function (data) {
      console.log(data);
      if (data['type'] === "emp") {
        console.log('1');
        $('#tabel_arsip').html('');
        $('#div-table').hide();
      }
      else {
        var columns=[''];
        if (data['type'] === "dp") {
          columns[0] = "id_kode";
          columns[1] = "klasifikasi";
          columns[2] = "perihal";
          columns[3] = "tgl_penerimaan";
        }
        else {
          columns[0] = "id_kode";
          columns[1] = "klasifikasi";
          columns[2] = "keterangan";
          columns[3] = "tgl_penerimaan";
        }
        console.log(columns)
        if (data['rows'] > 0) {
          console.log('2');
          $('#div-table').show();

          $('#tabel_arsip').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "order": [[0, 'asc']], // Default sortingnya berdasarkan kolom /field ke 0 (paling pertama)
            "ajax": {
              "url": "http://localhost/LideArsipan/ajaxarsip/table", // URL file untuk proses select datanya
              "type": "POST"
            },
            "deferRender": true,
            "aLengthMenu": [[20, 10, 50], [5, 10, 50]], // Combobox Limit
            "columns": [
              { "data": columns[0] }, // Tampilkan nis
              { "data": columns[1] },  // Tampilkan nama
              { "data": columns[2] },
              { "data": columns[3] },
              // Tampilkan telepon
              // Tampilkan alamat
              {
                "render": function (data, type, row) {
                  // Tampilkan kolom aksi
                  var html = "<a href=''>EDIT</a> | "
                  html += "<a href=''>DELETE</a>"
                  return html
                },
                "orderable": false
              }
            ],
            "drawCallback": function (settings) {
              // Here the response
              var response = settings.json;
              console.log(response);
            }
          });
        }
      }
    }
  });

});

$("#flip_arsip").click(function () {
  $("#panel_arsip").slideToggle("2000", 'linear', function () {
    $("#chevron_nav").removeClass('fa-chevron-down');
    $("#chevron_nav").addClass('fa-chevron-up');
  },
    function () {
      $("#chevron_nav").addClass('fa-chevron-down');
      $("#chevron_nav").removeClass('fa-chevron-up');
    });
});

$("#form_kategori").autocomplete({
  source: function (request, response) {
    // Fetch data
    $.ajax({
      url: "http://localhost/LideArsipan/ksurat/kategori",
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
      console.log(tentang[i]);
    }
    var kodestr = kode.join("/");
    $.ajax({
      url: "http://localhost/LideArsipan/ksurat/kode",
      type: 'post',
      data: {
        kodevar: kode,
      }
    });
    $("#form_kategori").val();
    $("#kode").html("Kode yang dipilih: " + kodestr);
    $("#tentang").html(tentangstr);
    $("#div_form_kategori").hide(500);
    $.ajax({
      url: "http://localhost/LideArsipan/ksurat/cekkode/kode",
      type: 'post',
      data: {
        kodevar: kode,
      },
      dataType: "text",
      success: function (data) {
        console.log(data);
        valid = data;
        if (valid != 0) {
          $("#div_form_kode").delay(550).show(500);
          $.ajax({
            url: "http://localhost/LideArsipan/ksurat/kodeutama",
            type: 'post',
            dataType: "",
            success: function (data) {
              console.log(data);
              $("#form_kode").html(data);
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
  console.log(kode);
  $.ajax({
    url: "http://localhost/LideArsipan/ksurat/kode",
    type: 'post',
    data: {
      kodevar: kode,
    },
    success: function () {
      $.ajax({
        url: "http://localhost/LideArsipan/ksurat/desckode",
        type: 'post',
        dataType: 'text',
        success: function (data) {
          console.log(data);
          $("#tentang").html("Deskripsi Kode: " + data);
        }
      });
    }
  });
  $("#kode").html("Kode yang dipilih: " + kode);
  $.ajax({
    url: "http://localhost/LideArsipan/ksurat/cekkode/subkode1",
    type: 'post',
    data: {
      kodevar: kode,
    },
    dataType: "text",
    success: function (data) {
      valid = data;
      if (valid != 0) {
        $("#div_form_kode").delay(550).show(500);
        $.ajax({
          url: "http://localhost/LideArsipan/ksurat/subkode1",
          type: 'post',
          dataType: "html",
          success: function (data) {
            $("#div_form_subkode1").show(500);
            console.log(data);
            $("#form_subkode1").html(data);
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
    url: "http://localhost/LideArsipan/ksurat/kode",
    type: 'post',
    data: {
      kodevar: kode,
    },
    success: function () {
      $.ajax({
        url: "http://localhost/LideArsipan/ksurat/desckode",
        type: 'post',
        dataType: 'text',
        success: function (data) {
          console.log(data);
          $("#tentang").html("Deskripsi Kode: " + data);
        }
      });
    }
  });

  $("#kode").html("Kode yang dipilih: " + kode);
  $.ajax({
    url: "http://localhost/LideArsipan/ksurat/cekkode/subkode2",
    type: 'post',
    data: {
      kodevar: kode,
    },
    dataType: "text",
    success: function (data) {
      console.log("Sebanyak:" + data);
      valid = data;
      if (valid != 0) {
        $("#div_form_kode").delay(550).show(500);
        $.ajax({
          url: "http://localhost/LideArsipan/ksurat/subkode2",
          type: 'post',
          dataType: "html",
          success: function (data) {
            $("#div_form_subkode2").show(500);
            console.log(data);
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
    url: "http://localhost/LideArsipan/ksurat/kode",
    type: 'post',
    data: {
      kodevar: kode,
    },
    success: function () {
      $.ajax({
        url: "http://localhost/LideArsipan/ksurat/desckode",
        type: 'post',
        dataType: 'text',
        success: function (data) {
          console.log(data);
          $("#tentang").html("Deskripsi Kode: " + data);
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
    url: "http://localhost/LideArsipan/ksurat/kode",
    type: 'post',
    data: {
      kodevar: "000/0/0/0",
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
    url: "http://localhost/LideArsipan/ksurat/desckode",
    type: 'post',
    dataType: 'text',
    success: function (data) {
      $('#tentang_pilih').html(data);
    }
  });
  $.ajax({
    url: "http://localhost/LideArsipan/ksurat/getkode",
    type: 'post',
    dataType: 'text',
    success: function (data) {
      $("#kode_pilih").html(data);
    }
  });
  $(".btn_form_pilih").prop('disabled', true);
});


