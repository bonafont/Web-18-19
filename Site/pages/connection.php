<h1 style="text-align:center;">CONNEXION</h1>

<?php
  if(isset($_POST['login_submit'])){
    echo "<h1>Bonjour : ". $_POST["login"] . ", JVOUS BESE</h1>";
  }
  else{

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
?>
