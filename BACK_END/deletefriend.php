<?php
// require("connexion.php");
// session_start();
// $Supp = $_GET['id_ami'];
// $profiluser=$_SESSION['username'];
// $st = $conix->prepare("DELETE FROM messages WHERE (id_auteur = ? AND id_distinataire =? ) OR (id_auteur = ? AND id_distinataire =? )");
// $st->execute(array($Supp,$profiluser,$profiluser,$Supp));
// $stmt = $conix->prepare("DELETE FROM friendlist WHERE (username = ? and id_user=? ) or (username = ? and id_user=? )");
// $stmt->execute(array($Supp,$profiluser,$profiluser,$Supp));
// header("location:../BACK_END/acceuil.php");




require("connexion.php");
session_start();
$Supp = $_GET['id_ami'];
$profiluser = $_SESSION['username'];

try {
    $st = $conix->prepare("DELETE FROM messages WHERE (id_auteur = ? AND id_distinataire = ?) OR (id_auteur = ? AND id_distinataire = ?)");
    $st->execute(array($profiluser, $Supp, $Supp, $profiluser));

    $stmt = $conix->prepare("DELETE FROM friendlist WHERE (username = ? AND id_user = ?) OR (username = ? AND id_user = ?)");
    $stmt->execute(array($profiluser, $Supp, $Supp, $profiluser));

    header("location:../FRONT_END/acceuil.php");
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>




