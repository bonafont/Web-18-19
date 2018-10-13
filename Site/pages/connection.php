<?php

function connect_link(){
  if(isset($_SESSION['user']))
    echo '<a href="index.php?deconnection">Se deconnecter</a>';
  else
    echo '<a href="index.php?connection">Se connecter</a>';
}

/*
  REGISTER PROCEDURE
*/
$succesful_registration =0;
if(isset($_GET['register'])){
  if(isset($_POST['register_submit'])){
    $error_register_form = 0;
    if(empty($_POST['username'])){
      $error_register_form = 1;
    }
    if(empty($_POST['password'])){
      $error_register_form = 1;
    }
    if($error_register_form == 0){
      $username = $conn->real_escape_string($_POST['username']);
      $password = $conn->real_escape_string($_POST['password']);
      $sql = "INSERT INTO Users (name, password) VALUES ('". $username ."', '". $password ."')";
      if (!($conn->query($sql) === TRUE)) {
        //ERREUR INSERTION DANS LA BDD
        error_handling($conn->error);
      }
      else{
        $succesful_registration =1;
      }
    }
  }
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

  /*
      DECONNECTION LOGOUT PROCEDURE
  */
  if(isset($_SESSION['user']) && isset($_GET['deconnection'])){
        setcookie("user", "", time() - 3600,"/");
        session_destroy();
        header('Location: index.php?deconnection');
        exit;
  }
 ?>
