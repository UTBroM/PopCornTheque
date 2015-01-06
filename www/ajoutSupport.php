<?php
	
	ini_set('display_errors', 'On');

	$support_id = $_POST['film_id'];
	$utilisateur_id = $_POST['utilisateur_id'];
	$support_nom = $_POST['support_nom'];
	$disponible = $_POST['disponible'];

	echo "Support ajouté";

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('INSERT INTO SUPPORT VALUES(NULL, :film_id, :utilisateur_id, :support_nom, :disponible)');
	$req->execute(array(
		'film_id' => $film_id,
		'utilisateur_id' => $utilisateur_id,
		'support_nom' => $support_nom,
		'disponible' => $disponible,
	));

?>
