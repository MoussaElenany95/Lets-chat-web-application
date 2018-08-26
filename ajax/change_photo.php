<?php
    require "../controlers/UserController.php";
    session_start();
    if (isset($_FILES['update_image'])){

        $image      = $_FILES['update_image'];
        $id         = $_SESSION['user_id'];
        $old_img    = "../uploads/".$_SESSION['img'];



        $img      = microtime(date("H")).$image['name'];

        if (move_uploaded_file($image['tmp_name'],'../uploads/'.$img)){
            //Delete old image
            if (file_exists($old_img)){
                unlink($old_img);
            }

            $update['type']  = "img";
            $update['value'] = $img;

            UserController::updateUser($update,$id);

            $_SESSION['img'] = $img;

        }
        exit();

    }else{
        http_response_code(404);
    }
