<?php
	
	ini_set('display_errors', 'On');

	$emprunter_id = $_POST['emprunter_id'];
	$current_id_user = ;
	$emprunt_date = $_POST['emprunt_date'];
	$retour_emprunt_date = $_POST['retour_emprunt_date'];
	$emprunt_duree = $_POST['emprunt_duree'];


	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->exec('UPDATE EMPRUNT SET EMPR_ID = NULL, UTI_ID = $current_id_user , SUP_ID = $current_id_support, EMPR_DATE = date(Y-M-D H:M:S), EMPR_RETOUR_THEORIQUE = $retour_emprunt_date, EMPR_RETOUR_REEL = ($retour_emprunt_date - date(Y-M-D H:M:S), EMPR_DUREE = $emprunt_duree, EMPR_RENDU = "non"');
?>