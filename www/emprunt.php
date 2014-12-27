<?php
	
	ini_set('display_errors', 'On');

	$emprunter_id = $_POST['emprunter_id'];
	$emprunt_date = $_POST['emprunt_date'];
	$retour_emprunt_date = $_POST['retour_emprunt_date'];


	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('UPDATE SUPPORT SET UTI_ID_EMPRUNT VALUES(:emprunter_id, :emprunt_date, :retour_emprunt_date)');
	$req->execute(array(
		'emprunter_id' => $emprunter_id,
		'emprunt_date' => $emprunt_date,
		'retour_emprunt_date' => $retour_emprunt_date,
	));
?>