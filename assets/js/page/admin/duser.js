function ajaxedit(dataid) {
  $.ajax({
    url: "http://localhost/LideArsipan/ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "edit", iduser: dataid.id_user },
    success: function () {
      $.ajax({
        url: "http://localhost/LideArsipan/ajaxadmin/get/modal",
        dataType: "html",
        success: function (data) {
          $("#ad_form").html(data);
          $.ajax({
            url: "http://localhost/LideArsipan/ajaxadmin/get/edituser",
            type: "post",
            dataType: "json",
            data: { iduser: dataid.id_user },
            success: function (data) {
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
    url: "http://localhost/LideArsipan/ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "new" },
    dataType: 'text',
    success: function (data) {

      $.ajax({
        url: "http://localhost/LideArsipan/ajaxadmin/get/modal",
        dataType: "html",
        success: function (data) {
          $("#ad_form").html(data);
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
    url: "http://localhost/LideArsipan/ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "pss" },
    dataType: 'text',
    success: function (data) {
      $.ajax({
        url: "http://localhost/LideArsipan/ajaxadmin/get/modal",
        dataType: "html",
        success: function (data) {
          console.log(data);
          $("#ad_form").html(data);
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
    url: "http://localhost/LideArsipan/ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "ban", iduser: dataid.id_user },
    dataType: 'text',
    success: function (data) {
      $.ajax({
        url: "http://localhost/LideArsipan/ajaxadmin/get/modal",
        dataType: "html",
        success: function (data) {
          $("#ad_form").html(data);
          $('#ad_spinner').hide();
          $('#ad_form').show();
          $('#modal_footer').show();
        }
      });
    }
  });
}

function ajaxunban(dataid) {
  $.ajax({
    url: "http://localhost/LideArsipan/ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "unban", iduser: dataid.id_user },
    dataType: 'text',
    success: function (data) {
      $.ajax({
        url: "http://localhost/LideArsipan/ajaxadmin/get/modal",
        dataType: "html",
        success: function (data) {
          $("#ad_form").html(data);
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
    $('#ad_form').hide();
    $('#modal_footer').hide();
    $('#ad_spinner').show();
    var pst = $(this).serialize();
    $.ajax({
      url: "http://localhost/LideArsipan/admin/admdatauser/form/request",
      type: 'post',
      data: pst,
      dataType: 'json',
    }).done(function (data) {
      console.log(data);
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
  $.ajax({

    url: "http://localhost/LideArsipan/ajaxadmin/user/count",
    type: 'post',
    dataType: "json",
    success: function (data) {
      if (data.tablerow > 0) {
         table = $('#tabel_user').DataTable({
            "processing": true,
            "serverSide": true,
            "ordering": true,
            "order": [[0, 'asc']], // Default sortingnya berdasarkan kolom /field ke 0 (paling pertama)
            "ajax": {
              "url": "http://localhost/LideArsipan/ajaxadmin/user/table/normal", // URL file untuk proses select datanya
              "type": "POST"
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
              // Tampilkan telepon
              // Tampilkan alamat
              /*{{
                "render": function (data, type, row) {
                  // Tampilkan kolom aksi
                  var html = "<a href=''>EDIT</a> | "
                  html += "<a href=''>DELETE</a>"
                  return html
                }}*/
            ],
            /*"drawCallback": function (settings) {
              // Here the response
              var response = settings.json;
              console.log(response);
            }*/
          });


      }

      $("#ad_banmode").click(function () {
        $.ajax({
          url: 'http://localhost/LideArsipan/ajaxadmin/user/mode',
          dataType: 'JSON',
          success: function (data){
            if (data.request=='normal'){
              $('table thead tr th:nth-child(4)').html('Tanggal Selesai');
              $.ajax({
                url: 'http://localhost/LideArsipan/ajaxadmin/user/mode',
                data: {mode: 'ban'},
                type: 'post'
              });
              $('#ad_banmode').removeClass('btn btn-outline-darkpriwinkle');
              $('#ad_banmode').addClass('btn btn-darkpriwinkle');
              $('#tabel_user').DataTable().destroy();
              table = $('#tabel_user').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [[0, 'asc']], // Default sortingnya berdasarkan kolom /field ke 0 (paling pertama)
                "ajax": {
                  "url": "http://localhost/LideArsipan/ajaxadmin/user/table/ban", // URL file untuk proses select datanya
                  "type": "POST"
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
                      var html = '<b>'+row.finish_date+' </b> ';
                      html += "| <button class='btn btn-danger unban' >UNBAN</button>";
                      return html;
                    }
                  }
                ]
            });

            }
            else{
              $('table thead tr th:nth-child(4)').html('Aksi');

              $.ajax({
                url: 'http://localhost/LideArsipan/ajaxadmin/user/mode',
                data: {mode: 'normal'},
                type: 'post'
              });
              $('#ad_banmode').removeClass('btn btn-darkpriwinkle');
              $('#ad_banmode').addClass('btn btn-outline-darkpriwinkle');
              $('#tabel_user').DataTable().destroy();
              table=$('#tabel_user').DataTable({
                "processing": true,
                "serverSide": true,
                "ordering": true,
                "order": [[0, 'asc']], // Default sortingnya berdasarkan kolom /field ke 0 (paling pertama)
                "ajax": {
                  "url": "http://localhost/LideArsipan/ajaxadmin/user/table/normal", // URL file untuk proses select datanya
                  "type": "POST"
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

