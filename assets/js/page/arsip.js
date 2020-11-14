if (typeof config !== 'undefined') {
  var baseurl = config.baseurl();
}
else {
  var baseurl = "https://arsipcondongcatur.com/"
}

var csrfN = '';
var csrfH = '';
$(document).ready(function () {

  var table = '';
  var tp_arsip = '';
  var tempsearch = ''; var tempsearch2 = '';
  var searchbox = '';
  var searchbox2 = '';
  csrfN = $('.inputhid').attr('name');
  csrfH = $('.inputhid').val();

  $.ajax({
    url: baseurl + "ajaxarsip/count",
    type: 'post',
    data: { [csrfN]: csrfH }, //Send Token
    dataType: "JSON",

    success: function (data) {
      if (data['type'] === "emp") {
        $('.inputhid').val(data.token); //Refresh Token
        csrfH = $('.inputhid').val();
        $('#tabel_arsip').html('');
        $('#div-table').hide();
      }
      else {
        $('.inputhid').val(data.token);
        csrfH = $('.inputhid').val();  //Refresh Token
        var columns = [''];
        if (data['type'] === "dp") {
          columns[0] = "id_kode";
          columns[1] = "nama";
          columns[2] = "perihal";
          columns[3] = "tgl_penerimaan";
          columns[4] = 'id_disposisi';
        }
        else {
          columns[0] = "id_kode";
          columns[1] = "nama";
          columns[2] = "keterangan";
          columns[3] = "tgl_penerimaan";
          if (data['type'] === 'sm')
            columns[4] = 'id_suratmasuk'
          else
            columns[4] = 'id_suratkeluar'
        }
        tp_arsip = columns[4];
        if (data['rows'] > 0) {
          $('#div-table').show();
          table = $('#tabel_arsip').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "order": [[0, 'asc']], // Default sortingnya berdasarkan kolom /field ke 0 (paling pertama)
            "sDom": "ltipr",
            "ajax": {
              "url": baseurl + "ajaxarsip/table", // URL file untuk proses select datanya
              "type": "POST",
              "data": function (d) {
                d[csrfN] = csrfH;  //Send Token
                return d
              }
            },
            "searchDelay": 1000,
            "deferRender": true,
            "aLengthMenu": [[5, 10, 30], [5, 10, 30]], // Combobox Limit
            "columns": [
              { "data": columns[0] }, // Tampilkan nis
              { "data": columns[1] },  // Tampilkan nama
              { "data": columns[2] },
              { "data": columns[3] },
              // Tampilkan telepon
              // Tampilkan alamat
              {
                "render": function (data, type, meta, full) {
                  role = full.settings.json.custom.role
                  typearsip = full.settings.json.custom.typearsip
                  // Tampilkan kolom aksi
                  var classs = "btn glyphicon glyphicon-play whiteText";
                  var content1 = "<i class='fas fa-edit' style='color: #05c46b'></i>";
                  var content2 = "<i class='fas fa-envelope-open-text' style='color: #00d8d6''></i>";
                  var content3 = "<i class='fas fa-trash-alt' style='color: #ff3f34'></i>";
                  var content4 = "<i class='fas  fa-paper-plane' style='color: orange'></i>";

                  var html = " <i class='" + classs + " open' data-toggle='tooltip' data-placement='top' title='Buka Surat' aria-hidden='true'>" + content2 + "</i> "
                  if ((role == 'admin' || (typearsip == 'sm' || typearsip == 'sk') && (role != 'user'))) {
                    html += "<i class='" + classs + " edit' data-toggle='tooltip' data-placement='top' title='Edit Surat' aria-hidden='true'>" + content1 + "</i>"
                  }
                  if ((role == 'admin' || (typearsip == 'sm' || typearsip == 'sk') && role == 'operator')) {
                    html += "<i class='" + classs + " delete' data-toggle='tooltip' data-placement='top' title='Hapus Surat' aria-hidden='true'>" + content3 + "</i>"
                  }
                  if ((role == 'admin' || (typearsip == 'sm' || typearsip == 'sk') && (role != 'user'))) {
                    html += "<i class='" + classs + " disposisi' data-toggle='tooltip' data-placement='top' title='Disposisikan Surat' aria-hidden='true'>" + content4 + "</i>"
                  }

                  return html
                },
                "orderable": false
              }
            ],
            "drawCallback": function (settings) {
              $('.inputhid').val(settings.json.custom.token); //Refresh Token
              if (settings.json.recordsTotal < 1) {
                $('#div-table').html('');
                $('#nonerow').show();
              }
              csrfH = $('.inputhid').val();
              // var response = settings.json;
              // console.log(response);
            }
          });

          $('#tabel_arsip tbody').on('click', '.open', function () {
            resetmodal();
            var data = table.row($(this).parents('tr')).data();
            $('#modalLabel').text('Membuka Arsip');
            $('#modalarsip').modal('show');
            $('#okID').hide();
            openpage(data[tp_arsip]);
          });

          $('#tabel_arsip tbody').on('click', '.delete', function () {
            resetmodal();
            var data = table.row($(this).parents('tr')).data();
            $('#modalLabel').text('Membuang Arsip');
            $('#modalarsip').modal('show');
            $('#okID').show();
            deletepage(data[tp_arsip]);
          });

          $('#tabel_arsip tbody').on('click', '.edit', function () {
            resetmodal();
            var data = table.row($(this).parents('tr')).data();
            $('#modalLabel').text('Mengubah Data Arsip');
            $('#modalarsip').modal('show');
            $('#okID').show();
            editpage(data[tp_arsip]);
          });

          $('#tabel_arsip tbody').on('click', '.disposisi', function () {
            resetmodal();
            var data = table.row($(this).parents('tr')).data();

            $('#modalLabel').text('Disposisi Surat');
            $('#modalarsip').modal('show');
            $('#okID').show();
            disposisipage(data[tp_arsip]);
          });

          var search = $.fn.dataTable.util.throttle(
            function (val) {
              table.search(val).draw();
            },
            1000
          );

          $('#ar_search').keyup(function () {
            searchbox2 = $('#ar_search').val();
            if (searchbox2.length > 2) {
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
            if (tempsearch != searchbox && searchbox.length >= 3) {
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

        }
      }
    }
  });


});

$(document.body).on('click', '.chevronbtn', function () {
  var id = $(this).attr('id');
  var selector = '';
  switch (id) {
    case 'id_showfile':
      selector = 'file'
      break;
    case 'id_showdetail':
      selector = 'detail'
      break;
    case 'id_showdisposisi':
      selector = 'disposisi'
      break;
    default:
      break;
  }
  if ($("#id_icon" + selector).hasClass("fa-chevron-right")) {
    $("#id_icon" + selector).addClass('fa-chevron-down')
    $("#id_icon" + selector).removeClass('fa-chevron-right')
    $("#id_table" + selector).show()
  }
  else {
    $("#id_icon" + selector).addClass('fa-chevron-right')
    $("#id_icon" + selector).removeClass('fa-chevron-down')
    $("#id_table" + selector).hide()
  }
})

$(document.body).on('click', '.select-process', function () {
  console.log('click')
  var id = $(this).attr('id')

  if (id == 'id_active') {
    $("#inputform").show();
    // $("#id_active").prop("checked",true);
    // $("#id_deactive").prop("checked",false);
  }
  else {
    $("#inputform").hide();
    // $("#id_active").prop("checked",true);
  }
})

$('#formarsip').submit(function (e) {
  e.preventDefault();
  var send = $(this).serialize();
  console.log(send);

  var type1 = '';
  var disposisi = false;
  if ($('#formarsip').hasClass('del')) {
    type1 = 'delete'
  }
  else if ($('#formarsip').hasClass('edit') || $('#formarsip').hasClass('disposisi')) {
    type1 = 'patch'
    disposisi = $('#formarsip').hasClass('disposisi')
  }
  else {
    type1 = ''
  }
  var senddata = { 'send': send, [csrfN]: csrfH };
  if (disposisi) senddata['disposisi'] = disposisi;

  $.ajax({
    url: baseurl + "arsip/request/" + type1,
    type: 'post',
    data: senddata, //Send Token
    dataType: "json",

    beforeSend: function () {
      $('#ar_spinner').show();
      $('#modal_footer').hide();
      $('#ar_content').html('');
      $('#ar_form').html('');
      $('#ar_content').hide();
      $('#ar_form').hide();
    },
    success: function (data) {
      $('.inputhid').val(data.token); //Refresh Token
      csrfH = $('.inputhid').val();
      $("#ar_content").html(data.html);
      $('#ar_spinner').hide();
      $('#modal_footer').show();
      $('#ar_content').show();
      $('#okID').hide();
      $('#formarsip').removeClass('del');
      $('#formarsip').removeClass('edit');
      $('#tabel_arsip').DataTable().ajax.reload();
      //$('#ar_form').show();
    },
    error: function(xhr, error){
      data =  xhr.responseJSON;
      $('.inputhid').val(data.token); //Refresh Token
      csrfH = $('.inputhid').val();
      $("#ar_content").html(data.html);
      $('#ar_spinner').hide();
      $('#modal_footer').show();
      $('#ar_content').show();
      $('#okID').hide();
      $('#formarsip').removeClass('del');
      $('#formarsip').removeClass('edit');
    }
  });
});

$('#cancelID, .close').click(function () {
  $('#ar_content').html('');
  $('#ar_form').html('');
  $('#formarsip').removeClass('del');
  $('#formarsip').removeClass('edit');
  $('#ar_spinner').show();
  $('#modal_footer').hide();
  $('#ar_content').hide();
  $('#ar_form').hide();
});

function openpage(data) {
  $.ajax({
    url: baseurl + "arsip/modal/get/open",
    data: { 'send': data },
    type: "get",
    dataType: "html",
    beforeSend: function () {
      $('#ar_content').html('');
      $('#ar_form').html('');
      $('#ar_spinner').show();
      $('#modal_footer').hide();
      $('#ar_content').hide();
      $('#ar_form').hide();
    },
    success: function (data) {
      $("#ar_content").html(data);
      $('#ar_spinner').hide();
      $('#modal_footer').show();
      $('#ar_content').show();
      //$('#ar_form').show();
    }
  });
}

function deletepage(data) {
  $.ajax({
    url: baseurl + "arsip/modal/get/delete",
    data: { 'send': data },
    type: "get",
    dataType: "html",
    beforeSend: function () {
      $('#ar_content').html('');
      $('#ar_form').html('');
      $('#ar_spinner').show();
      $('#modal_footer').hide();
      $('#ar_content').hide();
      $('#ar_form').hide();
    },
    success: function (data) {
      $("#ar_content").html(data);
      $('#ar_spinner').hide();
      $('#modal_footer').show();
      $('#ar_content').show();
      $('#formarsip').addClass('del');
      //$('#ar_form').show();
    }
  });
}

function editpage(data) {
  $.ajax({
    url: baseurl + "arsip/modal/get/edit",
    data: { 'send': data },
    type: "get",
    dataType: "html",
    beforeSend: function () {
      $('#ar_spinner').show();
      $('#modal_footer').hide();
      $('#ar_content').hide();
      $('#ar_form').hide();
    },
    success: function (data) {
      $("#ar_form").html(data);
      $('#ar_spinner').hide();
      $('#modal_footer').show();
      $('#ar_form').show();
      $('#formarsip').addClass('edit');
      //$('#ar_form').show();
    }
  });
}

function disposisipage(data) {
  $.ajax({
    url: baseurl + "arsip/modal/get/disposisi",
    data: { 'send': data },
    type: "get",
    dataType: "html",
    beforeSend: function () {
      $('#ar_spinner').show();
      $('#modal_footer').hide();
      $('#ar_content').hide();
      $('#ar_form').hide();
    },
    success: function (data) {
      $("#ar_form").html(data);
      $('#ar_spinner').hide();
      $('#modal_footer').show();
      $('#ar_form').show();
      $('#formarsip').addClass('disposisi');
      //$('#ar_form').show();
    }
  });
}

function resetmodal() {
  $('#ar_content').html('');
  $('#ar_form').html('');
  $('#ar_content').hide();
  $('#ar_form').hide();
}
