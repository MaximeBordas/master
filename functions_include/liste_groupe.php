<?php
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');
$reqlistgroupe = $base->prepare("SELECT groupe_id  FROM   groupe order by groupe_id ASC");
$reqlistgroupe->execute();
$datalistgroupe = $reqlistgroupe->fetchAll();
$reqlistgroupe->closeCursor();
echo"<option value=\"\">Groupe</option>";
    foreach($datalistgroupe as $value)
    {
        echo"<option value=\"$value[groupe_id]\"><p>Groupe n° </p>$value[groupe_id]</option>";
    }
?>