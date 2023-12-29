<?php
session_start();
$bdd = new PDO("mysql:host=localhost;dbname=message_prive;charset=utf8;port=3306", "root", "");


if (!isset($_SESSION['statu']) || $_SESSION['statu'] !== 1) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tous les utilisateurs sur le site</title>
</head>

<body>
    <?php
    $recupUser = $bdd->prepare("SELECT * FROM users");
    $recupUser->execute();
    while ($user = $recupUser->fetch()) {
        ?>
        <a href="message.php?id=<?php echo $user['id']; ?>">
            <p><?php echo $user['pseudo'] ?></p>
        </a>
    <?php
    }
    ?>

</body>

</html>
