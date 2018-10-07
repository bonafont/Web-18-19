<?php

function connect_link(){
  if(isset($_SESSION['user']))
    echo '<a href="index.php?deconnection">Se deconnecter</a>';
  else
    echo '<a href="index.php?connection">Se connecter</a>';
}

/*
    DECONNECTION LOGOUT PROCEDURE
*/
if(isset($_SESSION['user']) && isset($_GET['deconnection'])){
      setcookie("user", "", time() - 3600,"/");
      session_destroy();
      header('Location: index.php?deconnection');
      exit;
}





/*
    CONNECTION LOGIN PROCEDURE
*/
$form_disappear_status = 1;
  if(!isset($_SESSION['user'])){
      $form_disappear_status = 0;
      if(isset($_POST['login_submit'])){
        $cookie_name = "user";
        $cookie_value = $_POST['login'];
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        $_SESSION['user'] = $_POST['login'];
        $form_disappear_status = 1;
      }
      elseif(isset($_COOKIE['user'])){
        $_SESSION['user'] = $_COOKIE['user'];
        $form_disappear_status = 1;
      }
  }
 ?>
