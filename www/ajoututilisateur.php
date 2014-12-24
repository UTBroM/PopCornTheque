<?php

	ini_set('display_errors', 'On');

	$user = htmlspecialchars($_POST['user']);
	$password = sha1($_POST['password']);
	$nom = htmlspecialchars($_POST['nom']);
	$prenom = htmlspecialchars($_POST['prenom']);
	$date_naissance = $_POST['date_naissance'];
	$rue = htmlspecialchars($_POST['rue']);
	$code_postal = $_POST['code_postal'];
	$ville = htmlspecialchars($_POST['ville']);
	$mail = htmlspecialchars($_POST['mail']);

	try
	{
	$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

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
?>
