<h1 style="text-align:center;">CONNEXION</h1>

<?php
if($form_disappear == 0){
  ?>
  <form action="index.php?connection" method="post" class="connection">
    <label>Enter your Login :</label>
    <input type="textbox" name="login"/>
    <label>Enter your Password :</label>
    <input type="password" name="password"/>
    <input type="submit" name="login_submit" value="Login!"/>
  </form>
<?php
}
else{
  echo '<h1>Bonjour ! '. $_SESSION['user'];
}
 ?>
