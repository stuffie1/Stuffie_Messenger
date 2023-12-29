<?php
require("../BACK_END/connexion.php");

session_start();

if (isset($_SESSION['statu']) && $_SESSION['statu'] === 1) {
    header("Location: acceuil.php");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="login.css">


  
</head>
<body class="text-dark" id="body">
  <div class="w-50 p-5 mx-auto" id="login">
    <?php
     if(isset($_GET['msg'])){

       ?>
       <h3 style="color:red ;display:block" class="alert h5 alert-success" id="h3"><?php echo $_GET['msg']; ?></h3>
       <?php } ?>
       <p id="validationResult" class=" h5 alert-success" style="color:red ;display:block"></p><br>
       <ul class="nav nav-pills me-5 nav-justified mb-3 " id="ex1" role="tablist">
      <li class="nav-item" >
        <button class="nav-link active " id="button" onclick="showlogin()">Login</button>
      </li>
      <li class="nav-item ms-5" >
        <button class="nav-link" id="button0" onclick="showregister()">Register</button>
      </li>
    </ul>

    <div class="tab-content">
      <form action="../BACK_END/signin.php" method="POST" onsubmit="validateForm(event)">
   
          <div class="text-center mb-3">
            <p id="p">Sign in with:</p>

    
      
          <div class="form__group field w-75 mx-auto  mb-4">
            <input type="text" class="form__field " placeholder="Email or username" name="username" id="username">
            <label for="name" class="form__label">Email or username</label>
        </div>
          <div class="form__group field w-75 mx-auto  mb-4">
            <input type="password" class="form__field " placeholder="mot de pass" name="password">
            <label for="name" class="form__label">Mot de pass</label>
        </div>


        
          <div class="row mb-4 px-5 ">
            <div class="col-md-6 d-flex justify-content-center col">
    
              <div class="form-check mb-3 mb-md-0">
                <input class="form-check-input" type="checkbox" value="" name="loginCheck"  />
                <label class="form-check-label " for="loginCheck" id="p"> Remember me </label>
              </div>
            </div>
            <a href="#!" class="col" id="p1">Forgot password?</a>
    
    
            </div>
          </div>
    
    
          <div class="col-6  text-center mx-auto"><button type="submit" class="btn  btn-block mb-4 " id="button4">Sign in</button></div>
    
          <div class="text-center">
            <p id="p">Not a member? <a href="#!" id="p1">Register</a></p>
          </div>
      </form>

    </div>
    <center><label class="ui-switch mt-5">
      <input type="checkbox">
      <div class="slider">
        <div class="circle"></div>
      </div>
    </label></center>
  </div>

  <div id="register" class="w-50 p-5 mx-auto">
    <ul class="nav nav-pills nav-justified mb-3" >
      <li class="nav-item me-5" >
        <button class="nav-link" id="button" onclick="showlogin()">Login</button>
      </li>
      <li class="nav-item me-5" >
        <button class="nav-link active" id="button0" onclick="showregister()">Register</button>
      </li>
    </ul>
    <div class="tab-content">

    <form action="../BACK_END/signup.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
  <div class="text-center mb-3">
    <p id="p">Sign up with:</p>
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="text" class="form__field" placeholder="Username" required="" name="username" id="susername">
    <label for="name" class="form__label">Username</label>
    <span id="usernameError" class="text-danger"></span>
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="text" class="form__field" placeholder="NOM" name="fname">
    <label for="name" class="form__label">NOM</label>
    <span id="fnameError" class="text-danger"></span>
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="text" class="form__field" placeholder="PRENOM" name="lname">
    <label for="name" class="form__label">PRENOM</label>
    <span id="lnameError" class="text-danger"></span>
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="email" class="form__field" placeholder="Email" name="email">
    <label for="name" class="form__label">Email</label>
    <span id="emailError" class="text-danger"></span>
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="date" class="form__field" placeholder="mm dd yyyy" name="bday">
    <label for="name" class="form__label">DATE DE NAISSANCE</label>
    <span id="bdayError" class="text-danger"></span>
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="file" class="form__field" name="photo">
    <label for="name" class="form__label">Photo de Profile</label>
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="tel" class="form__field" placeholder="PHONE" name="phone">
    <label for="name" class="form__label">PHONE</label>
    <span id="phoneError" class="text-danger"></span>
  </div>

  <div class="form__group field w-75 mx-auto mb-4">
    <input type="password" class="form__field" placeholder="Password" name="password" id="spassword">
    <label for="name" class="form__label">Password</label>
    <span id="passwordError" class="text-danger"></span>
  </div>
  <div class="col-6  text-center mx-auto"><button type="submit" class="btn btn-block mb-3 " id="button1">Sign Up</button></div>
</form>


    </div>
    <center><label class="ui-switch">
      <input type="checkbox">
      <div class="slider">
        <div class="circle"></div>
      </div>
    </label></center>
  </div>
  <script src="login.js">  </script>
  <script>
    function validateForm(event) {
  event.preventDefault();
  let h3=document.getElementById("h3");

  const username = document.getElementById("username").value;
  const password = document.querySelector("input[name='password']").value;
  const validationResult = document.getElementById("validationResult");

  if (username.trim() === "" || password.trim() === "") {
    validationResult.textContent = "All authentication fields are required!";
    validationResult.style.display = "block";
    validationResult.classList.add("alert-success");
    validationResult.classList.add("alert");
    h3.style.display = "none";

    return;
  }

  const userRegex = /^[a-zA-Z0-9_]{6,50}$/;
  const passwordRegex = /^.{8,32}$/;
  if (!userRegex.test(username) || !passwordRegex.test(password)) {
    validationResult.textContent = "Invalid username or password.";
    validationResult.classList.add("alert-success");
    validationResult.classList.add("alert");

    validationResult.style.display = "block";
    return;
  }

  event.target.submit();
}







  </script>



  <script>
  function validateForm() {


  const username = document.getElementById("susername").value.trim();
  const fname = document.getElementsByName("fname")[0].value.trim();
  const lname = document.getElementsByName("lname")[0].value.trim();
  const email = document.getElementsByName("email")[0].value.trim();
  const bday = document.getElementsByName("bday")[0].value;
  const phone = document.getElementsByName("phone")[0].value.trim();
  const password = document.getElementById("spassword").value.trim();

  const userRegex = /^[a-zA-Z0-9_]{6,50}$/;
  const nameRegex = /^[a-zA-Z]{3,50}$/;
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const dateRegex = /^([0-9]{4})-(0[1-9]|1[0-2])-([0-2][0-9]|3[01])$/;
  const phoneRegex = /^\d{10}$/;
  const passwordRegex = /^.{8,32}$/;

  let isValid = true;

  if (!userRegex.test(username)) {
    document.getElementById("usernameError").innerText = "Invalid username format!";
    isValid = false;
  } else {
    document.getElementById("usernameError").innerText = "";
  }

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

  // Additional validation for other fields if needed

  if (!isValid) {
    return false; // Prevent form submission
  }
}

</script>
</body>
</html>
