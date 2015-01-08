<?php

	ini_set('display_errors', 'On');

	$film_id = $_POST['film_id'];
	$utilisateur_id = $_POST['utilisateur_id'];
	$support_nom = $_POST['support_nom'];


	include 'connexionBDD.php';

	$req = $bdd->prepare('INSERT INTO SUPPORT VALUES(NULL, :film_id, :utilisateur_id, :support_nom, 1)');
	$req->execute(array(
		'film_id' => $film_id,
		'utilisateur_id' => $utilisateur_id,
		'support_nom' => $support_nom,
	));

	header('Location: index.php');

?>

