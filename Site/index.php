<?php
  require 'pages/functions.php';
  require 'pages/data/Donnees.inc.php';
  require 'pages/error.php';
  require 'pages/Header.php';
  $servername = "localhost";
  $username = "root";
  $password = "root";
  // Create connection
  $conn = new mysqli($servername, $username, $password);
  // Check connection
  if ($conn->connect_error) {
    error_handling($conn->connect_error);
  }
  // Create database
  if ($conn->select_db('Cocktail') === FALSE) {
    require 'pages/install.php';
  }
  else{
    // CODE HERE
      set_header();
    ?>
<div class="banner">
  <img class="logo" src="images/KACEDOCKTAILS_LOGO.png" alt="logo">
  <span class="moto">KACEDOCKTAILS</span>
</div>

<?php test($Hierarchie,'Aliment');?>

<div class="penis">
<?php
if(empty($_GET['ingredients'])){
  $sql = "SELECT * FROM Cocktail GROUP BY titre";
}
else{
  $sql = "SELECT * FROM Cocktail WHERE ingredients = '" . $conn->real_escape_string($_GET['ingredients']) ."'";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      ?>
  <div class="sexe">
    <div class="description">
      <span class="titre"><?php echo $row['titre'] ?></span>
      <img src="<?php
      $photostr = photostr($row['titre']);
      $photostr = "assets/Photos/". $photostr.".jpg";
      if(file_exists($photostr)){
        echo $photostr;
      }
      else{
        echo "images/KACEDOCKTAILS_LOGO.png";
      }?>" class="photos"/>
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
      echo "Aucun Cocktail ne contient de " . $_GET['ingredients'];
      }
?>
</div>
<?php
  }
  $conn->close();
?>
</body>
</html>
