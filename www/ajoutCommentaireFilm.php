<?php
	
	ini_set('display_errors', 'On');
	$film_id = $_POST['film_id'];
	$user_id = $_POST['user_id'];
	$commentaire = $_POST['commentaire'];
	$note = $_POST['note'];
	$date_actuelle = date("Y-m-d H:i:s");

	echo "Sauvegarde du commentaire terminé";

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('INSERT INTO COMMENTAIRES_FILM VALUES(NULL, :film_id, :user_id, :commentaire, :note, :date_actuelle)');
	$req->execute(array(
		'film_id' => $film_id,
		'user_id' => $user_id,
		'commentaire' => $commentaire,
		'note' => $note,
		'date_actuelle' => $date_actuelle,
	));

?>
