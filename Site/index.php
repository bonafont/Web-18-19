<?php
  session_start();
  require 'pages/functions.php';
  require 'pages/data/Donnees.inc.php';
  require 'pages/error.php';
  require 'pages/Header.php';
  require 'pages/connection.php';
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
    include 'pages/install.php';
  }
  else{
    set_header();
    navbar($Hierarchie,'Aliment');
    if(isset($_GET['connection']))
      include 'pages/connection_page.php';
    elseif(isset($_GET['deconnection']))
      include 'pages/deconnection_page.php';
    elseif(isset($_GET['register']))
      include 'pages/register_page.php';
    else
      include 'pages/main_page.php';

  }
  $conn->close();
?>
</body>
</html>
