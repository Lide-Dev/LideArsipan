
$(document).ready(function () {
  $.ajax({
    url: "http://localhost/LideArsipan/ajaxarsip/count",
    type: 'post',
    dataType: "text",
    success: function (data) {
      if (data > 0) {
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
            { "data": "id_kode" }, // Tampilkan nis
            { "data": "keterangan" },  // Tampilkan nama
            { "data": "tgl_penerimaan" },
            { "data": "klasifikasi" }
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


