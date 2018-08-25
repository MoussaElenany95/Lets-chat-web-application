<?php
    //Database  class
abstract  class DataBase
{
    private $host = "localhost";
    private $dbname = "messenger";
    private $username = "root";
    private $password = "";
    protected  $conn;

    //Database constructor
     function  __construct()
    {
        //PDO connection to database
        try{

            $this->conn = new PDO("mysql:dbname=$this->dbname;host=$this->host;charset=utf8mb4",$this->username,$this->password);
        }catch (PDOException $e){
            echo "Database connection failed :".$e->getMessage();

        }
    }


}

