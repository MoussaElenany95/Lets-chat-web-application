<?php
include "DataBase.php";

class User extends DataBase
{

    //Insert to users table
    public function   insert($data){
        $name     = ucwords(htmlspecialchars($data['name']));
        $email    = strtolower(htmlspecialchars($data['email']));
        $password = password_hash($data['password'],PASSWORD_DEFAULT);
        $img      = microtime(date("H")).$data['img']['name'];

        if (move_uploaded_file($data['img']['tmp_name'],"../uploads/$img")){
            $sql = $this->conn->prepare("INSERT INTO users (name,email,password,img)
                      VALUES (?,?,?,?)");
            $sql->execute([$name,$email,$password,$img]);

            return true;
        }

        return false;
    }
    //Find User by email
    public   function findByEmail($email){

        $email = strtolower($email);

        $sql = $this->conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");

        $sql->execute(array($email));

        return $sql->fetchObject();
    }

    //Find User by id
    public   function findById($userId){

        $sql = $this->conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");

        $sql->execute(array($userId));

        return $sql->fetchObject();
    }
    //Update user
    public function update($update,$id){

        $sql = $this->conn->prepare("UPDATE users set {$update['type']} = ? WHERE id = ? LIMIT 1");

        return $sql->execute(array($update['value'],$id));
    }
}