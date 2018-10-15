
<div class="connection_layout">
<?php
if($successful_login != 1){
  ?>
  <?php if($successful_login == 0){
    echo "<h1 style=\"color:red;text-align:center;\"> ERREUR</h1>";
  }?>
  <form action="index.php?connection" method="post" class="connection">
      <h1 style="text-align:center;">CONNEXION</h1>
    <label style="color:red"><?php echo (isset($account_Err)) ? $account_Err : "&nbsp;" ;?></label>
    <label>Enter your Login :</label>
    <label style="color:red"><?php echo (isset($err_login)) ? $err_login : "&nbsp;" ;?></label>
    <input type="textbox" name="login"/>
    <label>Enter your Password :</label>
    <label style="color:red"><?php echo (isset($err_password)) ? $err_password : "&nbsp;" ;?></label>
    <input type="password" name="password"/>
    <input type="submit" name="login_submit" value="Login!"/>
    <a href="index.php?register">Vous n'avez de compte?</a>
  </form>
<?php
}
else{
  echo '<h1>Bonjour  '. $_SESSION['user']. ' !</h1>';
}
 ?>
</div>
