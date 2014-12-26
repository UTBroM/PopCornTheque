<?php
	
	ini_set('display_errors', 'On');

	$support_id = $_POST['support_id'];
	$utilisateur_name = $_POST['utilisateur_name'];
	$support_nom = $_POST['support_nom'];
	$support_nbr = $_POST['support_nbr'];

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('INSERT INTO SUPPORT VALUES(NULL, :support_id, :utilisateur_name, :support_nom, :support_nbr)');
	$req->execute(array(
		'support_id' => $support_id,
		'utilisateur_name' => $utilisateur_name,
		'support_nom' => $support_nom,
		'support_nbr' => $support_nbr,
	));

?>