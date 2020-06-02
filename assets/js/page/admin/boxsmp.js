

$("#progress1").animate( {
    width: "30%"
}, {
    duration: 300, done: function () {
        $("#progress2").animate({
            width: "10%"
        }, {
            duration: 300, done: function() {
                $("#progress3").animate({
                    width: "60%"
                },{duration:1, done: function ()
                    {
                        $("#progress1 p, #progress1 h3, #progress2 p, #progress2 h3, #progress3 p, #progress3 h3").animate({
                            color: "rgba(255, 255, 255, 1)"
                        },1000);

                     }
                });
            }
        });
    }
});