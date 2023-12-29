<?php
session_start();
require("../BACK_END/connexion.php");


if (!isset($_SESSION['statu']) || $_SESSION['statu'] !== 1) {
    header("Location:login.php");
}
else{

  
  if (isset($_GET['id_distinatire']) && !empty($_GET['id_distinatire'])) {
  $idprofil=$_SESSION['username'];
    $getid = $_GET['id_distinatire'];
    $recupUser = $conix->prepare('SELECT * FROM friendlist WHERE username=?');
    $recupUser->execute(array($getid));
    $photoprofil = $conix->prepare('SELECT * FROM users WHERE username=?');
    $photoprofil->execute(array($_SESSION["username"]));
    $profilphoto=$photoprofil->fetch();

    if ($recupUser->rowCount() > 0) {
        if (isset($_POST['envoyer'])) {
            $message = htmlspecialchars($_POST['message']);
            $insertMessage = $conix->prepare('INSERT INTO messages (message,id_distinataire,id_auteur) VALUES (?, ?, ?)');
            $insertMessage->execute(array($message, $getid, $_SESSION['username'])); 
            header("Location: message.php?id_distinatire=$getid");
            exit();
        }  
    } else {
        echo "Aucun utilisateur trouvé";
    }
} else {
header("location:acceuil.php");
}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Chat</title>
		<link rel="stylesheet" href="bootstrap.min.css" >
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
a {
      text-decoration: none;
    }

    </style>
	</head>
  <body>
    <div class="container">
      <div class="navbar ">
        <div class="menu">
        <a href="acceuil.php" class="logo h3 nav-link text-white">STUFFIE<span>Chat</span></a>
          <div class="hamburger-menu">
            <div class="bar"></div>
          </div>
        </div>
      </div>

      <div class="main-container">
        <div class="main">
          <header>
            <div class="overlay">
              <div class="inner">
                <div class="container-fluid h-100 w-100  p-3 ">
                  <div class="row justify-content-between h-100">
                    <div class="col-md-4 col-xl-3 chat  h-100 ">
                      <div class="card mb-sm-3 mb-md-0 contacts_card omar ">
                      <div class="card-header ">
                        <!-- <div class="input-group">
                          <form action="" class="d-flex">
                          <input type="text" placeholder="Search..." name="" class="form-control search me-2">
                          <div class="input-group-prepend">
                            <span class="input-group-text search_btn p-3"><i class="fas fa-search"></i></span>
                          </div>
                          </form>
                        </div> -->
                        <p class="text-white">online friends</p>
                      </div>
                      <div class="card-body contacts_body ">
                        <?php
                            $getid = $_GET['id_distinatire'];
                            $recupUser = $conix->prepare('SELECT * FROM friendlist WHERE id_user=?');
                            $recupUser->execute(array($_SESSION['username']));

                            if($recupUser->rowCount() <= 0){
                                     header("location:acceuil.php");
                            }else{
                            
                          
                            
                            while ($friend = $recupUser->fetch()) {
                                
                                   
                            ?>
                            <ul class="contacts">
                              <li class="active">
                                <div class="d-flex bd-highlight">
                                  <div class="img_cont">
                                  <a href="../BACK_END/profileAction.php?idprofil=<?php echo $friend['username']?>"><img src="<?php  echo $friend['photo']?>" class="rounded-circle user_img"></a>
                                    <?php if( $friend['statu']==1) {?>
                                      <span class="online_icon"></span>
                                      <?php }else{ ?>
                                        <span class="online_icon offline"></span>
                                      <?php }?>
                                  </div>
                                  <div class="user_info">
                                    <span class="h6"><?php echo $friend['fname']." ".$friend['lname']?></span>
                                    <?php if( $friend['statu']==1) {?>
                                    <p class="h6"><?php echo $friend['fname']?> is online</p>
                                    <?php }else{ ?>
                                      <p><?php echo $friend['fname']?> is offline</p>
                                      <?php }?>
                                  </div>
                                </div>
                              </li>
                              <?php } ?>
                       
                      </div>
                      <div class="card-footer"></div>
                    </div></div>
                    <div class="col-md-8 col-xl-9 chat" >
                      <div class="card omar">
                        <div class="card-header msg_head">
                          <div class="d-flex bd-highlight">
                            <div class="img_cont">
                            <?php
                            $getid = $_GET['id_distinatire'];
                            $recupUser = $conix->prepare('SELECT * FROM friendlist WHERE username=? and id_user=?');
                            $recupUser->execute(array($getid,$_SESSION['username']));
                            
                          
                            
                            while ($friend = $recupUser->fetch()) {
                                
                                   
                            ?>
                              <img src="<?php  echo $friend['photo']?>" class="rounded-circle user_img">
                              <?php if( $friend['statu']==1) {?>
                                      <span class="online_icon"></span>
                                      <?php }else{ ?>
                                        <span class="online_icon offline"></span>
                                      <?php }?>
                                      <?php } ?>

                            </div>
                            <div class="user_info">
                              <span><?php echo $getid ?></span>
                              <?php 
        $recupMessages = $conix->prepare('SELECT * FROM messages WHERE (id_auteur=? AND id_distinataire=?) OR (id_auteur=? AND id_distinataire=?)');
        $recupMessages->execute(array($_SESSION['username'], $getid, $getid, $_SESSION['username']));
        $nummessage=$recupMessages->rowCount()
        ?>
                              <p><?php echo $nummessage. " messages"?></p>
                            </div>
                        
                          </div>
                          <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                          <div class="action_menu">
                            <ul>
                              <li><a href="../BACK_END/profileAction.php?idprofil=<?php echo $getid ?>" class="text-white"><i class="fas fa-user-circle"></i> View profile</a></li>
                            </ul>
                          </div>
                        </div>
                        <div class="card-body msg_card_body " id="message-container" >
                              <section id="message">
        <?php 
        $recupMessages = $conix->prepare('SELECT * FROM messages WHERE (id_auteur=? AND id_distinataire=?) OR (id_auteur=? AND id_distinataire=?)');
        $recupMessages->execute(array($_SESSION['username'], $getid, $getid, $_SESSION['username']));
        
        while ($message = $recupMessages->fetch()) {
            if ($message['id_distinataire'] == $_SESSION['username']) {
                
                       
                            $getid = $_GET['id_distinatire'];
                            $recupUser = $conix->prepare('SELECT * FROM friendlist WHERE username=? and id_user=?');
                            $recupUser->execute(array($getid,$_SESSION['username']));
                            
                          
                            
                            $friend = $recupUser->fetch() 
                                
                                   
                            ?>
             
          
    </section>
                          <div class="d-flex justify-content-start mb-4">
                            <div class="img_cont_msg">
                              <img src="<?php  echo $friend['photo']?>" class="rounded-circle user_img_msg">
                            </div>
                            <div class="msg_cotainer">
                            <?= $message['message'];?>
                            </div>
                          </div>
                          <?php
            } elseif ($message['id_distinataire'] == $getid) {
                ?>
                          <div class="d-flex justify-content-end mb-4">
                            <div class="msg_cotainer_send">
                            <?= $message['message'];?>
                            </div>
                            <div class="img_cont_msg">
                          <img src="<?php  echo $profilphoto['photo']?>" class="rounded-circle user_img_msg">
                            </div>
                          </div>
                          <?php
            }
        }
        ?>
                            <form action="" method="POST" class="w-100 pe-3 " >
                        <div class="card-footer">
                          <div class="input-group ">

                            <input name="message" class="form-control type_msg me-2" placeholder="Type your message..." type="text"  pattern=".*\S+.*" required>
                            <div>
                              <button type="submit" name="envoyer" class=" send_btn p-3 rounded-circle" ><i class="fas fa-location-arrow "></i></button>
                            </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </header>
        </div>
        <?php }?>

        <div class="shadow one"></div>
      </div>

      <div class="links">
        <ul>
          <li>
            <a href="acceuil.php" style="--i: 0.05s;">Home</a>
          </li>
          <li>
            <a href="search.php" style="--i: 0.05s;">Add new friend</a>
          </li>

          <li>
          <a href="../BACK_END/profileAction.php?idprofil=<?php echo $idprofil ?>" style="--i: 0.1s;">PROFILE</a>
          </li>
          <li>
            <a href="../BACK_END/sedeconnecter.php" style="--i: 0.1s;">Se deconnecter</a>
          </li>
        
        </ul>
      </div>
    </div>

    <script src="app.js"></script>
    <script>
  document.addEventListener("DOMContentLoaded", function() {
    var container = document.getElementById('message-container');
    container.scrollTop = container.scrollHeight;
  });
</script>



  </body>
</html>