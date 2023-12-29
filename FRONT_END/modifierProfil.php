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
  <link rel="stylesheet" href="login.css">
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

    
    
  <form action="../BACK_END/modifierProfilAction.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()"  class="mt-3">


  
  <div class="form__group field w-75 mx-auto mb-4">
    <input type="text" class="form__field"  name="fname" value="<?php  echo $profildonne['fname'] ?>">
    <label for="name" class="form__label">NOM</label>
    <span id="fnameError" class="text-danger"></span>
  </div>
  
  <div class="form__group field w-75 mx-auto mb-4">
    <input type="text" class="form__field"  name="lname" value="<?php  echo $profildonne['lname'] ?>">
    <label for="name" class="form__label">PRENOM</label>
    <span id="lnameError" class="text-danger"></span>
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="email" class="form__field" value="<?php  echo $profildonne['email'] ?> "name="email">
    <label for="name" class="form__label">Email</label>
    <span id="emailError" class="text-danger"></span>
  </div>
  
  <div class="form__group field w-75 mx-auto mb-4">
    <input type="date" class="form__field" value="<?php  echo $profildonne['birthdate'] ?>" name="bday">
    <label for="name" class="form__label">DATE DE NAISSANCE</label>
    <span id="bdayError" class="text-danger"></span>
  </div>
  
  <div class="form__group field w-75 mx-auto mb-4">
    <input type="file" class="form__field" name="photo">
    <label for="name" class="form__label">Photo de Profile</label>
    <input type="hidden" name="oldphoto" value="<?php  echo $profildonne['photo'] ?>">
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="tel" class="form__field" value="<?php  echo $profildonne['phone'] ?>" name="phone">
    <label for="name" class="form__label">PHONE</label>
    <span id="phoneError" class="text-danger"></span>
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="password" class="form__field" value="<?php  echo $profildonne['motpass'] ?>" name="password" id="spassword">
    <label for="name" class="form__label">Password</label>
    <span id="passwordError" class="text-danger"></span>
  </div>
  <div class="profile-buttons">
      <button class="bg-white text-dark" type="submit">Update Profile</button>
    </div>
  </form>
  
</div>
<?php }?>
    <script src="app.js"></script>
    <script>
       function validateForm() {


const fname = document.getElementsByName("fname")[0].value.trim();
const lname = document.getElementsByName("lname")[0].value.trim();
const email = document.getElementsByName("email")[0].value.trim();
const bday = document.getElementsByName("bday")[0].value;
const phone = document.getElementsByName("phone")[0].value.trim();
const password = document.getElementById("spassword").value.trim();

const nameRegex = /^[a-zA-Z]{3,50}$/;
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const dateRegex = /^([0-9]{4})-(0[1-9]|1[0-2])-([0-2][0-9]|3[01])$/;
const phoneRegex = /^\d{10}$/;
const passwordRegex = /^.{8,32}$/;

let isValid = true;



if (!nameRegex.test(fname)) {
  document.getElementById("fnameError").innerText = "Invalid format!";
  isValid = false;
} else {
  document.getElementById("fnameError").innerText = "";
}

if (!nameRegex.test(lname)) {
  document.getElementById("lnameError").innerText = "Invalid format!";
  isValid = false;
} else {
  document.getElementById("lnameError").innerText = "";
}

if (!emailRegex.test(email)) {
  document.getElementById("emailError").innerText = "Invalid email address";
  isValid = false;
} else {
  document.getElementById("emailError").innerText = "";
}

if (!dateRegex.test(bday)) {
  document.getElementById("bdayError").innerText = "Date should be between 01-01-1970 and 01-01-2010.";
  isValid = false;
} else {
  document.getElementById("bdayError").innerText = "";
}

if (!phoneRegex.test(phone)) {
  document.getElementById("phoneError").innerText = "Invalid phone number";
  isValid = false;
} else {
  document.getElementById("phoneError").innerText = "";
}

if (!passwordRegex.test(password)) {
  document.getElementById("passwordError").innerText = "Password should be between 8 and 32";
  isValid = false;
} else {
  document.getElementById("passwordError").innerText = "";
}


if (!isValid) {
  return false; 
}
return true;
}

    </script>

  </body>
  </html>