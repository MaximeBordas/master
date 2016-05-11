<?php
session_start();
if (!isset($_SESSION['login'])) {
	header ('Location: index.php');
	exit();
}
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');
$sql_user = "SELECT utilisateur_id, utilisateur_nom, utilisateur_prenom, utilisateur_sexe, classe_libelle, type_groupe.type_groupe_id, type_groupe_points FROM utilisateur, classe, groupe, type_groupe WHERE groupe.groupe_id = utilisateur.groupe_id AND classe.classe_id = utilisateur.classe_id AND groupe.type_groupe_id = type_groupe.type_groupe_id";//Requete pour la recherche

if (isset($_POST['liste_groupe']) || isset($_POST['liste_sexe']) || isset($_POST['nom_eleve'])) {
    if ($_POST['liste_groupe'] != "" || $_POST['liste_sexe'] != "" || $_POST['nom_eleve'] != "") {
        $length_sql_user = strlen($sql_user);
        if ($_POST['liste_groupe'] != "") {
            $sql_user .= " AND type_groupe.type_groupe_id = '$_POST[liste_groupe]'";
        }

        if ($_POST['liste_sexe'] != "") {
            $sql_user .= " AND utilisateur_sexe = '$_POST[liste_sexe]'";
        }

        if ($_POST['nom_eleve'] != "") {
            $sql_user .= " AND utilisateur_prenom = '$_POST[nom_eleve]'";
        }
    }
}
$req = $base->prepare($sql_user);
$req-> execute();

$data = $req->fetchAll();
$req->closeCursor();
$reqgroup = $base -> prepare("SELECT type_groupe_libelle, type_groupe_id FROM type_groupe where type_groupe_id = :type_groupe");/*prépare la requete qui récupère les types de groupes*/
$reqpoints = $base->prepare("SELECT type_groupe_points FROM type_groupe,groupe,utilisateur where type_groupe.type_groupe_id=groupe.type_groupe_id AND utilisateur.groupe_id=groupe.groupe_id AND utilisateur.utilisateur_id=:userid");/* Prépare la requête qui récupère le nombre de points par élève */

/*$reqNbEleves = $base -> prepare("SELECT count(*) from UTILISATEUR,GROUPE WHERE UTILISATEUR.groupe_id= groupe.groupe_id AND type_groupe_id= :type_groupe_id");// Prépare la requête pour afficher le nombre d'élève pour un groupe donné*/
$reqclasse = $base->prepare("SELECT classe_libelle FROM classe WHERE classe_id = :classe");/*prépare la requete qui permet de récupérer les classe*/
$reqprof = $base->prepare("SELECT utilisateur_nom FROM utilisateur WHERE utilisateur_type=1 OR utilisateur_type=2 AND classe_id = :classe");/*prépare la requete qui permet de récupérer les profs*/

/*$reqNbEleves->execute();*/
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
    <h1>Gestion des groupes</h1>
</div>
<button type="button" class="btn btn-danger"><a class="logout" href="deconnexion.php">Déconnexion</a></button>
<div class="col-md-8">
    <form method="POST" action="gestion_groupe.php">
        <div class="col-md-3">
            <input type="text" name="nom_eleve" placeholder="Entrez le nom d'un élève" id="input_cus"/>
        </div>
        <div class="col-md-3">
            <select name="liste_groupe" id="input_cus">
                <?php include('functions_include/liste_groupe.php')/*Fonction qui renvois les differents type de groupe*/;?>
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
        <?php include('functions_include/groupe_add_button.html') ?>
        <?php include('functions_include/groupe_modif_button.html') ?>
        <?php include('functions_include/groupe_supp_button.html') ?>
    </div>
    <form action="supp_user.php" method="POST">
    <table>
        <tr>
            <td>Nom</td>
            <td>Prénom</td>
            <td>Classe</td>
            <td>Points</td>
            <td>Sexe</td>
            <td>Type du groupe</td>
            <td>Supp</td>
        <?php
        $point_total = 0 ;
        foreach ($data as $value) {
                    
            if ($value['utilisateur_sexe']=='h') {
                $sexe="Homme";
            }
            else {
                $sexe="Femme";
            }
            
            $reqgroup->bindParam(':type_groupe', $value['type_groupe_id']);
            $reqclasse->bindParam(':classe', $value['classe_id']);
            $reqprof->bindParam(':classe', $value['classe_id']);
            $reqpoints->bindParam(':userid', $value['utilisateur_id']);/*important pour les      points des participants */
            $reqpoints->execute();//execution de la requête ecrite plus haut
            $reqgroup->execute();
            $reqclasse->execute();
            $reqprof->execute();
            $classe_nom = $reqclasse->fetch();
            $typeGroupe = $reqgroup->fetch();
            $prof_nom = $reqprof->fetch();
            $nb_points = $reqpoints->fetch();// insertion des points dans le tableau
            $point_total = $point_total + $nb_points[0];//nombre points totaux
            $reqgroup->closeCursor();
            $reqclasse->closeCursor();
            $reqprof->closeCursor();
            $reqpoints->closeCursor();// ne pas oublié !
            
            echo "<tr>";
            echo "<td>$value[utilisateur_nom]</td>";
            echo "<td>$value[utilisateur_prenom]</td>";
            /* affichage du nombre de point par élève */
            echo "<td contenteditable='true'>$value[classe_libelle]</td>";
            echo "<td contenteditable='true'>$value[type_groupe_points]</td>";
            echo "<td contenteditable='true'>$sexe</td>";
            echo "<td contenteditable='true'>$typeGroupe[0]</td>";
            echo "<td class=\"no-padding\"><input class=\"full-content no-margin\" type=\"checkbox\" name=\"supp[]\" value=\"$value[utilisateur_id]\"/></td>";
            echo "</tr>";
        }    
        
        echo 'point totaux du groupe : '.$point_total; // affichage point totaux
        /*echo "Nombres d'élèves dans le groupe : ".$reqNbEleves;// affichage du nombre d'élève*/
        ?>
            
    </table>
    <input type="submit" value="Supprimer" class="btn btn-danger">
    </form>
</body>
</html>