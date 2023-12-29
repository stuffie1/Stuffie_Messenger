<?php

session_start();
if (!isset($_SESSION['statu']) || $_SESSION['statu'] !== 1) {
  header("Location:login.php");
}
if (isset($_GET['user'])) {
    $user = $_GET['user'];
    
    
    require("../BACK_END/connexion.php");
    $select = $conix->prepare("SELECT * FROM users WHERE CONCAT(username, fname, lname) LIKE ? AND username!=?");
    $select->execute(["%$user%",$_SESSION['username']]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript" src="js.js"></script>
    <style>
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
    </style>

</head>
<body>
<div class="container">
    <div class="navbar">
        <div class="menu">
            <a href="acceuil.php"class="logo h3 nav-link text-white">STUFFIE<span>Chat</span></a>
        
        </div>
    </div>
    <div class="main-container">
        <div class="main">
            <header>
                <div class="overlay">
                    <div class="inner">
                        <form action="" method="GET">
                            <div class="input-group w-50 mx-auto" style="margin-top:80px">
                                <input type="text" placeholder="Search..." name="user" class="form-control search me-2 w-50 mx-auto"  pattern=".*\S+.*" required>
                                <div class="input-group-prepend">
                                    <button type="submit" class="input-group-text search_btn p-3"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="container-fluid h-100 w-100  p-5 my-5 " >
                            <?php 
                            if (isset($user)) {
                                if ($select->rowCount() < 1) {
                                    echo "<p>There is no one</p>";
                                } else {
                                    while ($find = $select->fetch()) {
                                        $isFriend = false;
                                        $add=$find['username'];
                                        $friends = $conix->prepare("SELECT * FROM friendlist WHERE (username=? AND id_user = ?)  ");
                                        $friends->execute([$find['username'], $_SESSION["username"]]);
                                        if ($friends->rowCount() >= 1) {
                                            $isFriend = true;
                                        } ?>
                                        <div class="justify-content-between container-fluid ">
                                          <a  style="width:500px" class="d-flex nav-link text-light" href="friendprofile.php?idprofil=<?php echo $add ?>">
                              <img src="<?php echo $find['photo']?>" class="rounded-circle user_img me-4">
                            <h5 style="width=300px" class="mt-3"><?php echo $find['fname']."  ". $find['lname'] ?></h5>
                          </a>
                            
                             <div><a href="<?php echo($isFriend ? "search.php?user=$user" : "../BACK_END/addFriend.php?newfriend=$add") ?>"><img src="<?php echo($isFriend ? "images/accepted.png" : "images/add1.png") ?>" alt="" srcset="" style="width:40px;height:40px; margin:-120px -800px 0 0"></a></div>
                          </div>
                                      
                                    <?php }
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </header>
        </div>
    </div>
</div>

</body>
</html>
