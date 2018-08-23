$(function () {
    //On resize
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
    //Sign up link
    $("#signup-link").click(function (e) {
       $("#login-form").stop().fadeOut(200);
        $("#signup-form").delay(500).fadeIn();
    });
    //login link
    $("#login-link").click(function (e) {
        $("#signup-form").stop().fadeOut(200);
        $("#login-form").delay(500).fadeIn();
    });
    //Settings
    $(".profile-settings").click(function(e) {
        $(".ul-settings").stop().toggle();
    });
    //Hide and show menu
    $(".custom-bar-icon").click(function () {

        $("#chat-left-area").stop().toggle();

        if ($("#chat-left-area").is(":hidden")){
            $("#chat-right-area").show();
        }else {
            $("#chat-right-area").hide();

        }

    });
    //Change photo
    $(".change_photo").hover(function () {
        $("#change_photo_shadow").stop().fadeIn();
    },function () {
        $("#change_photo_shadow").stop().fadeOut();

    });
    //preview img
    $(".change_photo").click(function () {
        var img_source   = $(this).find(".profile-img").prop("src");
        var preview_area = $("#perview_photo_area");
        preview_area.find("img").prop("src",img_source);
        preview_area.stop().fadeIn();
    });
    //ignore
    $("#perview_photo_area").click(function (event) {
       if (event.target === this ){
           $(this).stop().fadeOut();
       }
    });
    //Change password
    $("#change_password_form").on("submit",function (event) {
        event.preventDefault();

        var current_password = $("#current_password");
        var new_password     = $("#new_password");
        var confirm          = $("#confirm_password");
        var id = $("#user_id").val();

        if (validatePasswordFields(new_password,confirm)){
            $.ajax({
                context:this,
                url:"../../route/route.php",
                type:"POST",
                dataType:"JSON",
                data:{"check_pass":current_password.val(),"id":id},
                success:function (result) {

                    if (result.success){
                        $("#current_error").text("");
                        this.submit();
                    }else{
                        $("#current_error").text("Wrong password");
                    }
                }

            });
        }

    });
    //Change name form
    $("#change_name_form").on("submit",function (event) {
        var name = $("#name").val();
        
        if (!isValidName(name)) {
            event.preventDefault();
            $("#name_error").text("Enter a valid name");
        }else{
            $("#name_error").empty();
        }

    })
    //Change email form 
    $("#change_email_form").on("submit",function (event) {
        event.preventDefault();

        var email = $("#email");
        if (isValidEmail(email)){
            $.ajax({
                url:"/find",
                context:this,
                type:"POST",
                dataType:"JSON",
                data:{"search_user":email.val().trim()},success:function (result) {
                    if (!result.success){
                        $("#email_feedback").empty();
                        this.submit();
                    }else {
                        $("#email_feedback").text("Email already exist enter another");
                    }
                }

            });
        }
    });

    //change photo
    $("#change_photo_form").on("submit",function (event) {
        var img = $("#image");

        if (!validateImageField(img)){
            event.preventDefault();
        }
    });

});

//validate password field
function validatePasswordFields(password,confirm) {
    if (password.val().length < 6 ){
        $("#new_password_error").text("Minimum Password 6 characters");
        return false;
    }else if(password.val().length > 32){
        $("#new_password_error").text("Maximum Password 32 characters");
        return false;
    }else{
        $("#new_password_error").empty();
    }

    if( password.val() !== confirm.val()) {
        $("#confirm_password_error").text("password does't match");
        return false;
    }else{
        $("#confirm_password_error").empty();
    }

    return true;


}
//validate name
function isValidName(name) {

    return name.length >= 3 && (/^[a-zA-Z]+(([ ][a-zA-Z ])?[a-zA-Z]*)*$/).test(name.trim());
}
//validate email
function isValidEmail(email) {

    if(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email.val().trim())){
        $("#email_feedback").empty();
        return true;
    }else{
        $("#email_feedback").text("Please enter a valid email address");
        return false;
    }
}
//validate image
function validateImageField(image) {

    var imageVal = image.val();

    var fileType = imageVal.substring((imageVal.lastIndexOf('.'))+1);

    if (fileType !== "jpeg" && fileType!== "jpg" && fileType !== "png"){
        $("#image_feedback").text("Enter a valid image ");
        return false;
    }else{
        $("#image_feedback").empty();
        return true;
    }



}