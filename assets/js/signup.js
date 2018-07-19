$(function () {

    window.onbeforeunload = function () {

        localStorage.setItem("login_email", $('#login-email').val());


    };
    window.onload = function() {

        var username = localStorage.getItem("login_email");

        $('#login-email').val(username);

    };

    //validate signup inputs
    var form = $("#signup-form");

    validateInputs(form);

    form.on("submit",function (event) {

        var img             = $(this).find("#img");
        var name            = $(this).find("#full_name");
        var email           = $(this).find("#email");
        var password        = $(this).find("#password");

        validateNameField(name,event);
        validateEmailField(email,event);
        validatePasswordField(password,event);
        validateImageField(img,event);
    });

});

function validateInputs(form) {
    var name            = form.find("#full_name");
    var email           = form.find("#email");
    var password        = form.find("#password");
    var img             = form.find("#img");

    img.change(function (event) {
        if (validateImageField(img,event)){
            readURL(this);
        }
    });
    name.blur(function (event) {
        validateNameField(name,event);
    });
    email.blur(function (event) {
        validateEmailField(email,event);

    });
    password.blur(function (event) {
        validatePasswordField(password,event);
    });


}
//validate image
function validateImageField(image,event) {
    var imageVal = image.val();

    var fileType = imageVal.substring((imageVal.lastIndexOf('.'))+1);

    if (fileType !== "jpeg" && fileType!== "jpg" && fileType !== "png"){
        $("#image_feedback").text("Enter a valid image ");
        $("#preview-img").css("border","2px solid #811");
        event.preventDefault();
       return false;
    }else{
        $("#image_feedback").empty();
        $("#preview-img").css("border","2px solid white");
        return true;
    }



}
//validate name field
function validateNameField(name,event) {

    if (!isValidName(name.val()) ){
        name.css( "box-shadow","0 0 4px #811");
        $("#name_feedback").text("Please enter a valid name ");
        event.preventDefault();
    }else if(name.val().length > 32){
        name.css( "box-shadow","0 0 4px #811");
        $("#name_feedback").text("Maximum Password 32 characters");
        event.preventDefault();
    }else{
        name.css( "box-shadow","0 0 4px #181");
        $("#name_feedback").empty();
    }

}
//validate email field
function validatePasswordField(password,event) {

    if (password.val().length < 6 ){
        password.css( "box-shadow","0 0 4px #811");
        $("#password_feedback").text("Minimum Password 6 characters");
        event.preventDefault();
    }else if(password.val().length > 32){
        password.css( "box-shadow","0 0 4px #811");
        $("#password_feedback").text("Maximum Password 32 characters");
        event.preventDefault();
    }else{
        password.css( "box-shadow","0 0 4px #181");
        $("#password_feedback").empty();
    }

}
//validate email field
function validateEmailField(email,event) {
    if (!isValidEmail(email.val())){

        email.css( "box-shadow","0 0 4px #811");
        $("#email_feedback").text("Please enter a valid email address");
        event.preventDefault();
    }else{
        $.ajax({
            url:"../../route/route.php",
            type:"POST",
            dataType:"JSON",
            data:{"search_user":email.val()},success:function (response) {
                if (response.success){
                    email.css( "box-shadow","0 0 4px #811");
                    $("#email_feedback").text("Email already exist, choose another");
                    event.preventDefault();
                }else {
                    email.css( "box-shadow","0 0 4px #181");
                    $("#email_feedback").empty();
                }
            },

        });
    }

}

//validate name
function isValidName(name) {

    return name.length > 3 && (/^[a-zA-Z]+(([ ][a-zA-Z ])?[a-zA-Z]*)*$/).test(name);
}

//validate email
function isValidEmail(email) {
    return /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email)
}

//read url of img
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