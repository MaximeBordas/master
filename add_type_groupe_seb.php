<?php
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');

$sql="INSERT INTO type_groupe (type_groupe_libelle, type_groupe_points) VALUES (:libelle, :points)";

$req=$base->prepare($sql);
$req->bindParam(':libelle',$_POST['nomtypegroupe']);
$req->bindParam(':points',$_POST['nombrespointsgroupe']);


$req->execute();
header('Location: gestion_types_groupe.php');
?>