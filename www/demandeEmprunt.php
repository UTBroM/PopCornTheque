<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>PopcornTeque</title>
	</head>
	
	<body>
	<?php

		include 'header.php';

		ini_set('display_errors', 'On');

		$utilisateur_id = $_SESSION['login'];
		$support_id = $_GET['sup_id'];

		echo "Demande d'emprunt effectuée";

		try{
			$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
		}
		catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
		}

		$req = $bdd->prepare('INSERT INTO DEMANDE_EMPRUNT VALUES(:utilisateur_id, :support_id)');
		$req->execute(array(
			'utilisateur_id' => $utilisateur_id,
			'support_id' => $support_id,
		));

		$req->closeCursor();
	?>

	</body>
</html>
