<?php

function connect_link(){
  if(isset($_SESSION['user'])){
    ?>
      <span>Mon compte</span>
      <ul>
        <li><a href="index.php?favoris_nav">Mes Favoris</a></li>
        <li><a href="index.php?deconnection">Se deconnecter</a></li>
      </ul>
      <?php
  }
  else{
    echo '<a href="index.php?connection">Se connecter</a>';
  }
}

/*
  REGISTER PROCEDURE
*/
if(isset($_GET['register'])){
  $successful_registration =0;
  if(isset($_POST['register_submit'])){
    $error_register_foconnect_linkrm = 0;
    if(empty($_POST['username'])){
      $error_register_form = 1;
    }
    if(empty($_POST['password'])){
      $error_register_form = 1;
    }
    $username = $conn->real_escape_string($_POST['username']);
    $sql = "SELECT name FROM Users WHERE name = BINARY '$username'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $error_register_form = 1;
    }
    if($error_register_form == 0){
      $password = $conn->real_escape_string(password_hash($_POST['password'], PASSWORD_DEFAULT));
      $sql = "INSERT INTO Users (name, password) VALUES ('$username', '$password')";
      if (!($conn->query($sql) === TRUE)) {
        //ERREUR INSERTION DANS LA BDD
        error_handling($conn->error);
      }
      else{
        $successful_registration =1;
      }
    }
  }
}




/*
    LOGIN PROCEDURE

    $successful_login
    0 : Erreur dans la tentative de connection
    1 : La tentative a été un succès
    2 : 1ère tentative de connexion, pas d'erreur à afficher

*/
$successful_login = 2;
  if(!isset($_SESSION['user'])){
      if(isset($_POST['login_submit'])){

        $successful_login = 1;  //on assume que cette tentative est la bonne
        if(empty($_POST['login'])){
          //Le champ login est vide
          $err_login = "Le champ login est vide !";
          $successful_login = 0;
        }
        if(empty($_POST['password'])){
          //Le champ mot de passe est vide
          $successful_login = 0;
          $err_password = "Vous n'avez pas entré de mot de passe !";
        }
        if($successful_login == 1){ //si les champ ne sont pas correctement rempli pas nécessaire de continuer
          $login = $conn->real_escape_string($_POST['login']);
          $password = $conn->real_escape_string($_POST['password']);
          $sql = "SELECT name,password FROM Users WHERE name = BINARY '$login'";
          $result = $conn->query($sql);
          if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            if(!password_verify($password,$row['password'])){
              // Le mot de passe est erroné
              $successful_login = 0;
              $account_Err= "Le mot de passe est érroné !";
            }
          }
          else{
            //Le compte n'existe pas
            $successful_login = 0;
            $account_Err= "Le compte n'existe pas !";
          }
          if($successful_login == 1){
            //Creation du cookie
            $cookie_name = "user";
            $cookie_value = $_POST['login'];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
            $_SESSION['user'] = $_POST['login'];
          }
        }
      }
      elseif(isset($_COOKIE['user'])){
        $_SESSION['user'] = $_COOKIE['user'];
        $successful_login = 1;
      }
  }
  else{
    $successful_login = 1;
  }

  /*
      LOGOUT PROCEDURE
  */
  if(isset($_SESSION['user']) && isset($_GET['deconnection'])){
        setcookie("user", "", time() - 3600,"/");
        session_destroy();
        header('Location: index.php?deconnection');
        exit;
  }
 ?>
