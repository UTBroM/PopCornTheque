<?php
	
	ini_set('display_errors', 'On');
	$target_user_id = $_POST['target_user_id'];
	$current_user_id = $_POST['current_user_id'];
	$commentaire = $_POST['commentaire'];
	$note = $_POST['note'];
	$date_actuelle = date(Y-m-d H:i:s);

	echo $target_user_id, $current_user_id, $commentaire, $note, $date_actuelle;

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('INSERT INTO COMMENTAIRES_UT VALUES(NULL, :target_user_id, :current_user_id, :commentaire, :note, :date_actuelle)');
	$req = execute(array(
		'target_user_id' => $target_user_id,
		'current_user_id' => $current_user_id,
		'commentaire' => $commentaire,
		'note' => $note,
		'date_actuelle' => $date_actuelle
	));

?>
