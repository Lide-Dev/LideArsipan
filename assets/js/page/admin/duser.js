function ajaxedit(dataid) {
  $.ajax({
    url: "http://localhost/LideArsipan/ajaxadmin/set/clickbutton",
    type: "post",
    data: { request: "edit" },
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
              $("#ad_email").val(data.email);
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


$(document).ready(function () {
  $("#formadm").submit(function(e){
    e.preventDefault();
    $('#ad_form').hide();
    $('#modal_footer').hide();
    $('#ad_spinner').show();
    $.ajax({
      url: "http://localhost/LideArsipan/admin/admdatauser/put/user",
      type: 'post',
      data: $(this).serialize(),
      success: function(data){
        if (data.valid){
          
        }
        else{

        }
      }
    });
  })

  $.ajax({
    url: "http://localhost/LideArsipan/ajaxadmin/user/count",
    type: 'post',
    dataType: "text",
    success: function (data) {
      if (data > 0) {
        var table = $('#tabel_user').DataTable({
          "processing": true,
          "serverSide": true,
          "ordering": true,
          "order": [[0, 'asc']], // Default sortingnya berdasarkan kolom /field ke 0 (paling pertama)
          "ajax": {
            "url": "http://localhost/LideArsipan/ajaxadmin/user/table", // URL file untuk proses select datanya
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
                var html = "<button class='btn btn-primary edit' >EDIT</button> | "
                html += "<button class='btn btn-danger delete' >DELETE</button>"
                return html
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
          "drawCallback": function (settings) {
            // Here the response
            var response = settings.json;
            console.log(response);
          }
        });

        $('#tabel_user tbody').on('click', '.edit', function () {
          $('#modalLabel').html('Edit User');
          var data = table.row($(this).parents('tr')).data();
          $('#modaladm').modal('show');
          ajaxedit(data);
          //alert( data.id_user +"'s email: "+ data.email );
        });

        $('#tabel_user tbody').on('click', '#ad_passwordlink', function () {
          $('#modalLabel').html('Ubah Password');
          ajaxpassword();

          //alert( data.id_user +"'s email: "+ data.email );
        });
      }
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
 });

$("#ad_add").click(function () {
  $('#modaladm').modal('show');
  $('#modalLabel').html('Tambah User');
  ajaxadd();
});

$('.close, #cancelID').click(function () {

  $('#ad_spinner').delay(2000).show();
  $('#ad_form').delay(2000).hide();
  $('#modal_footer').hide();

});

