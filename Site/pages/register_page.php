<div class="connection_layout">
<?php
if($error_register_form ==1){
  ?>
  <h1 style="color:red;">ERROR</h1>
  <?php
}
if($successful_registration ==1){
  ?><h1>Compte crée</h1>
  <?php
}
else{

?>
<form action="index.php?register" method="post" class="connection">
  <label>Entrer votre Pseudo :</label>
  <input type="textbox" name="username"/>
  <label>Enter votre Mot de passe :</label>
  <input type="password" name="password"/>
  <input type="submit" name="register_submit" value="Envoyer!"/>
</form>
<?php } ?>
</div>
