<?php
session_start();
require("../BACK_END/connexion.php");

if (!isset($_SESSION['statu']) || $_SESSION['statu'] !== 1) {
  header("Location: login.php");
}

if (isset($_GET['msg'])) {
  echo $_GET['msg'];
}

$searchUser = isset($_GET['user']) ? $_GET['user'] : '';


?>

<!DOCTYPE html>
<html>

<head>
  <title>Chat</title>
  <link rel="stylesheet" href="bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
    integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
    crossorigin="anonymous">
  <script src="jquery-3.6.4.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src=".js.js"></script>
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
                  <div class="col-12 chat  h-100 ">
                    <div class="card mb-sm-3 mb-md-0 contacts_card omar">
                      <div class="card-header ">
                        <form action="" method="GET">
                          <div class="input-group my-3">
                            <input type="text" placeholder="Search..." name="user"  pattern=".*\S+.*" required class="form-control search mx-3"
                              style="height: 40px;">
                            <div class="input-group-prepend">
                              <button type="submit" class="input-group-text search_btn" style="height: 40px;"><i
                                  class="fas fa-search"></i></button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="card-body contacts_body mx-4">
                        <ul class="contacts">
                          <?php
                          $users = array();

                          if (isset($searchUser)) {
                            $select = $conix->prepare("SELECT * FROM friendlist WHERE CONCAT(username,fname,lname) LIKE ? AND id_user=? ");
                            $select->execute([$searchUser, $_SESSION["username"]]);
                            if ($select->rowCount() <1) {
                              echo "<p>There is no one</p>";
                            } else {
                              while ($find = $select->fetch()) {
                                $friends = $conix->prepare("SELECT * FROM friendlist WHERE (username=? AND id_user = ?)  ");
                                $friends->execute([$find['username'], $_SESSION["username"]]);
                                if ($friends->rowCount() >= 1) {
                                  $users[$lastMessageId] = array(
                                    'user' => $user,
                                    'message' => $lastMessage,
                                    'photo' => $photo
                                  );
                                }
                              }
                            }
                          } else {
                            $nbrFriends = $conix->prepare("SELECT * FROM friendlist WHERE id_user=?");
                            $nbrFriends->execute(array($_SESSION['username']));

                            $photo = "images/default.php";
                            while ($donnees = $nbrFriends->fetch()) {

                              $user = $donnees['username'];
                              $selphoto = $conix->prepare("SELECT * FROM users WHERE username=?");
                              $selphoto->execute(array($donnees['username']));
                              $photo = $donnees['photo'];

                              $lastMessageQuery = $conix->prepare("SELECT message FROM messages WHERE (id_auteur=? AND id_distinataire=?) OR (id_auteur=? AND id_distinataire=?) ORDER BY id_message DESC LIMIT 1");
                              $lastMessageQuery->execute(array($_SESSION['username'], $user, $user, $_SESSION['username']));
                              $lastMessage = $lastMessageQuery->fetchColumn();

                              $lastMessageIdQuery = $conix->prepare("SELECT id_message FROM messages WHERE (id_auteur=? AND id_distinataire=?) OR (id_auteur=? AND id_distinataire=?) ORDER BY id_message DESC LIMIT 1");
                              $lastMessageIdQuery->execute(array($_SESSION['username'], $user, $user, $_SESSION['username']));
                              $lastMessageId = $lastMessageIdQuery->fetchColumn();

                              $users[$lastMessageId] = array(
                                'user' => $user,
                                'message' => $lastMessage,
                                'photo' => $photo
                              );
                            }
                          }

                          krsort($users);

                          foreach ($users as $lastMessageId => $userData) {
                            $user = $userData['user'];
                            $lastMessage = $userData['message'];
                            $pp = $userData['photo'];

                            // Check if the current user matches the search query
                            if (!empty($searchUser) && strpos(strtolower($user), strtolower($searchUser)) === false) {
                              continue; // Skip this user if it doesn't match the search query
                            }
                          ?>
                            <li class="active">
                              <div class="d-flex bd-highlight mx-3">
                                <div class="img_cont">
                                  <img src="<?php echo $pp; ?>" class="rounded-circle user_img">
                                  <span class="online_icon"></span>
                                </div>
                                <div class="user_info">
                                  <span><?php echo $user; ?></span>
                                  <p><?php echo $lastMessage; ?></p>
                                </div>
                              </div>
                            </li>
                          <?php
                          }
                          ?>
                        </ul>
                        <div class="card-body msg_card_body">
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
          <a href="profile.php" style="--i: 0.1s;">PROFILE</a>
        </li>
        <li>
          <a href="../BACK_END/sedeconnecter.php" style="--i: 0.1s;">Se deconnecter</a>
        </li>

      </ul>
    </div>
  </div>

  <script src="app.js"></script>

</body>

</html>

