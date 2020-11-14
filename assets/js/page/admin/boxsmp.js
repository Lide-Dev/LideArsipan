if (typeof config !== 'undefined') {
  var baseurl = config.baseurl();
}
else {
  var baseurl = "https://arsipcondongcatur.com/"
}

var searchbox, searchbox2, tempsearch, tempsearch2

$(document).ready(function () {
  var table = $('#table_sampah').DataTable({
    "processing": true,
    "serverSide": true,
    "ordering": true,
    "order": [[0, 'asc']], // Default sortingnya berdasarkan kolom /field ke 0 (paling pertama)
    "sDom": "ltipr",
    "lengthChange": false,
    "ajax": {
      "url": baseurl + "admin/filemanager/table", // URL file untuk proses select datanya
      "type": "get"
    },
    "deferRender": true,
    "columns": [
      {
        "render": function (data, type, row) {
          html = row.id+ (row.kadaluarsa?"<span class='badge badge-danger ml-2'>Kadaluarsa</span>":"");
          return html
        }
      }, // Tampilkan nis
      { "data": 'update_time' },  // Tampilkan nama
      {
        "render": function (data, type, row, full) {
          var classs = "btn glyphicon glyphicon-play whiteText";
          var content1 = "<i class='fa fa-history' style='color: #05c46b'></i>";
          var content2 = "<i class='fas fa-envelope-open-text' style='color: #00d8d6''></i>";
          var content3 = "<i class='fas fa-trash-alt' style='color: #ff3f34'></i>";
          var html = "<i class='" + classs + " recover' data-toggle='tooltip' data-placement='top' title='Edit Surat' aria-hidden='true'>" + content1 + "</i>"
          html += " <i class='" + classs + " open' data-toggle='tooltip' data-placement='top' title='Buka Surat' aria-hidden='true'>" + content2 + "</i> "
          html += "<i class='" + classs + " delete' data-toggle='tooltip' data-placement='top' title='Hapus Surat' aria-hidden='true'>" + content3 + "</i>"
          return html
        },
        "orderable": false
      }
    ]
  });
  //--------------------------------
  var search = $.fn.dataTable.util.throttle(
    function (val) {
      table.search(val).draw();
    },
    1000
  );

  $('#ar_search').keyup(function () {
    searchbox2 = $('#ar_search').val();
    if (searchbox2.length > 1) {
      $('#ar_btnsearch').removeClass('disabled');
      $('#ar_btnsearch').addClass('btn-outline-freespeechblue');
    }
    else {
      if (tempsearch2 != searchbox && searchbox2.length == 0) {
        search(searchbox2);
        tempsearch2 = searchbox;
      }
      $('#ar_btnsearch').addClass('disabled ');
      $('#ar_btnsearch').removeClass('btn-outline-freespeechblue');
    }
  });

  $('#ar_btnsearch').click(function () {
    searchbox = $('#ar_search').val();
    if (tempsearch != searchbox && searchbox.length >= 2) {
      search(searchbox);
      tempsearch = searchbox;
    }
  });

  $('#ar_search').keypress(function (e) {
    var key = e.which;
    if (key == 13) {
      $('#ar_btnsearch').click();
    }
  });
  //-------------------------------
  $('#table_sampah tbody').on('click', '.open', function () {
    resetmodal();
    var data = table.row($(this).parents('tr')).data();
    $('#modalLabel').text('Membuka Arsip');
    $('#modalbox').modal('show');
    var arrkey = Object.keys(data);
    openpage(data[arrkey[0]]);
  });

  $('#table_sampah tbody').on('click', '.delete', function () {
    resetmodal();
    var data = table.row($(this).parents('tr')).data();

    $('#modalLabel').text('Membuang Arsip');
    $('#modalbox').modal('show');
    $('#okID').show();
    var arrkey = Object.keys(data);
    deletepage(data[arrkey[0]]);
  });

  $('#table_sampah tbody').on('click', '.recover', function () {
    resetmodal();
    var data = table.row($(this).parents('tr')).data();
    $('#modalLabel').text('Mengubah Data Arsip');
    $('#modalbox').modal('show');
    $('#okID').show();
    var arrkey = Object.keys(data);
    recoverpage(data[arrkey[0]]);
  });
})

$("#progress1").animate({
  width: $("#progress1").data('percentage') + "%"
}, {
  duration: 300,
  done: function () {
    $("#progress2").animate({
      width: $("#progress2").data('percentage') + "%"
    }, {
      duration: 300,
      done: function () {
        $("#progress3").animate({
          width: $("#progress3").data('percentage') + "%"
        }, {
          duration: 300,
          done: function () {
            $("#progress4").animate({
              width: $("#progress4").data('percentage') + "%"
            }, {
              duration: 1,
              done: function () {
                $("#progress1 p, #progress1 h3, #progress2 p, #progress2 h3, #progress3 p, #progress3 h3, #progress4 p, #progress4 h3").animate({
                  color: "rgba(255, 255, 255, 1)"
                }, 1000);
              }
            });
          }
        });
      }
    });
  }
});


function openpage(data) {
  $.ajax({
    url: baseurl + "admin/filemanager/modal/get/open",
    data: { 'send': data },
    type: "get",
    dataType: "html",
    beforeSend: function () {
      $('#ab_content').html('');
      $('#ab_form').html('');
      $('#ab_spinner').show();
      $('#modal_footer').hide();
      $('#ab_content').hide();
      $('#ab_form').hide();
    },
    success: function (data) {
      $("#ab_content").html(data);
      $('#ab_spinner').hide();
      $('#modal_footer').show();
      $('#ab_content').show();
      //$('#ab_form').show();
    }
  });
}

function deletepage(data) {
  // console.log('test');
  $.ajax({
    url: baseurl + "admin/filemanager/modal/get/delete",
    data: { 'send': data },
    type: "get",
    dataType: "html",
    beforeSend: function () {
      $('#ab_content').html('');
      $('#ab_form').html('');
      $('#ab_spinner').show();
      $('#modal_footer').hide();
      $('#ab_content').hide();
      $('#ab_form').hide();
    },
    success: function (data) {
      $("#ab_content").html(data);
      $('#ab_spinner').hide();
      $('#modal_footer').show();
      $('#ab_content').show();
      $('#formbox').addClass('del');
      //$('#ab_form').show();
    }
  });
}

function recoverpage(data) {
  $.ajax({
    url: baseurl + "admin/filemanager/modal/get/recover",
    data: { 'send': data },
    type: "get",
    dataType: "html",
    beforeSend: function () {
      $('#ab_spinner').show();
      $('#modal_footer').hide();
      $('#ab_content').hide();
      $('#ab_form').hide();
    },
    success: function (data) {
      $("#ab_content").html(data);
      $('#ab_spinner').hide();
      $('#modal_footer').show();
      $('#ab_content').show();
      $('#formbox').addClass('recover');
      //$('#ar_form').show();
    }
  });
}

function resetmodal() {
  $('#ab_content').html('');
  $('#ab_form').html('');
  $('#ab_content').hide();
  $('#ab_form').hide();
}


$('#formbox').submit(function (e) {
  e.preventDefault();
  var send = $(this).serialize();
  var type1 = '';
  if ($('#formbox').hasClass('del')) {
    type1 = 'delete'
  } else if ($('#formbox').hasClass('recover')) {
    type1 = 'recover'
  } else {
    type1 = ''
  }

  $.ajax({
    url: baseurl + "admin/filemanager/request/" + type1,
    type: 'post',
    data: { 'send': send, 'vldt': getvldt() },
    dataType: "json",

    beforeSend: function () {
      $('#ab_spinner').show();
      $('#modal_footer').hide();
      $('#ab_content').html('');
      $('#ab_form').html('');
      $('#ab_content').hide();
      $('#ab_form').hide();
    },
    success: function (data) {
      setvldt(data.token)
      $("#ab_content").html(data.load);
      $('#ab_spinner').hide();
      $('#modal_footer').show();
      $('#ab_content').show();
      $('#okID').hide();
      $('#formbox').removeClass('del');
      $('#formbox').removeClass('edit');
      $('#table_sampah').DataTable().ajax.reload();
      //$('#ab_form').show();
    }
  });
});

function getvldt() {
  return $("input[name='vldt']").val();
}

function setvldt(a) {
  $("input[name='vldt']").val(a);
}