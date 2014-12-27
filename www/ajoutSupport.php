<?php
	
	ini_set('display_errors', 'On');

	$support_id = $_POST['support_id'];
	$utilisateur_id = $_POST['utilisateur_id'];
	$support_nom = $_POST['support_nom'];
	$disponible = $_POST['disponible'];

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('INSERT INTO SUPPORT VALUES(NULL, :support_id, :utilisateur_id, :support_nom, :disponible)');
	$req->execute(array(
		'support_id' => $support_id,
		'utilisateur_id' => $utilisateur_id,
		'support_nom' => $support_nom,
		'disponible' => $disponible,
	));

?>
