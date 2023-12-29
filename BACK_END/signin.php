<?php

require("connexion.php");
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $select = $conix->prepare("SELECT COUNT(*) AS count FROM users WHERE username=? AND motpass =?");
    $select->execute([$username, $password]);
    $result = $select->fetch();


    if ($result['count'] === 1) {
        $_SESSION['username'] = $username;
        $_SESSION['statu'] = 1;
        $modify = $conix->prepare("UPDATE users set statu = ? where username=?");
        $modify->execute(array( $_SESSION['statu'],$_SESSION['username']));
        $modify1 = $conix->prepare("UPDATE friendlist set statu = ? where username=?");
        $modify1->execute(array( $_SESSION['statu'],$_SESSION['username']));
        
        if (isset($_POST['loginCheck'])) {
        setcookie("email", $username, time() + (86400 * 30), "/"); 
        setcookie("password", $password, time() + (86400 * 30), "/");
        }
     header("location:../FRONT_END/acceuil.php?msg= welcome $username");      
    } else {
      header("location:../FRONT_END/login.php?msg=Invalid username or password");      
    }
};


?>