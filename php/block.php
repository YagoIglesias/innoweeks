<?php
if(!isset($_SESSION["logged_in"]))
{
  header('Location: ../html/login.html');
}

?>