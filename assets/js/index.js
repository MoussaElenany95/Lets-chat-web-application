$(function () {
    //get country time zone
    var timezone_offset_minutes = new Date().getTimezoneOffset();
    timezone_offset_minutes = timezone_offset_minutes == 0 ? 0 : -timezone_offset_minutes;
    document.cookie = "timezone="+timezone_offset_minutes;

    //On resize
    var width = $(window).width();
    var height  = $(document).height();
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

    });
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

        event.preventDefault();
        var img = $("#update_image");
        if (validateImageField(img)){
            $(".upload-progress").show();
            $("#update_image").hide(); //hide input to avoid repeating
            $("#change_photo_submit").attr("disabled",true);
            $("#change_photo_submit").val("Please wait ....");
            $.ajax({
                xhr:function(){
                  var xhr = new window.XMLHttpRequest();
                  
                  xhr.upload.addEventListener("progress",function (evt) {

                      if (evt.lengthComputable){
                          var percent = Math.round((evt.loaded/evt.total)*100 );
                          $(".upload-progress").val(percent);
                          console.log(percent);
                          if (percent === 100){
                              $("#percent").text(percent+" % Uploading  completed");
                              $("#update_image").show(); //show input
                              $("#change_photo_submit").attr("disabled",false);
                              $("#change_photo_submit").val("Save changes");
                              img.val('');

                          }else {
                              $("#percent").text(percent+" % Uploaded  please wait ....");
                          }

                      }
                  });
                  
                  return xhr
                },
                type: "POST",
                url: "/update/image",
                data: new FormData($("#change_photo_form")[0]),
                contentType:false,
                processData:false,
                encode:"multipart/form-data",
                dataType:"JSON",
                success:function (result) {
                    if (result.img){
                        $(".profile-img").attr("src",result.img);
                    }
                   console.log(result);
                }

            });
        }
    });
    //Send message
    $(".chat-form-container").on("keypress", function(event) {

        if (event.keyCode === 13 ){
            sendMessage(event);
        }
    });
    //send message
    $(".send-mssage").on("click",function (event) {
            sendMessage(event);
    });
    //chat upload file
    $("#chat-file-upload").on("change",function () {
            ajaxSendFile($(this));
    });

    //Retry send message
    $(document).on("click",".retry-send-message",function () {
       let waiting             = $(this).parent();
       let right_message       = waiting.parent();
       let right_message_area  = right_message.parent();
       let message             = right_message_area.find("p").text().trim();
       right_message_area.parent().parent().remove();

       ajaxSendMessage(message)
    });

    //get all messages
    getAllMessages();

    //auto scroll to the bottom
    setTimeout(function () {

        let scroll_length = $(".chat-messages")[0].scrollHeight;
        $(".chat-messages").animate({scrollTop:scroll_length},1000);

    },1000);

    //get all messages after 3 seconds
    setInterval(function () {
        let scroll_height = $(".chat-messages")[0].scrollHeight;
        let user_scroll   = $(".chat-messages").scrollTop();
        let scroll_size   = $(".chat-messages")[0].clientHeight;

        getAllMessages();

        //to scroll to new message
        if (scroll_height === user_scroll+scroll_size  ){
            $(".chat-messages").animate({scrollTop:scroll_height},1000);
        }

    },3000);
});

function ajaxSendFile(elemet) {
    //Get file name
    var file_name =elemet.val().trim();

    if (file_name !== ""){
        $.ajax({
            type: "POST",
            url: "/send/file",
            data: new FormData($(".chat-form-container")[0]),
            contentType:false,
            processData:false,
            encode:"multipart/form-data",
            dataType:"JSON",
            success:function (result) {
                //get error from server
                if (result.error){

                    $(".send-file-error").addClass("show-error");
                    $(".send-file-error-text").text(result.error);

                    setTimeout(function () {
                        $(".send-file-error").removeClass("show-error");
                    },3000);

                }else{

                    getAllMessages();
                    $(".chat-messages").animate({scrollTop:$(".chat-messages")[0].scrollHeight},1000);

                }
            }
        });
    }
}
//Ajax send message
function sendMessage(event) {

    //Get message content
    var message = $("#send_message").val().trim();

    // //clear message field
    $(".chat-form-container").trigger("reset");
    event.preventDefault();

    ajaxSendMessage(message);
}

//Send message
function ajaxSendMessage(message) {

    let waiting_message = $(".new-waiting-message").append('' +
        '<div class="right-message-area">' +
        '<div class="right-message">' +
        '<div class="right-sender-name-date"> ' +
        '<span class="message-time"></span> ' +
        '</div> ' +
        '<div class="right-message-content">' +
        '<p>'+message+'</p> ' +
        '<span class="waiting">sending...<img class="loading" src="/assets/images/loading.gif"></span>'+
        '</div>' +
        ' </div> ' +
        '</div>');

    $(".chat-messages").animate({scrollTop:$(".chat-messages")[0].scrollHeight},1000);



    if (message.length > 0){
        $.ajax({
            type: "POST",
            url:"/send/message",
            dataType:"JSON",
            data:{ send_message:message},timeout:3000,success:function (result) {

                if (result.status === "success"){
                    $(".new-waiting-message > div").last().remove();

                    getAllMessages();

                }
            }
            ,error:function () {
                let error_msg = waiting_message.find(".waiting");
                error_msg.html("<div><a onclick='alert('sssssss')' class='retry-send-message'>Failed to send , click to retry</a>");
            }},

        );

    }


}

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

    var fileType = imageVal.substring((imageVal.lastIndexOf('.'))+1).toLowerCase();

    if (fileType !== "jpeg" && fileType!== "jpg" && fileType !== "png"){
        $("#image_feedback").text("Enter a valid image ");
        return false;
    }else{
        $("#image_feedback").empty();
        return true;
    }



}
//Get all messages
function getAllMessages() {
    $.ajax({
        type:"GET",
        url:"/get/messages",
        data:{messages:true},
        success:function (result) {
            $(".chat-old-messages").html(result);
        }
    });
}