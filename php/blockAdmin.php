<?php
if(!isset($_SESSION["logged_in"]))
{
  header('Location: ../html/admin.html');
}

?>