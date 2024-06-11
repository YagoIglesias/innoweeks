<?php
  // session  
  session_start();
  // blocker accese si on est pas loguer
  include("../php/block.php");
  // connexion db
  include ('../php/connexion.php');
  // numero avs de la personne connecter
  $numeroAVS = $_SESSION['numeroAVS']; 

?>