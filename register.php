<?php

require "connection.php";

if($_POST && $_POST['submit']=="register"){


    function fileValidator($file){
        $maxSize = 4000000;
        $typesAllowed = ['jpg','png','jpeg'];
        //
    }

    function validate($string){
        $string = trim($string);
        $string = stripcslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }



    function registerUser($username,$password,$email){
        $connection = dbConnection::getConnection();
        try{
            $sql = "INSERT INTO users (username,password,email) VALUES ('$username','$password','$email')";
            $connection->exec($sql);
            echo 'user added succesfully!';
            $connection = null;
        }catch (PDOException $e){
            echo $e->getmessage();
            $connection = null;
            die();
        }
    }


    function uploadProfile($image){
        if ($image!=null){
            $uploadDir = 'uploads/profiles/';
            $uploadPath = $uploadDir.basename($image['name']);
            if (move_uploaded_file($image['tmp_name'],$uploadPath)){
                echo 'image uploaded succesfully!';
            }else{
                die("file could'nt upload");
            }
        }else{
            return null;
        }
    }





    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $email = validate($_POST['email']);


    registerUser($username,$password,$email);
    uploadProfile($_FILES['profile_img']);





}


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
</head>
<body>
<form action="#" method="POST" enctype="multipart/form-data">
    <label for="username">user name:</label>
    <input type="text" name="username" required>
    <label for="password">password:</label>
    <input type="password" name="password" required>
    <label for="email">email:</label>
    <input type="email" name="email" required>
    <label for="profile_img">profile: (optional)</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="4000000" />
    <input type="file" name="profile_img">
    <input type="submit" name="submit" value="register">
</form>
</body>
</html>