<?php
// connexion database
include('../php/connexion.php');
// verifier les donnes si elles sont setup
if(isset($_POST['numeroAVS']) && isset($_POST['password']) && isset($_POST['passwordCheck']) && isset($_POST['verificationCode'])){
    
    //récupérer les variables
    $numeroAVS = $_POST['numeroAVS'];
    $password = $_POST['password'];
    $passwordCheck = $_POST['passwordCheck'];
    $verificationCode = $_POST['verificationCode'];

    //vérification de l'existance du numéro AVS
    $req = $connector->prepare("SELECT * FROM `t_person` WHERE `numeroAVS` = :numeroAVS");
    $req->bindParam(':numeroAVS', $numeroAVS);
    $req->execute();

    //si le numéro AVS est juste
    if($req->rowCount()==1){

        //vérification du code de vérification avec le bon numero AVS
        $req = $connector->prepare("SELECT * FROM `t_person` WHERE `numeroAVS` = :numeroAVS AND `perCodeVerification` = :verificationCode");
        $req->bindParam(':numeroAVS', $numeroAVS);
        $req->bindParam(':verificationCode', $verificationCode);
        $req->execute();

        //Si le code de vérification est juste
        if($req->rowCount()==1)
        { 
            //Vérifie que les deux mots de passe rentrés sont les mêmes
            if($password == $passwordCheck)
            {
                //hash du mot de passe
                $passwordHash = hash('sha256', $password);
                //changement du mot de passe
                $req = $connector->query("UPDATE `t_person` SET `perMotDePasse` = '$passwordHash' WHERE `numeroAVS` = '$numeroAVS' AND `perCodeVerification` = '$verificationCode'");

                // alert pour indiquer que le compte est créer et l'utilisateur est renvoyée au login pour se connecter 
                echo '<script language="javascript">';
                echo 'alert("compte créé, vous aller être renvoyer a la page de login");';
                echo 'document.location.href="../html/login.html"';
                echo '</script>';

                //redirection au login
                //header("Location: ../html/login.html");
                
            }else{

                echo '<script language="javascript">';
                echo 'alert("Les mots de passe sont différents !");';
                echo 'document.location.href="../html/register.html"';
                echo '</script>';
                //echo "Les mots de passe sont différents";

            }
        }else{
            
            echo '<script language="javascript">';
            echo 'alert("Code de vérification incorrect !");';
            echo 'document.location.href="../html/register.html"';
            echo '</script>';

            //echo "Code de vérification incorrect.";
        } 
    }else{

        echo '<script language="javascript">';
        echo 'alert("Numero AVS incorrect !");';
        echo 'document.location.href="../html/register.html"';
        echo '</script>';

        //echo "Numero AVS incorrect.";
    }
}else{
    
    echo '<script language="javascript">';
    echo 'alert("ACCÈS INTERDIT !");';
    echo 'document.location.href="../html/register.html"';
    echo '</script>'; 
}
?>