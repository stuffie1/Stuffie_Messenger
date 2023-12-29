<?php
require("connexion.php");
session_start();
$username=$_SESSION['username'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$birthdate = $_POST['bday'];
$phone = $_POST['phone'];
$motpass = $_POST['password'];

$typeFichierSelection = $_FILES['photo']['type']            ; 
$location = $_POST['oldphoto'];
if (strpos($typeFichierSelection, "image/") === 0) {
  $nomfichier = basename($_FILES['photo']['name']);
  $tempFichier = $_FILES['photo']['tmp_name'];
  $location = "../FRONT_END/images/" . $nomfichier;
  move_uploaded_file($tempFichier, $location);
}

$stmt = $conix->prepare("UPDATE users SET fname=?, lname=?, email=?, photo=?, birthdate=?, phone=?, motpass=? WHERE username=?");

$stmt->execute([$fname, $lname, $email, $location, $birthdate, $phone, $motpass,$username ]);
$stmt = $conix->prepare("UPDATE friendlist SET fname=?, lname=?,  photo=? WHERE username=?");

$stmt->execute([$fname, $lname, $location,$username ]);

 

 

header("location:../FRONT_END/profillogin.php?idprofil=$username");
?>

