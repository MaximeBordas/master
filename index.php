<?php
$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');
$requsers = $base->prepare("SELECT utilisateur_id, utilisateur_prenom, utilisateur_nom FROM utilisateur WHERE classe_id= :classe");
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    </head>
<body class="login_body">
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-4">
                <form action="login.php" method='post'>
                    <div class="block">
                        <h1 class="logh1">Accès professeurs et administrateurs :</h1>    
                        <h1 class="logh1">Identifiant</h1>
                        <input type="text" name="login" placeholder="Votre identifiant" id="username" />
                        <h1 class="logh1">Mot de passe</h1>
                        <input type="password" name="password" placeholder="Votre mot de passe" id="password" />
                        <input type="submit" name="connexion" value="Se connecter" id="button">
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>     
            <div class="col-md-4">
                <div class="block">
                    <h1 class="logh1">Accès élèves :</h1><br>
                    <h1 class="logh1">Classes</h1>
                    <select name="liste_classe" id="input_cus" onChange="document.location=this.form.submit();">
                        <?php include('functions_include/liste_classe.php');?>
                    </select>
                    <h1 class="logh1">Elèves</h1>
                    <select name="liste_eleve" id="liste_eleve">
                        <?php 
                        $requsers->execute(array(':classe'=>$_POST['liste_classe']));
                        $datauser = $requsers->fetchAll();
                        $requsers->closeCursor();
                        foreach($datausers as $value) 
                        { 
                            echo"<option value=\"$value[utilisateur_id]\">$value[utilisateur_prenom]</option>"; 
                        }?> 
                    </select>
                    <input type="submit" name="valider" value="Valider" id="button">
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>     
</body>
</html>