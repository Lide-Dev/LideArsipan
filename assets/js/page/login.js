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

$("#cancelID").click(function () {
    $("#okID").delay(1000).show(500);
    $("#lp_spinner").delay(1000).hide(500);
    $("#lp_success").delay(1000).hide(500);
    $("#lp_form").delay(1000).show(500);
});

$("#lp_email").change(function (e) {
    e.preventDefault();
    console.log("change");
    var e = true;
    var a = $("#lp_email").val();

    if (!validateEmail(a)) {
        $("#lp_error").text("Format email salah!");
        e = false;
    }
    if (a == "") {
        $("#lp_error").text("Mohon di isi email akun anda agar kami bisa mencari akun anda");
        e =false
    }
    if(e){
        $("#lp_errorpass").hide();
    }
    else{
        $("#lp_errorpass").show();
    }
});

$("#okID").click(function () {
    console.log("TSET");
    var e = true;
    var a = $("#lp_email").val();
    a = escapeHtml(a);

    if (!validateEmail(a)) {
        $("#lp_error").text("Format email salah!");
        e = false;
    }
    if (a == "") {
        $("#lp_error").text("Mohon di isi email akun anda agar kami bisa mencari akun anda");
        e = false;
    }

    if (e) {
        $("#lp_errorpass").hide();
        console.log(a);
        $("#modal_footer").hide(500);
        $("#lp_form").hide(500);
        $("#lp_spinner").show(500);

        $.ajax({
            url: "http://localhost/LideArsipan/ajaxlogin/emailcek",
            data: { email: a },
            type: "POST",
            dataType: "text",
            success: function (data) {
                console.log(data);
                if (data == 1) {
                    $("#okID").delay(500).hide(500);
                    $("#modal_footer").delay(1000).show(500);
                    $("#lp_spinner").delay(1000).hide(500);
                    $("#lp_success").delay(1600).show(500);
                    $("#info_Icon").addClass("fa-check");
                    $("#info_Icon").addClass("text-success");
                    $("#info_Icon").removeClass("text-danger");
                    $("#info_Icon").removeClass("fa-exclamation");
                    $("#info_Status").text("Berhasil!");
                    $("#info_Desc").text("Silahkan cek email anda. Kami telah mengirim link untuk mengganti email anda.");
                }
                else {
                    $("#okID").delay(500).hide(500);
                    $("#modal_footer").delay(1000).show(500);
                    $("#info_Icon").removeClass("text-success");
                    $("#info_Icon").addClass("text-danger");
                    $("#info_Icon").removeClass("fa-check");
                    $("#info_Icon").addClass("fa-exclamation");
                    $("#lp_spinner").delay(1000).hide(500);
                    $("#lp_success").delay(1600).show(500);
                    $("#info_Status").text("Gagal!");
                    $("#info_Desc").text("Pastikan akun yang dicari benar-benar ada.");
                }
            }
        });
    }
    else{
        $("#lp_errorpass").show();
    }



});
