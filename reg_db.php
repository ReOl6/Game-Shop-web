<?php
session_start();
include('server.php');
$error = array();

if (isset($_POST['register'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if ($password != $password2){
        array_push($error,'Password not match');
    }

    $user_check = "SELECT * FROM registersys WHERE username = '$username' or email = '$email'";
    $ret = $db->query($user_check);
    $row = $ret->fetchArray(SQLITE3_ASSOC);

    if ($row){
        if ($row['username'] == $username){
            array_push($error, 'user name already exist');
        }
        if ($row['email'] == $email){
            array_push($error, 'email already exist');
        }
    }
    if (count($error) == 0){
        $sqlinsert = "INSERT INTO registersys (username, email, password) VALUES ('$username','$email','$password')";
        $db->exec($sqlinsert);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = 'You are now logged in';
        header('location:index.php');
    }
    else{
        echo '<p></p>Username is already exist <a href="login.php">Login</a></p>';
    }
}

?>