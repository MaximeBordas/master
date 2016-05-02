<?php
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');

if ($_POST['liste_type'] == 0) {
    $sql="INSERT INTO utilisateur (utilisateur_type, utilisateur_nom, utilisateur_prenom, utilisateur_sexe, utilisateur_date_naissance, classe_id) VALUES (:type, :nom, :prenom, :sexe, :date_naissance, :classe)";
}
else {
    $sql="INSERT INTO utilisateur (utilisateur_login, utilisateur_mdp, utilisateur_type, utilisateur_nom, utilisateur_prenom, utilisateur_sexe, utilisateur_date_naissance, classe_id) VALUES (:login, :mdp, :type, :nom, :prenom, :sexe, :date_naissance, :classe)";
}
$req=$base->prepare($sql);
if ($_POST['liste_type']!=0) {
    $req=bindParam(':login',$_POST['identifiant']);
    $req=bindParam(':mdp',$_POST['mdp']);
}
$req->bindParam(':type',$_POST['liste_type']);
$req->bindParam(':nom',$_POST['nom']);
$req->bindParam(':prenom',$_POST['prenom']);
$req->bindParam(':sexe',$_POST['liste_sexe']);
$req->bindParam(':date_naissance',$_POST['date']);
$req->bindParam('classe',$_POST['liste_classe']);
$req->execute();
header('Location: gestion_users.php');
?>