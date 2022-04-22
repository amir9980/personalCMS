<?php
require 'connection.php';
if ($_POST && $_POST['submit']=='login'){


    function validate($string){
        $string = trim($string);
        $string = stripcslashes($string);
        $string = htmlspecialchars($string);
        return $string;
    }

    function isAuth($email,$password){
        $connection = dbConnection::getConnection();
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $connection->prepare($sql);
        $stmt->execute([$email]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if($result && $result['password']==$password){
            echo "auth true";
        }else{
            die('not authenticated.');
        }
    }

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    isAuth($email,$password);
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
</head>
<body>
<form action="#" method="POST">
    <label for="email">email:</label>
    <input type="email" name="email" required>
    <label for="password">password:</label>
    <input type="password" name="password" required>
    <input type="submit" name="submit" value="login">
</form>
</body>
</html>