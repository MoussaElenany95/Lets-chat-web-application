$(function () {

    window.onbeforeunload = function () {

        sessionStorage.setItem("login_email", $('#login-email').val());


    };
    window.onload = function() {

        var username = sessionStorage.getItem("login_email");

        $('#login-email').val(username);

    };


    //validate signup inputs
    var form = $("#signup-form");
    var img             = form.find("#img");

    //Delete feedback
    $("input").on("change",function () {
        $(this).next().text("");
    });
    img.change(function () {
        if (validateImageField(img)){

            readURL(this);
        }
    });
    form.on("submit",function (event) {
        event.preventDefault();
        var img             = $(this).find("#img");
        var name            = $(this).find("#full_name");
        var email           = $(this).find("#email");
        var password        = $(this).find("#password");

        if (
            validateNameField(name)
            && validatePasswordField(password)
            && validateImageField(img)
            && isValidEmail(email)
        ){
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

});
//validate image
function validateImageField(image) {

    var imageVal = image.val();

    var fileType = imageVal.substring((imageVal.lastIndexOf('.'))+1).toLowerCase();

    if (fileType !== "jpeg" && fileType!== "jpg" && fileType !== "png"){
        $("#image_feedback").text("Enter a valid image ");
        $("#preview-img").css("border","2px solid #811");
       return false;
    }else{
        $("#image_feedback").empty();
        $("#preview-img").css("border","2px solid white");
        return true;
    }



}
//validate name field
function validateNameField(name) {

    if (!isValidName(name.val().trim()) ){
        $("#name_feedback").text("Please enter a valid name ");
        return false;
    }else if(name.val().length > 32){
        $("#name_feedback").text("Maximum Password 32 characters");
        return false;
    }else{
        $("#name_feedback").empty();
        return true;
    }

}
//validate password field
function validatePasswordField(password) {

    if (password.val().length < 6 ){
        $("#password_feedback").text("Minimum Password 6 characters");
        return false;
    }else if(password.val().length > 32){
        $("#password_feedback").text("Maximum Password 32 characters");
        return false;
    }else{
        $("#password_feedback").empty();
        return true;
    }

}

//validate name
function isValidName(name) {

    return name.length > 3 && (/^[a-zA-Z]+(([ ][a-zA-Z ])?[a-zA-Z]*)*$/).test(name.trim());
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