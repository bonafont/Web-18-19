<?php
  if(isset($_GET['favoris']) && isset($_SESSION['user'])){
    $favoris = $conn->real_escape_string($_GET['favoris']);
    $users = $conn->real_escape_string($_SESSION['user']);
    $sql = "SELECT name_cocktail FROM Favoris WHERE name_cocktail = '$favoris' AND user = '$users'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
      $sql = "DELETE FROM Favoris WHERE name_cocktail = '$favoris' AND user = '$users'";
      if (!($conn->query($sql) === TRUE)) {
        //ERREUR SUPPRESSION DANS LA BDD
        error_handling($conn->error);
      }
    }
    else{
      $sql = "INSERT INTO Favoris (user, name_cocktail) VALUES ('$users', '$favoris')";
      if (!($conn->query($sql) === TRUE)) {
        //ERREUR INSERTION DANS LA BDD
        error_handling($conn->error);
      }
    }
  }
  $favorites_list = array();
  if(isset($_SESSION['user'])){
    $users = $conn->real_escape_string($_SESSION['user']);
    $sql = "SELECT name_cocktail FROM Favoris WHERE user = '$users'";
    $result = $conn->query($sql);
    $index =0;
    while ($row = $result->fetch_assoc()) {
        $favorites_list[$index] = $row['name_cocktail'];
        $index++;
    }
  }
 ?>
