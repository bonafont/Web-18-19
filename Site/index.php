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
    test($Hierarchie,'Aliment');
    if(isset($_GET['connection']))
      require 'pages/connection.php';
    else
      require 'pages/main_page.php';
  }
  $conn->close();
?>
</body>
</html>
