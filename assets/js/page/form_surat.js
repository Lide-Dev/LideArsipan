//var _0x2718=['JSON','slice','term','Kode\x20yang\x20dipilih:\x20','split','#div_form_kategori','val','Tentang:\x20','log','html','get','#kode','delay','length','ajax','label','#tentang','autocomplete','hide','#form_kategori'];(function(_0x22b062,_0x42f677){var _0x207340=function(_0x77875b){while(--_0x77875b){_0x22b062['push'](_0x22b062['shift']());}};_0x207340(++_0x42f677);}(_0x2718,0x16b));var _0x26d9=function(_0x22b062,_0x42f677){_0x22b062=_0x22b062-0x0;var _0x207340=_0x2718[_0x22b062];return _0x207340;};$(_0x26d9('0x10'))[_0x26d9('0xe')]({'source':function(_0x2c5d8d,_0xc32288){$[_0x26d9('0xb')]({'url':'http://localhost/LideArsipan/index.php/form_surat/get_autocomplete/kategori','type':_0x26d9('0x7'),'dataType':_0x26d9('0x11'),'data':{'search':_0x2c5d8d[_0x26d9('0x13')]},'success':function(_0x2242eb){_0xc32288(_0x2242eb[_0x26d9('0x12')](0x0,0xa));console[_0x26d9('0x5')](_0x2242eb);}});},'minLength':0x2,'select':function(_0x22ee99,_0x3c2550){var _0x15e9b1=_0x3c2550['item'][_0x26d9('0xc')];var _0x480c8a=_0x15e9b1[_0x26d9('0x1')]('\x20');var _0x508670=_0x480c8a[0x0][_0x26d9('0x1')]('.');var _0x1466da='';for(var _0x4cd3c7=0x0;_0x4cd3c7<_0x480c8a[_0x26d9('0xa')];_0x4cd3c7++){if(_0x4cd3c7==0x0){console[_0x26d9('0x5')]('k');continue;}_0x1466da+=_0x480c8a[_0x4cd3c7]+'\x20';console[_0x26d9('0x5')](_0x480c8a[_0x4cd3c7]);}var _0x1237da=_0x508670['join']('/');$(_0x26d9('0x10'))[_0x26d9('0x3')]();$(_0x26d9('0x8'))[_0x26d9('0x6')](_0x26d9('0x0')+_0x1237da);$(_0x26d9('0xd'))[_0x26d9('0x6')](_0x26d9('0x4')+_0x1466da);$(_0x26d9('0x2'))[_0x26d9('0xf')](0x1f4);$('#div_form_kode')[_0x26d9('0x9')](0x258)['show'](0x1f4);kodeglobal=_0x1237da;tentangglobal=_0x1466da;}});
$("#form_kategori").autocomplete({
  source: function (request, response) {
    // Fetch data
    $.ajax({
      url: "http://localhost/LideArsipan/ksurat/kategori",
      type: 'get',
      dataType: "JSON",
      data: {
        search: request.term
      },
      success: function (data) {
        response(data.slice(0, 10));
      }
    });
  }, // Kode php untuk prosesing data.

  select: function (event, ui) {
    $("#btn_form_pilih").prop("disabled", false);
    $("#btn_form_ulang").prop("disabled", false);
    var valid = "";
    var str = ui.item.label;
    var tentang = str.split(" ");
    var kode = tentang[0].split(".");
    var tentangstr = "";
    for (var i = 0; i < tentang.length; i++) {
      if (i == 0) {
        continue;
      }
      tentangstr += tentang[i] + " ";
      console.log(tentang[i]);
    }
    var kodestr = kode.join("/");
    $.ajax({
      url: "http://localhost/LideArsipan/ksurat/kode",
      type: 'post',
      data: {
        kodevar: kode,
      }
    });
    $("#form_kategori").val();
    $("#kode").html("Kode yang dipilih: " + kodestr);
    $("#tentang").html(tentangstr);
    $("#div_form_kategori").hide(500);
    $.ajax({
      url: "http://localhost/LideArsipan/ksurat/cekkode/kode",
      type: 'post',
      data: {
        kodevar: kode,
      },
      dataType: "text",
      success: function (data) {
        console.log(data);
        valid = data;
        if (valid != 0) {
          $("#div_form_kode").delay(550).show(500);
          $.ajax({
            url: "http://localhost/LideArsipan/ksurat/kodeutama",
            type: 'post',
            dataType: "",
            success: function (data) {
              console.log(data);
              $("#form_kode").html(data);
            }
          });
        }
        else
          $("#div_form_done").delay(550).show(500);
      }
    });
  }
});


$("#form_kode").on('change', function() {
  var kode = $("#form_kode option:selected").val();
  console.log(kode);
  $.ajax({
    url: "http://localhost/LideArsipan/ksurat/kode",
    type: 'post',
    data: {
      kodevar: kode,
    },
    success:function(){
      $.ajax({
        url: "http://localhost/LideArsipan/ksurat/desckode",
        type: 'post',
        dataType: 'text',
        success:function(data){
          console.log(data);
          $("#tentang").html("Deskripsi Kode: " + data);
        }
      });
    }
  });
    $("#kode").html("Kode yang dipilih: " + kode);
    $.ajax({
      url: "http://localhost/LideArsipan/ksurat/cekkode/subkode1",
      type: 'post',
      data: {
        kodevar: kode,
      },
      dataType: "text",
      success: function (data) {
        valid = data;
        if (valid != 0) {
          $("#div_form_kode").delay(550).show(500);
          $.ajax({
            url: "http://localhost/LideArsipan/ksurat/subkode1",
            type: 'post',
            dataType: "html",
            success: function (data) {
              $("#div_form_subkode1").show(500);
              console.log(data);
              $("#form_subkode1").html(data);
            }
          });
        }
        else
          $("#div_form_subkode1").hide(500);
          $("#div_form_subkode2").hide(500);
      }
    });
});



$("#form_subkode1").on('change', function() {
  var kode = $("#form_subkode1 option:selected").val();
    $.ajax({
      url: "http://localhost/LideArsipan/ksurat/kode",
      type: 'post',
      data: {
        kodevar: kode,
      },
      success:function(){
        $.ajax({
          url: "http://localhost/LideArsipan/ksurat/desckode",
          type: 'post',
          dataType: 'text',
          success:function(data){
            console.log(data);
            $("#tentang").html("Deskripsi Kode: " + data);
          }
        });
      }
    });

    $("#kode").html("Kode yang dipilih: " + kode);
    $.ajax({
      url: "http://localhost/LideArsipan/ksurat/cekkode/subkode2",
      type: 'post',
      data: {
        kodevar: kode,
      },
      dataType: "text",
      success: function (data) {
        console.log("Sebanyak:"+data);
        valid = data;
        if (valid != 0) {
          $("#div_form_kode").delay(550).show(500);
          $.ajax({
            url: "http://localhost/LideArsipan/ksurat/subkode2",
            type: 'post',
            dataType: "html",
            success: function (data) {
              $("#div_form_subkode2").show(500);
              console.log(data);
              $("#form_subkode2").html(data);
            }
          });
        }
        else
          $("#div_form_subkode2").hide(500);
      }
    });

});

$("#form_subkode2").on('change', function() {
  var kode = $("#form_subkode2 option:selected").val();
  $.ajax({
    url: "http://localhost/LideArsipan/ksurat/kode",
    type: 'post',
    data: {
      kodevar: kode,
    },
    success:function(){
      $.ajax({
        url: "http://localhost/LideArsipan/ksurat/desckode",
        type: 'post',
        dataType: 'text',
        success:function(data){
          console.log(data);
          $("#tentang").html("Deskripsi Kode: " + data);
        }
      });
    }
  });
    $("#kode").html("Kode yang dipilih: " + kode);
});

$("#btn_form_ulang").click(function(){
  $("#div_container_donekode").hide(1000);
  $("#div_container_kode").delay(1000).show(500);
  $.ajax({
    url: "http://localhost/LideArsipan/ksurat/kode",
    type: 'post',
    data: {
      kodevar: "000/0/0/0",
    }
  });
  $("#kode").html("Kode yang dipilih: 000/0/0/0")
  $("#tentang").html("Deskripsi Kode: Belum dipilih")
  $("#div_form_kode").hide(500);
  $("#div_form_subkode1").hide(500);
  $("#div_form_subkode2").hide(500);
  $("#div_form_done").hide(500);
  $("#form_kode").html("");
  $("#form_subkode1").html("");
  $("#form_subkode2").html("");
  $("#form_kategori").val("");
  $("#div_form_kategori").delay(550).show(500);
  $("#btn_form_ulang").prop('disabled',true);
  $("#btn_form_pilih").prop('disabled',true);
});

$("#btn_form_pilih").click(function(){
  $("#div_container_kode").hide(500);
  $("#div_container_donekode").delay(550).show(500);
  $.ajax({
    url: "http://localhost/LideArsipan/ksurat/desckode",
    type: 'post',
    dataType:'text',
    success:function(data){
      $('#tentang_pilih').html(data);
    }
  });
  $.ajax({
    url: "http://localhost/LideArsipan/ksurat/getkode",
    type: 'post',
    dataType:'text',
    success:function(data){
      $("#kode_pilih").html(data);
    }
  });
  $("#btn_form_pilih").prop('disabled',true);
});