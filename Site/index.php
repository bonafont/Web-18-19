<?php
  require 'pages/error.php';
  require 'pages/data/Donnees.inc.php';
  session_start();
  $servername = "localhost";
  $username = "root";
  $password = "";
  // Create connection
  $conn = new mysqli($servername, $username, $password);
  // Check connection
  if ($conn->connect_error) {
    error_handling($conn->connect_error);
  }
  if (!$conn->set_charset("utf8")) {
    error_handling("Error loading character set utf8: %s\n" . $conn->error);
  }
  // Create database
  if ($conn->select_db('Cocktail') === FALSE) {
    include 'pages/install.php';
  }
  else{
    require 'pages/favorites.php';
    require 'pages/functions.php';
    require 'pages/Header.php';
    require 'pages/connection.php';
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
  include 'pages/Footer.php';
?>
