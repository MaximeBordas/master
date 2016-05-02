<?php
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');

// $sql="UPDATE type_groupe SET type_groupe_libelle=:libelle , type_groupe_point=:points) WHERE type_groupe_id = $value  ";
//$sql="UPDATE type_groupe (type_groupe_libelle, type_groupe_points) VALUES (:libelle, :points) WHERE type_groupe_id == $value ";
$sql = "UPDATE `type_groupe` SET `type_groupe_points` = $_POST[newNumber] WHERE `type_groupe`.`type_groupe_libelle` = \"$_POST[groupName]\"";
$req=$base->prepare($sql);
$req->bindParam(':libelle',$_POST['nomtypegroupe']);
$req->bindParam(':points',$_POST['nombrespointsgroupe']);


$req->execute();
header('Location: gestion_types_groupe.php');
?>