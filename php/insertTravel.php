<?php
include('../php/connexion.php');

if(isset($_POST['numeroAVS'])){
    $currentCO2 = 0;
    $numeroAVS = $_POST['numeroAVS'];
    $lieuDepart = $_POST['lieuDepart'];
    $lieuArrive = $_POST['lieuArrive'];
    $dateDepart = $_POST['dateDepart'];
    $dateArrive = $_POST['dateArrive'];
    $motif = $_POST['motif'];
    $coutCO2 = $_POST['coutCO2'];
    $result= $connector->query("SELECT `voyCoutCO2` FROM `t_voyage` WHERE `numeroAVS` LIKE '$numeroAVS'");
    foreach($result as $row)
    {
        $currentCO2 += $row['voyCoutCO2'];
    }
    
    $result=$connector->query("SELECT `perQuotaDisponible` FROM `t_person` WHERE `numeroAVS` LIKE '$numeroAVS'");
    foreach($result as $row)
    {
        $quotaCO2 = $row['perQuotaDisponible'];
    }

    $currentCO2 += $coutCO2;

    if($currentCO2 > $quotaCO2)
    {
        echo '<script language="javascript">';
        echo 'alert("Quota disponible dépassé !");';
        echo 'document.location.href="../php/checkFootPrint.php?numeroAVS='.$numeroAVS.'&aerodep='.$lieuDepart.'&aeroarr='.$lieuArrive.'&datedep='.$dateDepart.'&datearr='.$dateArrive.'&motif='.$motif.'&coutco2='.$coutCO2.'"';
        echo '</script>';  
    }
    else{
        $result=$connector->prepare("INSERT INTO `t_voyage` (`voyDateDepart`, `voyDateArrive`, `voyDepart`, `voyArrive`, `voyMotif`, `voyCoutCO2`, `numeroAVS`)
        VALUES (:dateDepart,:dateArrive,:lieuDepart,:lieuArrive,:motif,:coutCO2,:numeroAVS)");
        $result->bindParam(':lieuDepart',$lieuDepart);
        $result->bindParam(':lieuArrive',$lieuArrive);
        $result->bindParam(':dateDepart',$dateDepart);
        $result->bindParam(':dateArrive',$dateArrive);
        $result->bindParam(':motif',$motif);
        $result->bindParam(':coutCO2',$coutCO2);
        $result->bindParam(':numeroAVS', $numeroAVS);
        $result->execute();

        echo '<script language="javascript">';
        echo 'alert("Données enregistrées.");';
        echo 'document.location.href="../php/admin.php"';
        echo '</script>';   
    }
}


?>