<?php
include "../models/User.php";
class UserController
{
    //login
    public static function login($email,$password){
        $user = new User();

        $login = $user->findByEmail($email);

        if ($login){

            if ( password_verify($password,$login->password) ){
                $update['type']  = "status";
                $update['value'] = 1;
                self::updateUser($update,$login->id);
                return $login;
            }

        }

        return null;
    }

    //signup
    public static  function signup($data){

        $user   = new User();
            $signup = $user->insert($data);

            if ($signup){
                return true;
            }

        return false;
    }
    //Search for user
    public static function searchForUserByEmail($email){
        $user = new User();

        $search = $user->findByEmail($email);

        return $search;
    }
    //Check user password
    public static function searchForUserById($id){
        $user  = new User();
        $check = $user->findById($id);

        return $check;
    }
    //Update password
    public static function updateUser($update,$id){
        $user   = new User();

        $update = $user->update($update,$id);

        return $update;
    }



}

