<?php
include('../php/connexion.php');
if(isset($_POST['numeroAVS'])){
    $currentCO2 = 0;
    $numeroAVS = $_POST['numeroAVS'];
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

    $calcQuotat = $quotaCO2 - $currentCO2;
    if($calcQuotat < $quotaCO2)
    {
        $result=$connector->query("UPDATE `t_person` SET `perIsAllowed`= 0  WHERE `numeroAVS` LIKE '$numeroAVS'");
        echo '<script language="javascript">';
        echo 'alert("Quota disponible dépassé !");';
        echo 'document.location.href="../php/admin.php"';
        echo '</script>';  
    }
    

}


?>