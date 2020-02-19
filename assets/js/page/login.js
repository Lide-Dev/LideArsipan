
$("#formID").validate({
    rules: {
        inputemail: {
            required: true,
            email: true
        }
    },
    message: {
        inputemail: {
            required: "Mohon di isi untuk mencari akun anda!",
            email: "Format email salah!"
        }
    },
    submitHandler: function (form) {
    form.submit();
    }
});

$("#okID").click(function () {
    console.log("TSET");

    var form = $("#lp_email").text();

    $("#modal_footer").hide(500);
    $("#lp_form").hide(500);
    $("#lp_spinner").show(500);

    $.ajax({
        url: "http://localhost/LideArsipan/ajaxlogin/emailcek",
        data: this.form = form,
        type: "POST",
        dataType: "text",
        success: function (data) {
            if (data == true){
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



});
