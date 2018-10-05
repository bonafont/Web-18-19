<?php
  $form_disappear = 0;
  if(isset($_POST['login_submit'])){
    $cookie_name = "user";
    $cookie_value = $_POST['login'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    session_start();
    $_SESSION['user'] = $_POST['login'];
    $form_disappear = 1;
  }
  elseif(isset($_COOKIE['user'])){
    session_start();
    $_SESSION['user'] = $_COOKIE['user'];
    $form_disappear = 1;
}
 ?>
