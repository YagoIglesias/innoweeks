<?php
  // session  
  session_start();
  // blocker accese si on est pas loguer
  include("../php/blockAdmin.php");
  // connexion db
  include ('../php/connexion.php');
  // numero avs de la personne connecter
  $numeroAVS = $_GET['numeroAVS'];
  $lieuDepart = $_GET['aerodep'];
  $lieuArrive = $_GET['aeroarr'];
  $dateDepart = $_GET['datedep'];
  $dateArrive = $_GET['datearr'];
  $motif = $_GET['motif'];
  $coutCO2 = $_GET['coutco2'];
  
  // addition du co2 par voyage
  $totalCo2Used = 0;
  $co2remaining = 0;

  // requete pour recuperer le cout en co2 de la personne 
  $quotaUtilise = $req = $connector->query("SELECT `voyCoutCO2` FROM `t_voyage` WHERE `numeroAVS` LIKE '$numeroAVS'");
  // parrcourir le resultat de la requete 
  foreach($quotaUtilise as $quot)
  {
    // stocker la valeur 
    $finquot = $quot['voyCoutCO2'];
    // additioner la valeur 
    $totalCo2Used = $totalCo2Used + $finquot;
  }

  // requete pour recupere le quota max par personne
  $result = $connector->query("SELECT * FROM `t_person` WHERE `numeroAVS` LIKE '$numeroAVS'");
  // parrcourir le tableau du resultat de la requete
  foreach($result as $row){
    // quota disponible
    $max = $row['perQuotaDisponible'];
    $nom = $row['perNom'];
    $prenom = $row['perPrenom'];
  }

  $co2remaining = $max - $totalCo2Used;

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
      <div class="logo">
        <img
        src="../ressources/Images/confederation.png"
        alt="confederation-logo"
        class="confederation-logo"
        />
        <h1><a class= "headerA" href="../php/admin.php"> Swiss Carbon Footprint</a></h1>
      </div>
    </header>
    <main>
      <section class="historique">
        <h2>Voyages effectués de <?php echo $nom .' '. $prenom;?> </h2>

        <?php

          $table = $connector->query("SELECT * FROM `t_voyage` WHERE `numeroAVS` LIKE '$numeroAVS'");

          $date_string = null;
          
          
          // checker si il y a des voyages
          if($table->rowCount() == 0){
            echo "Vous n'avez pas effectue de voyage";
          }
          else{
            echo "<table>";
            echo "<tr>";
            echo "<th>Lieu de départ  </th>";
            echo "<th>Lieu d'arrivée </th>";
            echo "<th class='datedepart'>Date de départ  </th>";
            echo "<th class='datearrivee'>Date d'arrivée  </th>";
            echo "<th class='motif'>Motif  </th>";
            echo "<th class='coutco2'>Coût CO2  </th>";
            echo "</tr>";
            foreach($table as $row)
            {
              // voyages
              echo "<tr>";
              echo "<td>".$row["voyDepart"]."</td>";
              echo "<td>".$row["voyArrive"]."</td>";
              $date_string = $row["voyDateDepart"];
              $date = new DateTime($date_string,new DateTimeZone('UTC'));
              $new_format = $date->format('m/d/Y H:i');
              echo "<td class='datedepart'>".$new_format."</td>";
              $date_string = $row["voyDateArrive"];
              $date = new DateTime($date_string,new DateTimeZone('UTC'));
              $new_format = $date->format('m/d/Y H:i');
              echo "<td class='datearrivee'>".$new_format."</td>";
              echo "<td class='motif'>".$row["voyMotif"]."</td>";
              echo "<td class='coutco2'>".$row["voyCoutCO2"]."</td>";
              echo "</tr>";
            }
            echo "</table>";  
        }
        ?>
        <p style="text-align:end;margin-right:35px;font-size:28px">C02 Restant<strong><?php echo ' '.$co2remaining;?></strong> <p>

        <h2>Voyage demandé</h2>
        <?php
            $table = $connector->query("SELECT * FROM `t_voyage` WHERE `numeroAVS` LIKE '$numeroAVS'");
            $date_string = null;
            // checker si il y a des voyages
            if($table->rowCount() == 0){
                echo "Vous n'avez pas effectue de voyage";
            }
            else{
                echo "<table>";
                echo "<tr>";
                echo "<th>Lieu de départ  </th>";
                echo "<th>Lieu d'arrivée </th>";
                echo "<th class='datedepart'>Date de départ  </th>";
                echo "<th class='datearrivee'>Date d'arrivée  </th>";
                echo "<th class='motif'>Motif  </th>";
                echo "<th class='coutco2'>Coût CO2  </th>";
                echo "</tr>";
                // voyages
                echo "<tr>";
                echo "<td>".$lieuDepart."</td>";
                echo "<td>".$lieuArrive."</td>";
                $date_string = $dateDepart;
                $date = new DateTime($date_string,new DateTimeZone('UTC'));
                $new_format = $date->format('m/d/Y H:i');
                echo "<td class='datedepart'>".$new_format."</td>";
                $date_string = $dateArrive;
                $date = new DateTime($date_string,new DateTimeZone('UTC'));
                $new_format = $date->format('m/d/Y H:i');
                echo "<td class='datearrivee'>".$new_format."</td>";
                echo "<td class='motif'>".$motif."</td>";
                echo "<td class='coutco2'><strong>".$coutCO2."</strong></td>";
                echo "</tr>";
                echo "</table>";  
            }
        
        ?>

      </section>

    </main>
    <footer>
      <div class="copyright">
        <p>
          Copyright © 2024 - Tous droits réservés.
        </p>
      </div>
      <div class="contact-footer">
        <a href="https://www.admin.ch/gov/fr/accueil/service/contacts.html">
          <strong> Contacts </strong> 
        </a>
      </div>
    </footer>
  </body>
</html>
