<?php

	ini_set('display_errors', 'On');

	$user = $_POST['user'];
	$password = sha1($_POST['password']);

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('SELECT UTI_MOT_DE_PASSE FROM UTILISATEURS WHERE UTI_ID = :nom');
	$req->execute(array(
		'nom' => $user
	));

	$realpassword = $donnees = $req->fetch()[0];

	if ($realpassword == $password){

		echo "Bon mot de passe";

	}
	else{

		echo "Mauvais mot de passe";

	}

?>
