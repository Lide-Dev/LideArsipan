if (typeof config !== 'undefined') {
  var baseurl = config.baseurl();
}
else {
  var baseurl = "https://arsipcondongcatur.com/"
}

//var vldtH = '';
var enforceModalFocusFn = $.fn.modal.Constructor.prototype._enforceFocus;

$.fn.modal.Constructor.prototype._enforceFocus = function() {};

$("#modaladm").on('hidden', function() {
    $.fn.modal.Constructor.prototype.enforceFocus = enforceModalFocusFn;
});

// $("#modaladm").modal({ backdrop : false });

function ajaxedit(dataid) {
  $.ajax({
    url: baseurl+"ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "edit", iduser: dataid.id_user , vldt:getvldt()},
    dataType: "JSON",
    success: function (data) {
      setvldt(data.token);
      $.ajax({
        url: baseurl+"ajaxadmin/get/modal",
        type: "get",
        dataType: "json",
        success: function (data) {
          $('#ad_failed').hide();
          $('#ad_success').hide();
          $("#ad_form").html(data.load);
          $('#ad_spinner').hide();
          $('#ad_form').show();
          $('#modal_footer').show();
          $.ajax({
            url: baseurl+"ajaxadmin/get/edituser",
            type: "get",
            dataType: "json",
            data: { iduser: dataid.id_user },
            success: function (data) {
              var url =$(".link-edit").attr("href");
              $(".link-edit").attr("href", url+data.id_user);
              if (data.email === 'undefined') {
                $('#ad_email').prop('disabled', true);
                $('#ad_cekemail').prop('checked', false);
                $('lp_emailavailable').html('Akun ini belum memasukkan email. (Optional untuk Login dan ganti password manual)');
              }
              else {
                $('#ad_email').prop('disabled', false);
                $('#ad_cekemail').prop('checked', true);
                $("#ad_email").val(data.email);
                $('lp_emailavailable').html('Akun ini telah memasukkan email. (Optional untuk Login dan ganti password manual)')
              }
              $("#ad_username").val(data.username);
              $('#ad_spinner').hide();
              $('#ad_form').show();
              $('#modal_footer').show();
            }
          });
        }
      });
    }
  });
}
function ajaxadd() {
  $.ajax({
    url: baseurl+"ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "new" ,vldt:getvldt()},
    dataType: "JSON",
    success: function (data) {
      setvldt(data.token);
      $.ajax({
        url: baseurl+"ajaxadmin/get/modal",
        type: "get",
        dataType: "json",
        success: function (data) {
          $('#ad_failed').hide();
          $('#ad_success').hide();
          $("#ad_form").html(data.load);
          $('#ad_spinner').hide();
          $('#ad_form').show();
          $('#modal_footer').show();
        }
      });
    }
  });
}
function ajaxpassword() {
  $('#modal_footer').hide();
  $.ajax({
    url: baseurl+"ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "pss" ,vldt:getvldt()},
    dataType: "JSON",
    success: function (data) {
      setvldt(data.token);
      $.ajax({
        url: baseurl+"ajaxadmin/get/modal",
        type: "get",
        dataType: "json",
        success: function (data) {
          $('#ad_failed').hide();
          $('#ad_success').hide();
          $("#ad_form").html(data.load);
          $('#ad_spinner').hide();
          $('#ad_form').show();
          $('#modal_footer').show();
        }
      });
    }
  });
}
function ajaxban(dataid) {
  $.ajax({
    url: baseurl+"ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "ban", iduser: dataid.id_user ,vldt:getvldt()},
    dataType: "JSON",
    success: function (data) {
      setvldt(data.token);
      $.ajax({
        url: baseurl+"ajaxadmin/get/modal",
        type: "get",
        dataType: "json",
        success: function (data) {
          $('#ad_failed').hide();
          $('#ad_success').hide();
          $("#ad_form").html(data.load);
          $('#ad_spinner').hide();
          $('#ad_form').show();
          if (data.is_ban){
            $('#modal_footer').hide();
          }
          else{
            $('#modal_footer').show();
          }

        }
      });
    }
  });
}

function ajaxunban(dataid) {
  $.ajax({
    url: baseurl+"ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "unban", iduser: dataid.id_user ,vldt:getvldt()},
    dataType: "JSON",
    success: function (data) {
      setvldt(data.token);
      $.ajax({
        url: baseurl+"ajaxadmin/get/modal",
        type: "get",
        dataType: "json",
        success: function (data) {
          $('#ad_failed').hide();
          $('#ad_success').hide();
          $("#ad_form").html(data.load);
          $('#ad_spinner').hide();
          $('#ad_form').show();
          $('#modal_footer').show();
        }
      });
    }
  });
}


$(document).ready(function () {
    $("#formadm").submit(function (e) {
      e.preventDefault();
      $('#ad_failed').hide();
      $('#ad_success').hide();
      $('#ad_form').hide();
      $('#modal_footer').hide();
      $('#ad_spinner').show();
      var pst = $(this).serialize();
      $.ajax({
        url: baseurl+"admin/admdatauser/form/request",
        type: 'post',
        data: {pst, vldt:getvldt()},
        dataType: 'json',
      }).done(function (data) {
        setvldt(data.token)
        if (data.valid) {
          $('#ad_spinner').hide();
          $('#ad_success').show();
          $("#info_Desc").html(data['message']);
          $('#tabel_user').DataTable().ajax.reload();
        }
        else {
          //var a = data.return;
          //returnDataForm(a,data.request);
          $('#ad_spinner').hide();
          $('#ad_failed').show();
          $("#info_Descf").html(data['message']);
          $("#modal_footer").show();
          $('ad_email').text();
        }
      });

    });


  var table;
  var tempsearch = ''; var tempsearch2 = '';
  var searchbox = '';
  var searchbox2 = '';

  $.ajax({

    url: baseurl+"ajaxadmin/user/count",
    type: 'get',
    dataType: "json",
    success: function (data) {
      if (data.tablerow > 0) {
        table = $('#tabel_user').DataTable({
          "processing": true,
          "serverSide": true,
          "ordering": true,
          "order": [[0, 'asc']], // Default sortingnya berdasarkan kolom /field ke 0 (paling pertama)
          "sDom": "ltipr",
          "ajax": {
            "url": baseurl+"ajaxadmin/user/table/normal", // URL file untuk proses select datanya
            "type": "get"
          },
          "deferRender": true,
          "aLengthMenu": [[5, 10, 30], [5, 10, 30]], // Combobox Limit
          "columns": [
            { "data": "id_user" }, // Tampilkan nis
            { "data": "email" },  // Tampilkan nama
            { "data": "username" },
            {
              "render": function (data, type, row) {
                // Tampilkan kolom aksi
                var html = "<button class='btn btn-primary edit' >EDIT</button> | ";
                html += "<button class='btn btn-danger delete' >BAN</button>";
                return html;
              }
            }
          ],

        });


      }

      $("#ad_banmode").click(function () {
        $.ajax({
          url: baseurl+'ajaxadmin/user/mode',
          dataType: 'JSON',
          success: function (data) {
            if (data.request == 'normal') {
              $('table thead tr th:nth-child(4)').html('Tanggal Selesai');
              $.ajax({
                url: baseurl+'ajaxadmin/user/mode',
                data: { mode: 'ban' },
                type: 'get'
              });
              $('#ad_banmode').removeClass('btn btn-outline-darkpriwinkle');
              $('#ad_banmode').addClass('btn btn-darkpriwinkle');
              $('#tabel_user').DataTable().destroy();
              table = $('#tabel_user').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [[0, 'asc']], // Default sortingnya berdasarkan kolom /field ke 0 (paling pertama)
                "sDom": "ltipr",
                "ajax": {
                  "url": baseurl+"ajaxadmin/user/table/ban", // URL file untuk proses select datanya
                  "type": "get"
                },
                "deferRender": true,
                "aLengthMenu": [[20, 10, 50], [5, 10, 50]], // Combobox Limit
                "columns": [
                  { "data": "id_user" }, // Tampilkan nis
                  { "data": "email" },  // Tampilkan nama
                  { "data": "username" },
                  {
                    "render": function (data, type, row) {
                      // Tampilkan kolom aksi
                      var html = '<b>' + row.finish_date + ' </b> ';
                      html += "| <button class='btn btn-danger unban' >UNBAN</button>";
                      return html;
                    }
                  }
                ]
              });

            }
            else {
              $('table thead tr th:nth-child(4)').html('Aksi');

              $.ajax({
                url: baseurl+'ajaxadmin/user/mode',
                data: { mode: 'normal' },
                type: 'get'
              });
              $('#ad_banmode').removeClass('btn btn-darkpriwinkle');
              $('#ad_banmode').addClass('btn btn-outline-darkpriwinkle');
              $('#tabel_user').DataTable().destroy();
              table = $('#tabel_user').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [[0, 'asc']], // Default sortingnya berdasarkan kolom /field ke 0 (paling pertama)
                "sDom": "ltipr",
                "ajax": {
                  "url": baseurl+"ajaxadmin/user/table/normal", // URL file untuk proses select datanya
                  "type": "get"
                },
                "deferRender": true,
                "aLengthMenu": [[20, 10, 50], [5, 10, 50]], // Combobox Limit
                "columns": [
                  { "data": "id_user" }, // Tampilkan nis
                  { "data": "email" },  // Tampilkan nama
                  { "data": "username" },
                  {
                    "render": function (data, type, row) {
                      // Tampilkan kolom aksi
                      var html = "<button class='btn btn-primary edit' >EDIT</button> | ";
                      html += "<button class='btn btn-danger delete' >BAN</button>";
                      return html;
                    }
                  }
                ],
              });
            }
          }
        });
      });

      $('#tabel_user tbody').on('click', '.edit', function () {
        $('#modalLabel').html('Edit User');
        var data = table.row($(this).parents('tr')).data();
        $('#modaladm').modal('show');
        ajaxedit(data);
        //alert( data.id_user +"'s email: "+ data.email );
      });

      $('#tabel_user tbody').on('click', '.delete', function () {

        $('#modalLabel').html('Ban User');
        var data = table.row($(this).closest('tr')).data();

        //var data = table.row($(this).parents('tr')).data();

        $('#modaladm').modal('show');
        ajaxban(data)
      });

      $('#tabel_user tbody').on('click', '#ad_passwordlink', function () {
        $('#modalLabel').html('Ubah Password');
        ajaxpassword();
        //alert( data.id_user +"'s email: "+ data.email );
      });

      $('#tabel_user tbody').on('click', '.unban', function () {
        $('#modalLabel').html('Unban User');
        var data = table.row($(this).closest('tr')).data();
        $('#modaladm').modal('show');
        ajaxunban(data);
        //alert( data.id_user +"'s email: "+ data.email );
      });

      var search = $.fn.dataTable.util.throttle(
        function (val) {
          table.search(val).draw();
        },
        1000
      );

      $('#ad_search').keyup(function () {
        searchbox2 = $('#ad_search').val();
        if (searchbox2.length > 1) {
          $('#ad_btnsearch').removeClass('disabled');
          $('#ad_btnsearch').addClass('btn-outline-freespeechblue');
        }
        else {
          if (tempsearch2 != searchbox && searchbox2.length == 0) {
            search(searchbox2);
            tempsearch2 = searchbox;
          }
          $('#ad_btnsearch').addClass('disabled ');
          $('#ad_btnsearch').removeClass('btn-outline-freespeechblue');
        }
      });

      $('#ad_btnsearch').click(function () {
        searchbox = $('#ad_search').val();
        if (tempsearch != searchbox && searchbox.length >= 2) {
          search(searchbox);
          tempsearch = searchbox;
        }
      });

      $('#ad_search').keypress(function (e) {
        var key = e.which;
        if (key == 13) {
          $('#ad_btnsearch').click();
        }
      });

    }
  });
});


$(document).ajaxComplete(function () {
  $("#ad_tgllahir").datepicker({
    changeMonth: true,
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'dd/mm/yy',
    maxDate: 0
  })

  $("#info_Buttonf").click(function () {
    $('#ad_failed').hide();
    $('#ad_form').show();
  });

  $('#ad_cekemail').click(function () {
    if ($(this).prop("checked") == true) {
      $('#ad_email').prop('disabled', false);
    }
    else if ($(this).prop("checked") == false) {
      $('#ad_email').prop('disabled', true);
    }
  });
});


$("#ad_add").click(function () {
  $('#modaladm').modal('show');
  $('#modalLabel').html('Tambah User');
  ajaxadd();
});

$('.close, #cancelID').click(function () {
  $('#ad_failed').hide();
  $('#ad_success').hide();
  $('#ad_spinner').delay(2000).show();
  $('#ad_form').delay(2000).hide();
  $('#modal_footer').hide();

});

function getvldt() {
  return $("input[name='vldt']").val();
}

function setvldt(a) {
  $("input[name='vldt']").val(a);
}

