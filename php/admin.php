<?php
  // session  
  session_start();
  // blocker accese si on est pas loguer
  include("../php/blockAdmin.php");
  // connexion db
  include ('../php/connexion.php');
  // numero avs de la personne connecter
  $numeroAVS = $_SESSION['numeroAVS']; 

  date_default_timezone_set("Europe/Zurich");
  $currentDate = date('Y-m-d\TH:i'); 


?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Saisie de voyages - Swiss Carbon Footprint</title>
    <link rel="stylesheet" href="../css/admin.css" />
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
        <h1><a class= "headerA"> Swiss Carbon Footprint</a></h1>
      </div>
      <button class="deconnexion" type="button" onclick="location.href='../php/logoutAdmin.php'">Déconnexion</button>
    </header>
    <main>
      <section class="formulaire">
        <h2>Formulaire de voyages</h2>
          <form action="../php/insertTravel.php" method="post">
            <div class="box-username">
              <label for="numeroAVS"> N° AVS </label>
              <input
                type="text"
                id="numeroAVS"
                name="numeroAVS"
                pattern="756\.[0-9]{4}\.[0-9]{4}\.[0-9]{2}"
                title="Format attendu : 756.1234.1234.12"
                maxlength="16"
                placeholder="756.4567.891.23"
                required
              />
            </div>

            <div class="container">
              <div class="box-lieuDepart">
                <label for="lieuDepart">Aéroport de départ </label>
                <input
                  type="text"
                  id="lieuDepart"
                  name="lieuDepart"
                  placeholder="Genève(GVA)"
                  pattern="^[A-Z](.)+[\(A-Z\)]{3,}[^\d]?"
                  title="Format attendu : Nom de l'aéroport(IATA)"
                  required
                />
              </div>
  
              <div class="box-lieuArrive">
                <label for="lieuArrive">Aéroport d'arrivée </label>
                <input
                  type="text"
                  id="lieuArrive"
                  name="lieuArrive"
                  placeholder="San Sebastian(EAS)"
                  pattern="^[A-Z](.)+[\(A-Z\)]{3,}[^\d]?"
                  title="Format attendu : Nom de l'aéroport(IATA)"
                  required
                />
              </div>
            </div>

            <div class="container">
              <div class="box-dateDepart">
                <label for="dateDepart">Date de départ </label>
                <input
                  type="datetime-local"
                  id="dateDepart" 
                  name="dateDepart"
                  value="<?php echo $currentDate; ?>"
                  required
                />
              </div>
  
              <div class="box-dateArrive">
                <label for="dateArrive">Date d'arrivée </label>
                <input
                  type="datetime-local"
                  id="dateArrive"
                  name="dateArrive"
                  value="<?php echo $currentDate; ?>"
                  required
                />
              </div>
            </div>

            <div class="container">
              <div class="box-motif">
                <label for="motif">Motif du voyage</label>
                <textarea name="motif" id="motif" cols="30"  rows="3"wrap="physical"required></textarea>
              </div>
  
              <div class="box-coutCO2">
                <label for="text">Coût en CO2 </label>
                <input
                  type="number"
                  id="coutCO2"
                  name="coutCO2"
                  required
                />
              </div>
            </div>

            <div class="box-valider">
              <button type="submit">Valider</button>
            </div>

          </form>
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