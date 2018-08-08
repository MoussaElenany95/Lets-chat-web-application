<?php
    include "../controlers/UserController.php";
    session_start();

    //user login
    if (isset($_POST['login_submit'])){

        $email    = trim(htmlspecialchars($_POST['login_email']));
        $password = htmlspecialchars($_POST['login_password']);
        $login    = UserController::login($email,$password);
        if ($login){
            $_SESSION['user_name'] = $login->name;
            $_SESSION['user_id']   = $login->id;
            $_SESSION['img']       = $login->img;
            header("location:../views/home.php");
        }else{
            $_SESSION['login_error'] = "Incorrect email or password";
            header("location:../views/index.php");
        }


    }

    if(isset($_POST['signup_submit'])){

            $data['name']     = trim(htmlspecialchars($_POST['full_name']));
            $data['email']    = trim(htmlspecialchars($_POST['email']));
            $data['password'] = trim(htmlspecialchars($_POST['password']));
            $data['img']      = $_FILES['img'];

            if (UserController::signup($data)){
                die("Successfully created");
            }
    }

    //user already exist
    if (isset($_POST['search_user'])){
        $email    = trim(htmlspecialchars($_POST['search_user']));
        $response['success']  = false;

        if (UserController::searchForUserByEmail($email)){
            $response['success'] = true;
        }

        echo  json_encode($response);
        exit();
    }
    //logout
    if (isset($_GET['logout'])){
        session_destroy();
        header("location:../views/index.php");
    }
    //Check password
    if (isset($_POST['check_pass'])){

        $password = $_POST['check_pass'];

        $id       = $_POST['id'];

        $response['success'] = false;

        $user = UserController::searchForUserById($id);

        if (password_verify($password,$user->password)){
            $response['success'] = true;
        }

        echo json_encode($response);
        exit();
    }