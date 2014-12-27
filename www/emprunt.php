<?php
	
	ini_set('display_errors', 'On');

	$current_id_user = $_POST['current_id_user'];
	$emprunt_date = $_POST['emprunt_date'];
	$current_id_support = $_POST['current_id_support'];
	$currt_date = date(Y-M-D H:M:S);
	
	$retour_emprunt_date = $_POST['retour_emprunt_date'];
	$retour_emprunt_date_reel = NULL;
	$emprunt_duree = $retour_emprunt_date - $date;
	$rendu = 'non';


	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('UPDATE EMPRUNT SET EMPR_ID = NULL, UTI_ID = :current_id_user , SUP_ID = :current_id_support, EMPR_DATE = :currt_date, EMPR_RETOUR_THEORIQUE = :retour_emprunt_date, EMPR_RETOUR_REEL = :retour_emprunt_date_reel, EMPR_DUREE = :emprunt_duree, EMPR_RENDU = :rendu');
	$req = execute(array(
		'current_id_user' => $current_id_user,
		'emprunt_date' => $emprunt_date,
		'current_id_support' => $current_id_support,
		'currt_date' => $currt_date,
		'retour_emprunt_date' => $retour_emprunt_date,
		'retour_emprunt_date_reel' => $retour_emprunt_date_reel,
		'emprunt_duree' => $emprunt_duree,
		'rendu' => $rendu,
	));

	$req2 = $bdd->prepare('DELETE FROM DEMANDE_EMPRUNT WHERE SUP_ID = :current_id_support AND UTI_ID = :current_id_user');
	$req2 = execute(array(
		'current_id_support' => $current_id_support,
		'current_id_user' => $current_id_user,
	));
?>