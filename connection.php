<?php

class dbConnection{
    private static $host = "localhost:3308";
    private static $username = "root";
    private static $password = "";
    private static $dbname = "personalCMS";

    private static $connection = null;

    public static function getConnection(){
        if (self::$connection==null){
            try{
                self::$connection = new PDO("mysql:host=".self::$host.";dbname=".self::$dbname,self::$username,self::$password);

            }catch (PDOException $error){
                echo $error->getMessage();
                die();
            }
        }
        return self::$connection;
    }
}


?>