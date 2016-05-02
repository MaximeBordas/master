<?php
session_start();
if (!isset($_SESSION['login'])) {
	header ('Location: index.php');
	exit();
}
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');
$sql_user = "SELECT utilisateur_id, utilisateur_nom, utilisateur_prenom, utilisateur_type, classe_id, utilisateur_sexe FROM utilisateur";

if (isset($_POST['liste_classe']) || isset($_POST['liste_sexe']) || isset($_POST['nom_eleve'])) {
    if ($_POST['liste_classe'] != "" || $_POST['liste_sexe'] != "" || $_POST['nom_eleve'] != "") {
        $sql_user .= " WHERE";
        $length_sql_user = strlen($sql_user);
        if ($_POST['liste_classe'] != "") {
            $sql_user .= " classe_id = $_POST[liste_classe]";
        }

        if ($_POST['liste_sexe'] != "") {
            if (strlen($sql_user)>$length_sql_user) {
            $sql_user .= " AND";
            }
            $sql_user .= " utilisateur_sexe = '$_POST[liste_sexe]'";
        }

        if ($_POST['nom_eleve'] != "") {
            if (strlen($sql_user)>$length_sql_user) {
            $sql_user .= " AND";
            }
            $sql_user .= " utilisateur_prenom = \"$_POST[nom_eleve]\"";
        }
    }
}

$req= $base->prepare($sql_user);
$req->execute();

$data = $req->fetchAll();
$req->closeCursor();
$reqclasse = $base->prepare("SELECT classe_libelle FROM classe WHERE classe_id = :classe");
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
    <h1>Gestion des utilisateurs</h1>
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
        <?php include('functions_include/add_button.html') ?>
    </div>
    <form action="supp_user.php" method="POST">
    <table>
        <tr>
            <td>Nom</td>
            <td>Prénom</td>
            <td>Type utilisateur</td>
            <td>Classe</td>
            <td>Professeur référent</td>
            <td>Sexe</td>
            <td>Supp</td>
        <?php
        foreach ($data as $value) {
            if ($value['utilisateur_type']==0) {
                $type_user="Elève";
            }elseif ($value['utilisateur_type']==1) {
                $type_user="Professeur";
            }elseif ($value['utilisateur_type']==2) {
                $type_user="Administrateur";
            }
            
            if ($value['utilisateur_sexe']=='h') {
                $sexe="Homme";
            }
            else {
                $sexe="Femme";
            }
            
            $reqclasse->bindValue(':classe', $value['classe_id']);
            $reqprof->bindValue(':classe', $value['classe_id']);
            $reqclasse->execute();
            $reqprof->execute();
            $classe_nom = $reqclasse->fetch();
            $prof_nom = $reqprof->fetch();
            $reqclasse->closeCursor();
            $reqprof->closeCursor();
            
            echo "<tr>";
            echo "<td contenteditable='true'>$value[utilisateur_nom]</td>";
            echo "<td contenteditable='true'>$value[utilisateur_prenom]</td>";
            echo "<td contenteditable='true'>$type_user</td>";
            echo "<td contenteditable='true'>$classe_nom[0]</td>";
            echo "<td contenteditable='true'>M. $prof_nom[0]</td>";
            echo "<td contenteditable='true'>$sexe</td>";
            echo "<td class=\"no-padding\"><input class=\"full-content no-margin\" type=\"checkbox\" name=\"supp[]\" value=\"$value[utilisateur_id]\"/></td>";
            echo "</tr>";
        }    
        ?>
    </table>
    <input type="submit" value="Supprimer" class="btn btn-danger">
    </form>
</body>
</html>