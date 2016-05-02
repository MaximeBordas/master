<?php
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');
foreach ($_POST['supp'] as $value) {
    $sql_supp = "DELETE FROM type_groupe WHERE type_groupe_id = $value";
    echo $sql_supp;
    $supp = $base->prepare($sql_supp);
    $supp->execute();
}
header('Location: gestion_types_groupe.php');
?>