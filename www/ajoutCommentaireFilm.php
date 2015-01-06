<?php

	session_start();
	if ((!isset($_SESSION['login'])) || (empty($_SESSION['login'])))
	{
		// la variable 'login' de session est non déclaré ou vide
		header('Location: index.php'); 
		exit();
	}

	ini_set('display_errors', 'On');
	$film_id = $_POST['film_id'];
	$user_id = $_SESSION['login'];
	$commentaire = $_POST['commentaire'];
	$note = $_POST['note'];
	$date_actuelle = date("Y-m-d H:i:s");

	echo "Commentaire ajouté";

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
