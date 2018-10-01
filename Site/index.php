<html>
<head>
  <link rel="stylesheet" text="text/css" href="style.css">
<title>Test</title>
</head>
<body>

<?php
/*

FONCTIONS POUR LA HIERARCHIE

*/
function test2($array, $value,$i){
    if(!empty($array[$value]["sous-categorie"])){ // si la ss-categorie n'est pas vide
      echo '<li><span>'.$value.'</span>';
      echo '<ul class="sub_menu_'.$i.'">';
      $i++;
    foreach ($array[$value]['sous-categorie'] as $key => $value) {
      test2($array,$value,$i);
    }
    echo '</ul></li>';
  }
  else{
    echo '<li><a href="index.php?ingredients='. $value .'">'.$value .'</a></li>';
  }
}
function test($array,$root){
      echo '<nav><ul class="nav">';
      $i = 0;
      foreach ($array[$root]['sous-categorie'] as $key => $value) { // elt de la ss-categorie
        test2($array,$value,$i);
      }
      echo '</ul></nav>';

}

require 'pages/data/Donnees.inc.php';
  $servername = "localhost";
  $username = "root";
  $password = "root";
  // Create connection
  $conn = new mysqli($servername, $username, $password);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  // Create database
  if ($conn->select_db('Cocktail') === FALSE) {

    if(!isset($_POST['submit'])){
      ?>
        <h1 style="text-align:center;">Le base de données COCKTAIL va être généree à l'aide du magnifique cours de PHP-MySQL conçu par le fameux NOURREDINE ZEJLI.</h1>
        <form action="" method="post" style="width:100%;text-align:center;">
        <input type="submit" name="submit" value="Prêt?"  />
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
      echo "<h1>La magie de Zejli vient d'operer !</h1>";
    }
    }
      else {
        // ERREUR CREATION DE LA BASE DE DONNÉES
        echo "Error creating database: " . $conn->error;
      }
  }
  else{
    // CODE HERE
    ?>
<div class="banner">
  <img class="logo" src="images/KACEDOCKTAILS_LOGO.png" alt="logo">
  <span class="moto">KACEDOCKTAILS</span>
</div>
<?php test($Hierarchie,'Aliment');?>


<div class="penis">
<?php
$sql = "SELECT * FROM Cocktail WHERE ingredients = '" . $conn->real_escape_string($_GET['ingredients']) ."'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      ?>
<div class="sexe">
    <div class="description">
  <span class="titre"><?php echo $row['titre'] ?></span>
  <span class="recette">
    <?php
      $recettes = explode('|',$row['recette'],-1);
      echo "<ul>";
      foreach($recettes as $recette){
        echo "<li>".$recette . "</li>";
      }
      echo "</ul>";

  ?>
  </span>
  <span class="preparation"><?php echo $row['preparation']?></span>
</div>
</div>
      <?php
    }
} else {
    echo "0 results";
}


?>
</div>
<?php
  }
  $conn->close();
?>
</body>
</html>
