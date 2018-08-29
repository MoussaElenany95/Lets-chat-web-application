<?php
 require "../controlers/UserController.php";
 session_start();
 if (isset($_FILES['chat-upload-file']['name'])){
    $file       = $_FILES['chat-upload-file'];
    $file_name  = microtime(date("H")).$file['name'];
    $file_ext   = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
    $extensions = array("jpg","jpeg","png","pdf","docx","xls","zip");
    $file_size  = $file['size'];

    if ( !in_array($file_ext,$extensions) ){

        echo json_encode(["error"=>"Enter a valid file"]);

    }
//    elseif ($file_size > 2000000){
//
//        echo json_encode(["error" => "File must be less than 2 mb"]);
//
//    }
    else{

        move_uploaded_file($file['tmp_name'],"../uploads/$file_name");
        if (UserController::sendMessage($file_name,$file_ext,$_SESSION['user_id'])){
            echo json_encode(["status"=>"success"]);
        }else{
            echo json_encode(["error"=>"Unknow error"]);
        }

    }
    //    echo json_encode(["status"=>$file_size]);

 }else{
     http_response_code(404);
 }