<?php
    // connexion database
    include("../php/connexion.php");
    // si le champs est rempli on le recupere et on le stock
    if(isset($_POST['numeroAVS']) && isset($_POST['password'])){
        $numeroAVS = $_POST['numeroAVS'];
        $password = $_POST['password'];
        $passwordHash = hash('sha256', $password);// chiffrer le mot de passe

        // Utilisation de query pour effectuer une requête
        $req = $connector->prepare("SELECT * FROM `t_person` WHERE `numeroAVS` = :numeroAVS AND `perMotDePasse` = :password");
        $req->bindParam(':numeroAVS', $numeroAVS);
        $req->bindParam(':password', $passwordHash);
        $req->execute();// executer la requete 
        // ouverture de session
        if($req->rowCount()==1){
            session_start();
            $_SESSION['logged_in'] = true;
            $_SESSION['numeroAVS'] = $numeroAVS;

            $result = $req->fetchALL(PDO::FETCH_ASSOC);
            $_SESSION['numeroAVS'] = $result[0]["numeroAVS"];

            header("Location: ../php/accueil.php");

        }else {

            echo '<script language="javascript">';
            echo 'alert("Numéro AVS ou mot de passe incorrect !");';
            echo 'document.location.href="../html/login.html"';
            echo '</script>';  
            
            //echo "ERREUR DE CONNEXION";
        }
    }else{

        echo '<script language="javascript">';
        echo 'alert("ACCÈS INTERDIT !");';
        echo 'document.location.href="../html/login.html"';
        echo '</script>';  

        //echo"Pas possible desolé"; //pas possible d'acceder à la page de checking de connexion
    }
?>