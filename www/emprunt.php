<?php
	
	ini_set('display_errors', 'On');

	$current_id_user = $_POST['current_id_user'];
	$current_id_support = $_POST['current_id_support'];
	$currt_date = date("Y-m-d H:i:s");
	
	$retour_emprunt_date = $_POST['retour_emprunt_date'];

	$datetime1 = date_create($currt_date);
	$datetime2 = date_create($retour_emprunt_date);
	$interval = date_diff($datetime1, $datetime2);
	$emprunt_duree = $interval->format("Y-m-d H:i:s");

	$rendu = FALSE;


	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('INSERT INTO EMPRUNT VALUES(NULL, :current_id_user, :current_id_support, :currt_date, :retour_emprunt_date, NULL, :emprunt_duree, :rendu');
	$req->execute(array(
		'current_id_user' => $current_id_user,
		'current_id_support' => $current_id_support,
		'currt_date' => $currt_date,
		'retour_emprunt_date' => $retour_emprunt_date,
		'emprunt_duree' => $emprunt_duree,
		'rendu' => $rendu
	));

	$req2 = $bdd->prepare('DELETE FROM DEMANDE_EMPRUNT WHERE SUP_ID = :current_id_support AND UTI_ID = :current_id_user');
	$req2->execute(array(
		'current_id_support' => $current_id_support,
		'current_id_user' => $current_id_user,
	));
?>
