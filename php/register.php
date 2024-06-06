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
                //redirection au login
                header("Location: ../html/login.html");
            }else{
                echo "Les mots de passe sont différents";
            }
        }else{
            echo "Code de vérification incorrect.";
        } 
    }else{
        echo "Numero AVS incorrect.";
    }
}else{
    echo "Remplissez tous les champs.";
}
?>