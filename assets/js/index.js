$(function () {
    var width = $(window).width();
    $(window).on("resize",function () {
       var resize = $(this).width();
        if (resize <= 800 && resize != width ){

            $("#chat-left-area").hide();
            $("#chat-right-area").show();
       }
       else if (resize > 800) {

            $("#chat-left-area").show();
            $("#chat-right-area").show();
        }
        

    });
    $("#signup-link").click(function (e) {
       $("#login-form").stop().fadeOut(200);
        $("#signup-form").delay(500).fadeIn();
    });
    $("#login-link").click(function (e) {
        $("#signup-form").stop().fadeOut(200);
        $("#login-form").delay(500).fadeIn();
    });

    $(".profile-settings").click(function(e) {
        $(".ul-settings").stop().toggle();
    });

    $(".custom-bar-icon").click(function () {

        $("#chat-left-area").stop().toggle();

        if ($("#chat-left-area").is(":hidden")){
            $("#chat-right-area").show();
        }else {
            $("#chat-right-area").hide();

        }

    });

});

