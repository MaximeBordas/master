<?php
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');
$reqlisteclasse = $base->prepare("SELECT classe_id, classe_libelle FROM classe");
$reqlisteclasse->execute();
$datalisteclasse = $reqlisteclasse->fetchAll();
$reqlisteclasse->closeCursor();
echo"<option value=\"\">Classe</option>";
 foreach($datalisteclasse as $value) 
    { 
        echo"<option value=\"$value[classe_id]\">$value[classe_libelle]</option>"; 
    }
?>