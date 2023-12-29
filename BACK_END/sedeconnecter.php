<?php

session_start();
require("connexion.php");

if (!isset($_SESSION['statu']) || $_SESSION['statu'] !== 1) {
    header("Location:login.php");
}
$user=$_SESSION['username'];
$statu=0;
$modify = $conix->prepare("UPDATE users set statu = ? where username=?");
$modify->execute(array( $statu,$user));
$modify1 = $conix->prepare("UPDATE friendlist set statu = ? where username=?");
$modify1->execute(array( $statu,$user));
unset($_SESSION['statu']);
unset($_SESSION['username']);
session_destroy();
header("location:../FRONT_END/login.php");

?>