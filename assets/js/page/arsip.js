var baseurl = 'http://localhost/LideArsipan/';
$(document).ready(function () {
  var table = '';
  var tp_arsip = '';
  $.ajax({
    url: baseurl + "ajaxarsip/count",
    type: 'post',
    dataType: "JSON",
    success: function (data) {
      if (data['type'] === "emp") {
        console.log('1');
        $('#tabel_arsip').html('');
        $('#div-table').hide();
      }
      else {
        var columns = [''];
        if (data['type'] === "dp") {
          columns[0] = "id_kode";
          columns[1] = "klasifikasi";
          columns[2] = "perihal";
          columns[3] = "tgl_penerimaan";
          columns[4] = 'id_disposisi';
        }
        else {
          columns[0] = "id_kode";
          columns[1] = "klasifikasi";
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
                "data": columns[4],
                "render": function (data, type, row) {
                  // Tampilkan kolom aksi
                  var class2 = "btn open";
                  var class1 = "class='btn edit'";
                  var class3 = "class='btn delete'";
                  var html = "<a " + class1 + " href=''><i class='glyphicon glyphicon-play whiteText' data-toggle='tooltip' data-placement='top' title='Edit Surat' aria-hidden='true'><i class='fas fa-edit' style='color: #05c46b'></i></i></a> "
                  html += " <i class='btn open glyphicon glyphicon-play whiteText' data-toggle='tooltip' data-placement='top' title='Buka Surat' aria-hidden='true'><i class='fas fa-envelope-open-text' style='color: #00d8d6''></i></i> "
                  html += "<a " + class3 + " href=''><i class='glyphicon glyphicon-play whiteText' data-toggle='tooltip' data-placement='top' title='Hapus Surat' aria-hidden='true'><i class='fas fa-trash-alt' style='color: #ff3f34'></i></i></a>"

                  return html
                },
                "orderable": false
              }
            ]
          });

          $('#tabel_arsip tbody').on('click', '.open', function () {
            var data = table.row($(this).parents('tr')).data();
            $('#modalarsip').modal('show');
            openpage(data[tp_arsip]);
          });
        }
      }
    }
  });


});

function openpage(data) {
  $.ajax({
    url: "http://localhost/LideArsipan/arsip/modal/get/open",
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
      $("#ar_content").html(data);
      $('#ar_spinner').hide();
      $('#modal_footer').show();
      $('#ar_content').show();
      //$('#ar_form').show();
    }
  });
}
