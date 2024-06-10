<?php
    // nom serveur
    $serverName = "localhost";
    // identifant
    $username = "root";
    // mot de passe
    $password = "root";

    try
    {
        $connector = new PDO('mysql:host='.$serverName.';dbname=db_inoweeks;charset=utf8' , $username, $password);
    }
    catch (PDOException $e)
    {
        die('Erreur : ' . $e->getMessage());
    }
?>








