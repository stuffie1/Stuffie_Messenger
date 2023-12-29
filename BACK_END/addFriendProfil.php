<?php 

// require("connexion.php");
// session_start();
// $newfriend=$_GET['newfriend'];
// $infofriend=$conix->prepare("SELECT * FROM users where username=?");
// $infofriend->execute([$newfriend]);
// $donne=$infofriend->fetch();
// $insertfriend=$conix->prepare("INSERT INTO friendlist VALUES(?,?,?,?,?,?)");
// $insertfriend->execute([$newfriend,$donne['fname'],$donne['lname'],$donne['photo'],$donne['statu'],$_SESSION['username']]);
// header("location:../FRONT_END/search.php")




require("connexion.php");
session_start();
$newfriend = $_GET['newfriend'];

$checkFriend = $conix->prepare("SELECT * FROM friendlist WHERE (username = ? AND id_user = ?) OR (username = ? AND id_user = ?)");
$checkFriend->execute([$newfriend, $_SESSION['username'],$_SESSION['username'],$newfriend]);

if ($checkFriend->rowCount() > 0) {
    header("location: ../FRONT_END/search.php");
    exit();
}

$infofriend = $conix->prepare("SELECT * FROM users WHERE username = ?");
$infofriend->execute([$newfriend]);
$donne = $infofriend->fetch();
$infofriend1 = $conix->prepare("SELECT * FROM users WHERE username = ?");
$infofriend1->execute([$_SESSION['username']]);
$donne1 = $infofriend1->fetch();

$insertfriend = $conix->prepare("INSERT INTO friendlist(username, fname, lname, photo, statu, id_user) VALUES (?, ?, ?, ?, ?, ?)");
$insertfriend->execute([$newfriend, $donne['fname'], $donne['lname'], $donne['photo'], $donne['statu'], $_SESSION['username']]);
$insertfriend1 = $conix->prepare("INSERT INTO friendlist(username, fname, lname, photo, statu, id_user) VALUES (?, ?, ?, ?, ?, ?)");
$insertfriend1->execute([$_SESSION['username'], $donne1['fname'], $donne1['lname'], $donne1['photo'], $donne1['statu'],$newfriend ]);
header("location: ../FRONT_END/friendProfile.php?idprofil=$newfriend");
exit();
?>
