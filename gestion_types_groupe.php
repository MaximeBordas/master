<?php
session_start();
if (!isset($_SESSION['login'])) {
	header ('Location: index.php');
	exit();
}
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');
$sql_user = "SELECT type_groupe_id, type_groupe_libelle, type_groupe_libelle, type_groupe_points FROM type_groupe";


$req= $base->prepare($sql_user);
$req->execute();

$data = $req->fetchAll();
$req->closeCursor();
$reqtypegroupe = $base->prepare("SELECT type_groupe_libelle FROM type_groupe");
$reqprof = $base->prepare("SELECT utilisateur_nom FROM utilisateur WHERE utilisateur_type=1 OR utilisateur_type=2 AND classe_id = :classe");
?>

<html>
    <head>
        <title>Espace membre</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/style.css">
        <script src="scripts/script.js" type="text/javascript"></script>
    </head>

<body>
    <?php include('functions_include/head_admin.html');
    include('functions_include/left-menu.html');?>
<div class="col-md-8">    
    <h1>Gestion des types de groupes</h1>
</div>
<button type="button" class="btn btn-danger"><a class="logout" href="deconnexion.php">Déconnexion</a></button>
<div class="col-md-8">
    <form method="POST" action="gestion_users.php">
        <div class="col-md-3">
            <input type="text" name="nom_eleve" placeholder="Entrez le nom d'un élève" id="input_cus"/>
        </div>
        <div class="col-md-3">
            <select name="liste_classe" id="input_cus">
                <?php include('functions_include/liste_classe.php');?>
            </select>
        </div>
        <div class="col-md-3">
            <select name="liste_sexe" id="input_cus">
                <option value="">--- Sélectionnez ---</option>
                <option value="h">Homme</option>
                <option value="f">Femme</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="submit" value="Rechercher" id="input_cus"/>
        </div>
    </form>
    <div class="col-md-12 align-center">
        <?php include('functions_include/add_type_groupe_button.html') ?>
    </div>
    <form action="supp_user.php" method="POST">
    <table>
        <tr>
            <td>Type Groupe</td>
            <td>Nombres Points</td>
            <td>Supp</td>
        <?php
        foreach ($data as $value)
        {
            $reqtypegroupe->execute();
            $type_groupe_nom = $reqtypegroupe->fetch();
            $reqtypegroupe->closeCursor();

            echo "<tr>";
            echo "<td contenteditable='true'>$value[type_groupe_libelle]</td>";
            echo "<td contenteditable='true'>$value[type_groupe_points]</td>";
            echo "<td class=\"no-padding\"><input class=\"full-content no-margin\" type=\"checkbox\" name=\"supp[]\" value=\"$value[type_groupe_id]\"/></td>";
            echo "</tr>";
        }
 
        ?>
    </table>
    <input type="submit" value="Supprimer" class="btn btn-danger">
    </form>
</body>
</html>