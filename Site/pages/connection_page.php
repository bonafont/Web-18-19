

<?php
if($form_disappear_status == 0){
  ?>
  <h1 style="text-align:center;">CONNEXION</h1>
  <form action="index.php?connection" method="post" class="connection">
    <label>Enter your Login :</label>
    <input type="textbox" name="login"/>
    <label>Enter your Password :</label>
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
