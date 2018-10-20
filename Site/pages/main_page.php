<div class="vagin">
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
        echo "images/KACEDOCKTAILS_INTERROGATION.png";
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
      <span class="preparation"><?php echo descrstr($row['preparation'])?></span>

    </div>
    <a class="favoris" href="PENIS">
      <span>
      <span>Ajouter &agrave; vos favoris !</span>
    </span>
      <img src="images/Star.png"/>
  </a>
  </div>
<?php
      }
    } else {
      echo "Aucun Cocktail ne contient de " . $_GET['ingredients'];
      }
?>
</div>
</div>
