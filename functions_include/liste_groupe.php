<?php
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');
$reqlistgroupe = $base->prepare("SELECT type_groupe_id, type_groupe_libelle FROM type_groupe");
$reqlistgroupe->execute();
$datalistgroupe = $reqlistgroupe->fetchAll();
$reqlistgroupe->closeCursor();
echo"<option value=\"\">Groupe</option>";
    foreach($datalistgroupe as $value)
    {
        echo"<option value=\"$value[type_groupe_id]\">$value[type_groupe_libelle]</option>";
    }
?>