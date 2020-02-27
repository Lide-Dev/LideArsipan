
    $("#gp_form").validate({
        rules: {
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
        },
        messages: {
            kategori: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Setidaknya memilih satu klasifikasi surat.</small>",
            nosurat: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Mohon di isi nomor suratnya</small>",
            lokasiarsip: {
                required: "<small class='text-danger'><i class='fas fa-exclamation-triangle'></i> Mohon di isi lokasi arsipnya</small>",
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
