<?php
if(!isset($_POST['install_submit'])){
?>
  <html>
    <head>
      <title>Initialisation de la base de donnée COCKTAIL</title>
    </head>
  <body>
    <form action="" method="post" style="display:flex;align-items:center;justify-content:center;flex-flow:column;height:100%;margin:0;text-align:center;">
        <u><h1>Le base de données COCKTAIL va être générée à l'aide du magnifique cours de PHP-MySQL conçu par le fameux NOURREDINE ZEJLI.</h1></u>
        <h3>Ce script va générée une table appelé Cocktail, Veuillez être sûr que cette table n'existe pas.<br>Normalement ce script est conçu pour marcher parfaitement avec easyPHP mais si ce n'est pas le cas, veuillez vérifier que les identifiants suivant sont bien existant dans votre base de donnée :</h3>
        <h2>Identifiant: root<br>Mot de passe : root</h2>
        <input type="submit" name="install_submit" value="Prêt?"  />
    </form>


<?php
  $conn->close();
  exit(0);
}
/*

CREATION DE LA BASE DE DONNÉES COCKTAIL

*/
if($conn->query("CREATE DATABASE Cocktail") === TRUE){
  echo "Database created successfully<br>";
  if(($conn->select_db('Cocktail') === FALSE)){
    //SI LA BASE
  echo "Cannot access Database" . $conn->error;
  exit(-1);
  }
  else{
    $conn->query("SET NAMES UTF8");
    /*

      CREATION DE LA TABLE COCKTAIL

    */
    $sql = "CREATE TABLE Cocktail (
                  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  titre TEXT NOT NULL,
                  recette TEXT NOT NULL,
                  preparation TEXT NOT NULL,
                  ingredients TEXT NOT NULL

          )";
    if($conn->query($sql) !== TRUE){
      /*

      ERREUR CREATION DE LA TABLE COCKTAIL

      */
      echo "Error creating table Cocktail: " . $conn->error;
      exit(-1);
    }
    echo "Table Cocktail created successfully<br>";

    /*
    INSERTION DES COCKTAILS DANS LA TABLE COCKTAIL
    */
    foreach ($Recettes as $cocktail) {
      $titre = $conn->real_escape_string($cocktail['titre']);
      $preparation = $conn->real_escape_string($cocktail['preparation']);
      $recette = $conn->real_escape_string($cocktail['ingredients']);
      foreach($cocktail['index'] as $index){
        $titre = $conn->real_escape_string($cocktail['titre']);
        $ingredients = $conn->real_escape_string($index);
        $sql = "INSERT INTO Cocktail (titre, recette , ingredients, preparation) VALUES ('" .$titre . "','". $recette."','". $ingredients."','".$preparation . "')";
        if (!($conn->query($sql) === TRUE)) {
          //ERREUR INSERTION DANS LA BDD
          echo "Error: " . $sql . "<br>" . $conn->error;
          exit(-1);
        }
      }
    }

    /*

    CREATION DE LA TABLE USERS


    */
    $sql = "CREATE TABLE Users (
                  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  name TEXT NOT NULL,
                  password TEXT NOT NULL
          )";
    if($conn->query($sql) !== TRUE){
    /*

    ERREUR CREATION DE LA TABLE USERS

    */
      echo "Error creating table Users: " . $conn->error;
      exit(-1);
    }
    $sql = "CREATE TABLE Favoris (
                  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                  titre TEXT NOT NULL,
                  user TEXT NOT NULL
          )";
    if($conn->query($sql) !== TRUE){
    /*

    ERREUR CREATION DE LA TABLE USERS

    */
      echo "Error creating table Favoris: " . $conn->error;
      exit(-1);
    }
    header("Location: index.php");
}
}
  else {
    // ERREUR CREATION DE LA BASE DE DONNÉES
    echo "Error creating database: " . $conn->error;
  }
  ?>
