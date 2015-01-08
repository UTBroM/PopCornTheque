<?php

	ini_set('display_errors', 'On');

	$user = $_POST['user'];
	$password = sha1($_POST['password']);
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$date_naissance = $_POST['date_naissance'];
	$rue = $_POST['rue'];
	$code_postal = $_POST['code_postal'];
	$ville = $_POST['ville'];
	$mail = $_POST['mail'];

	include 'connexionBDD.php';

	$req = $bdd->prepare('INSERT INTO UTILISATEURS VALUES(:user, :password, :nom, :prenom, :date_naissance, :rue, :code_postal, :ville, :mail)');
	$req->execute(array(
		'user' => $user,
		'password' => $password,
		'nom' => $nom,
		'prenom' => $prenom,
		'date_naissance' => $date_naissance,
		'rue' => $rue,
		'code_postal' => $code_postal,
		'ville' => $ville,
		'mail' => $mail
	));

	header('Location: index.php');
?>
