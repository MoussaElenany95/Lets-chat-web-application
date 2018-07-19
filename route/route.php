<?php
    include "../controlers/UserController.php";
    //user login
    if (isset($_POST['login_submit'])){

        $email    = $_POST['login_email'];
        $password = $_POST['login_password'];

        if (UserController::login($email,$password)){
            echo "OK";
        }


    }

    if(isset($_POST['signup_submit'])){
            $data['name']     = $_POST['full_name'];
            $data['email']    = $_POST['email'];
            $data['password'] = $_POST['password'];
            $data['img']      = $_FILES['img'];

            if (UserController::signup($data)){
                die("Successfully created");
            }
    }

    //user already exist
    if (isset($_POST['search_user'])){
        $email    = $_POST['search_user'];
        $response['success']  = false;

        if (UserController::searchForUserByEmail($email)){
            $response['success'] = true;
        }

        echo  json_encode($response);
        exit();
    }