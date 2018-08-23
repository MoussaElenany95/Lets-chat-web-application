<?php
require "../controlers/UserController.php";
//user already exist
 if (isset($_POST['search_user'])){
    $email    = trim(htmlspecialchars($_POST['search_user']));
    $response['success']  = false;

    if (UserController::searchForUserByEmail($email)){
        $response['success'] = true;
    }

    echo  json_encode($response);
    exit();
}else{
     http_response_code(404);
 }