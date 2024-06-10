<?php
  // session  
  session_start();
  // blocker accese si on est pas loguer
  include("../php/block.php");
  // connexion db
  include ('../php/connexion.php');
  // numero avs de la personne connecter
  $numeroAVS = $_SESSION['numeroAVS']; 
  // addition du co2 par voyage
  $result = 0;

  // requete pour recuperer le cout en co2 de la personne 
  $quotaUtilise = $req = $connector->query("SELECT `voyCoutCO2` FROM `t_voyage` WHERE `numeroAVS` LIKE '$numeroAVS'");
  // parrcourir le resultat de la requete 
  foreach($quotaUtilise as $quot)
  {
    // stocker la valeur 
    $finquot = $quot['voyCoutCO2'];
    // additioner la valeur 
    $result = $result + $finquot;
  }

  // requete pour recupere le quota max par personne
  $quotadisponible = $connector->query("SELECT `perQuotaDisponible` FROM `t_person` WHERE `numeroAVS` LIKE '$numeroAVS'");
  // parrcourir le tableau du resultat de la requete
  foreach($quotadisponible as $maxquot){
    // quota disponible
    $max = $maxquot['perQuotaDisponible'];
  }

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Page d'accueil - Swiss Carbon Footprint</title>
    <link rel="stylesheet" href="../css/accueil.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <header>
      <h1><a class= "headerA" href="../html/login.html"> Swiss Carbon Footprint</a></h1>
      <img
        src="../ressources/Images/confederation.png"
        alt="confederation-logo"
        class="confederation-logo"
      />
    </header>
    <main>
      <div class="main-container">
        <h2>Voici la barre de progression de votre quota de CO2</h2>
        <label for="file"><?php echo $result;?></label>
        <progress id="file" max=<?php echo $max;?>value=<?php echo $result;?>></progress>
        <label for="file">4000</label>
      </div>
    </main>
    <footer>
      <div class="copyright">
        <p>
          Copyright © 2024 - Tous droits réservés.
          <a href=""
            ><strong>Mentions légales / Conditions Générales </strong></a
          >
        </p>
      </div>
      <div class="contact-footer">
        <a href="https://www.admin.ch/gov/fr/accueil/service/contacts.html">
          Contacts
        </a>
      </div>
    </footer>
  </body>
</html>