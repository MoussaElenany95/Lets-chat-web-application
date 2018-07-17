$(function () {
        //to handel resize screen
        $(window).on("resize",function () {
                if ($(this).width() > 800  ){
                    $("#chat-left-area").show();
                    $("#chat-right-area").show();
                }
                if ($(this).width() < 800  ){
                    $("#chat-left-area").hide();
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

    $("#img").on("change",function (e) {
        readURL(this);
    });

    $(".profile-settings").click(function(e) {
        $(".ul-settings").stop().slideToggle();
    });

    $(".custom-bar-icon").click(function () {
        $("#chat-left-area").stop().slideToggle();
        $("#chat-right-area").toggle();
    });
});

function readURL(input) {

    if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {
            $('#preview-img').attr('src', e.target.result);
            $('#preview-img').show();
        };

       reader.readAsDataURL(input.files[0]);
    }
}