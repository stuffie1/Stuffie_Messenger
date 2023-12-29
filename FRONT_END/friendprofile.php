<?php
session_start();
require("../BACK_END/connexion.php");

if (!isset($_SESSION['statu']) || $_SESSION['statu'] !== 1) {
  header("Location: login.php");
}

if (isset($_GET['idprofil'])){ 
$profiluser = $_GET['idprofil'] ;
$select=$conix->prepare("SELECT * FROM users where username=?");
$select->execute([$profiluser]);
$oldnew=$conix->prepare("SELECT * FROM friendlist where username=? and id_user=?");
$oldnew->execute([$profiluser,$_SESSION['username']]);



?>


<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
    integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
    crossorigin="anonymous">
  <script src="jquery-3.6.4.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src=".js.js"></script>
   <style>
    body {
      font-family: Arial, sans-serif;
      background: #7F7FD5;
     background: -webkit-linear-gradient(to right, #364443, #272a30, #33333f);
      background: linear-gradient(to right, #253635, #333a47, #2d2d3a);
      color: white;
      height: 100%;
    
    }
    
    .profile {
      max-width: 205rem;
      margin: 0 auto;
      background: #7F7FD5;
     background: -webkit-linear-gradient(to right, #364443, #272a30, #33333f);
      background: linear-gradient(to right, #253635, #333a47, #2d2d3a);
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      margin-top:80px;
      height: 100%;
    }
    
    .profile-header {
      text-align: center;
      padding-bottom: 20px;
      border-bottom: 1px solid #eee;
    }
    
    .profile-header img {
      width: 150px;
      height: 150px;
      border-radius: 50%;
    }
    
    .profile-info {
      margin-top: 20px;
    }
    
    .profile-info h2 {
      margin-bottom: 10px;
    }
    
    .profile-info p {
      margin-bottom: 5px;
    }
    
    .profile-buttons {
      text-align: center;
      margin-top: 20px;
    }
    
    .profile-buttons button {
      padding: 10px 20px;
      margin-right: 10px;
      border: none;
      border-radius: 4px;
      background-color: #4267B2;
      color: #fff;
      cursor: pointer;
      font-size: 16px;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }
    
    .profile-buttons button:hover {
      background-color: #3b5998;
    } 
    ::-webkit-scrollbar {
  width: 8px;
  background-color: transparent;
}

::-webkit-scrollbar-thumb {
  background-color: transparent;
  border-radius: 4px;
}

::-webkit-scrollbar-track {
  background-color: transparent;
}
    a {
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container h-100">

  <div class="navbar ">
    <div class="menu">
      <a href="acceuil.php" class="logo h3 nav-link text-white">STUFFIE<span>Chat</span></a>
    </div>
  </div>

  <div class="profile">
    <div class="profile-header">
      <?php $profildonne=$select->fetch();?>
      <img src="<?php  echo $profildonne['photo'] ?>" alt="Profile Picture">
      <h1><?php  echo $profildonne['username']   ?></h1>
    </div>
    
    <div class="profile-info">
      <h2>About Me</h2>
      <p>First Name: <?php  echo $profildonne['fname'] ?></p>
      <p>Last Name: <?php  echo $profildonne['lname'] ?></p>
      <p>Email: <?php  echo $profildonne['email'] ?></p>
      <p>Phone: <?php  echo $profildonne['phone'] ?></p>
      <p>Date of Birth: <?php  echo $profildonne['birthdate'] ?></p>
    </div>
    
    <div class="profile-buttons ">
      <?php if( $oldnew->rowCount()<1 ) { ?>
        <button class="bg-light text-dark" ><a href="../BACK_END/addFriendProfil.php?newfriend=<?php echo $profiluser?>" class="text-dark">add friend</button>
      <?php }elseif($oldnew->rowCount()>0) {?>

      <button class="bg-light text-dark" ><a href="message.php?id_distinatire=<?php echo $profiluser?>" class="text-dark">send message</a></button>
      <button class="bg-danger"  ><a href="../BACK_END/deletefriend.php?id_ami=<?php echo $profiluser?>" class="text-dark">supprimer</a></button>
    <?php }}?>
    </div>
  </div>

    <script src="app.js"></script>

</body>
</html>