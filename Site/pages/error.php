
<?php
function error_handling($error){
  ?>
  <html>
    <head>
      <title>Erreur connection !</title>
    </head>
    <body>
      <?php
  if(preg_match('/Access denied/',$error)){
    ?>
    <h1>La connection vers la base de donnée n'a pas pu être établi, veuillez vérifier les identifiants.</h1>
    <h3>Veuillez vérifier que les identifiants suivant sont bien existant dans votre base de donnée :</h3>
    <h2>Identifiant: root<br>Mot de passe : root</h2>
    <?php
  }
  ?>
</body>
</html>
<?php
die("Connection failed: " . $error);
}
?>
