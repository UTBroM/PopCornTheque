<?php

	ini_set('display_errors', 'On');

	session_start();
	$_SESSION = array();

	$user = $_POST['user'];
	$password = sha1($_POST['password']);

	include 'connexionBDD.php';

	$req = $bdd->prepare('SELECT UTI_MOT_DE_PASSE FROM UTILISATEURS WHERE UTI_ID = :nom');
	$req->execute(array(
		'nom' => $user
	));

	$realpassword = $req->fetch()[0];

	if ($realpassword == $password){

		$_SESSION['login'] = $user;
		$_SESSION['password'] = $password;
		header('Location: index.php');

	}
	else{

		echo '<p>Mauvais mot de passe</p>';
		include 'connexion.html';
	}
	$req->closeCursor();
?>
