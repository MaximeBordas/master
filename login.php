<?php
// on teste si le visiteur a soumis le formulaire de connexion
if (isset($_POST['connexion']) && $_POST['connexion'] == 'Se connecter') {
	if ((isset($_POST['login']) && !empty($_POST['login'])) && (isset($_POST['password']) && !empty($_POST['password']))) {
    extract($_POST);

	$base = new PDO('mysql:host=localhost;dbname=cross', 'root', '');

	// on teste si une entrée de la base contient ce couple login / pass
	$req = $base->prepare("SELECT * FROM utilisateur WHERE utilisateur_login = :login AND utilisateur_mdp = :mdp");
    $req->execute(array(':login'=>$login,':mdp'=>$password));
	$data = $req->fetch();

	$req->closeCursor();

	// si on obtient une réponse, alors l'utilisateur est un membre
	if (!empty($data['utilisateur_id'])) {
        session_start();
		$_SESSION['login'] = $_POST['login'];
        $_SESSION['prenom'] = $data['utilisateur_prenom'];
        if ($data['utilisateur_type']==1) {
            header('Location: membre.php');
        }
        elseif ($data['utilisateur_type']==2) {
            header('Location: gestion_users.php');
        }
		exit();
	}
	// si on ne trouve aucune réponse, le visiteur s'est trompé soit dans son login, soit dans son mot de passe
	elseif (empty($data['utilisateur_id'])) {
		$erreur = 'Compte non reconnu.';
	}
	// sinon, alors la, il y a un gros problème :)
	else {
		$erreur = 'Probème dans la base de données : plusieurs membres ont les mêmes identifiants de connexion.';
	}
	}
	else {
	$erreur = 'Au moins un des champs est vide.';
	}
}
echo $erreur;
?>