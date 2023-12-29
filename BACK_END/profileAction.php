<?php
session_start();

require("connexion.php");
$getid=$_GET['idprofil'];
$myprofile=$_SESSION['username'];
if($getid!=$myprofile){
 
  header("location:../FRONT_END/friendprofile.php?idprofil=$getid");
}else{
  header("location:../FRONT_END/profillogin.php?idprofil=$myprofile");
}







?>