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
            $_SESSION['email']     = $login->email;
            $_SESSION['img']       = $login->img;
            header("location:../home");
        }else{
            $_SESSION['login_error'] = "Incorrect email or password";
            header("location:../");
        }


    }

    else if(isset($_POST['signup_submit'])){

            $data['name']     = trim(htmlspecialchars($_POST['full_name']));
            $data['email']    = trim(htmlspecialchars($_POST['email']));
            $data['password'] = trim(htmlspecialchars($_POST['password']));
            $data['img']      = $_FILES['img'];

            if (UserController::signup($data)){
                $_SESSION['signup_success'] = "Account is  successfully created , check your email address ";
                header("Location:../");
            }
        }

    //user already exist
    else if (isset($_POST['search_user'])){
        $email    = trim(htmlspecialchars($_POST['search_user']));
        $response['success']  = false;

        if (UserController::searchForUserByEmail($email)){
            $response['success'] = true;
        }

        echo  json_encode($response);
        exit();
    }
    //logout
    else if (isset($_GET['logout'])){
        session_destroy();
        header("location:../");
    }
    //Check password
    else if (isset($_POST['check_pass'])){

        $password = $_POST['check_pass'];

        $id       = $_SESSION['user_id'];

        $response['success'] = false;

        $user = UserController::searchForUserById($id);

        if (password_verify($password,$user->password)){
            $response['success'] = true;
        }

        echo json_encode($response);
        exit();
    }

    //Update password

    else if (isset($_POST['change_password'])){

        $update['type']     = "password";
        $update['value']    = password_hash($_POST['new_password'],PASSWORD_DEFAULT);
        $id                 = $_SESSION['user_id'];

        if (UserController::updateUser($update,$id)){

            $_SESSION['password_success'] = "Password has been successfully changed ";
        }
        header("location:../change/password");
        exit();
    }
    //Change password
    else if (isset($_POST['change_name_submit'])){

        $update['type']     = "name";
        $update['value']    = ucwords(trim(htmlspecialchars($_POST['name'])));
        $id                 = $_SESSION['user_id'];
        if (UserController::updateUser($update,$id)){

            $_SESSION['name_success'] = "Name has been successfully changed ";
            $_SESSION['user_name']        = $update['value'];
        }
        header("location:../change/name");
        exit();
    }
    //Change email
    else if (isset($_POST['change_email_submit'])){
        $update['type']    = "email";
        $update['value']   = trim(htmlspecialchars(strtolower($_POST['email'])));
        $id                = $_SESSION['user_id'];

        if (UserController::updateUser($update,$id)){
            $_SESSION['email_success'] = "Email updated successfully , check it to verify";
            unset($_SESSION['user_id']); //to log out user ;
            header("Location:../");
        }
    }
    //No Request sent
    else{
        session_destroy();
        http_response_code(404);
    }