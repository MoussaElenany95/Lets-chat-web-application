<?php
    session_start();
    require "../controlers/UserController.php";
    //send message
    if (isset($_POST['send_message'])){

        $message      = trim(htmlspecialchars($_POST['send_message']));
        $message_type = "text";
        $user_id      = $_SESSION['user_id'];
        if (UserController::sendMessage($message,$message_type,$user_id)){

            echo json_encode(['status'=>"success"]);
        }

    }else{
        http_response_code(404);
    }