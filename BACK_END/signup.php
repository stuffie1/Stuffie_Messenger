<?php

require("connexion.php");
$user=$_POST['username'];
$sel=$conix->prepare("SELECT * FROM users where username=?");
$sel->execute([$user]);
if ($sel->rowCount() > 1) {
  header("location:../FRONT_END/login.php?msg=les données d'authentification deja execist");

} else {

$typeFichierSelection = $_FILES['photo']['type']            ; 
$location = "images/default.png"; 

if (strpos($typeFichierSelection, "image/") === 0) {
   $nomfichier = basename($_FILES['photo']['name']);
   $tempFichier = $_FILES['photo']['tmp_name'];
   $location = "../FRONT_END/images/" . $nomfichier;
   move_uploaded_file($tempFichier, $location);
}

$newuser=$conix->prepare("INSERT INTO users(username,fname,lname,email,photo,birthdate,phone,motpass) VALUES (?,?,?,?,?,?,?,?)");
$newuser->execute(array($_POST['username'],$_POST['fname'],$_POST['lname'],$_POST['email'],$location,$_POST['bday'],$_POST['phone'],$_POST['password']));
header("location:../FRONT_END/acceuil.php?msg= welcome $user");

}
?>