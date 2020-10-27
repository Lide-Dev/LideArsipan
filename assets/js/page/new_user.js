var entityMap = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#39;',
    '/': '&#x2F;',
    '`': '&#x60;',
    '=': '&#x3D;'
};

function escapeHtml(string) {
    return String(string).replace(/[&<>"'`=\/]/g, function (s) {
        return entityMap[s];
    });
}
function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

$('form').validate({
    rules: {
        nama: 'required',
        pass: {'required':true,minlength: 8},
        passc: {'required':true,minlength: 8},
        username: 'required',
    },
    messages: {
        nama: "<small class='text-danger text-truncate'><i class='fas fa-exclamation-triangle'></i> Mohon di isi nama lengkap anda disini.</small>",
        username: "<small class='text-danger text-truncate'><i class='fas fa-exclamation-triangle'></i> Mohon di isi username anda disini.</small>",
        pass: {
            "required":"<small class='text-danger text-truncate'><i class='fas fa-exclamation-triangle'></i> Mohon di isi password anda.</small>",
            "minlength":"<small class='text-danger text-truncate'><i class='fas fa-exclamation-triangle'></i> Password harus minimal 8 karakter</small>"
        },
        passc: {
            "required":"<small class='text-danger text-truncate'><i class='fas fa-exclamation-triangle'></i> Mohon di isi konfirmasi password anda.</small>",
            "minlength":"<small class='text-danger text-truncate'><i class='fas fa-exclamation-triangle'></i> Password harus minimal 8 karakter</small>"
        },
    },
    submitHandler: function (form) {
        form.submit();
    }
});

