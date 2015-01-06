<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>PopcornTeque</title>
	</head>

	<?php
	
		ini_set('display_errors', 'On');

		$film_id = $_POST['film_id'];
		$utilisateur_id = $_POST['utilisateur_id'];
		$support_nom = $_POST['support_nom'];

		echo "Support ajouté";

		try{
			$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
		}
		catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
		}

		$req = $bdd->prepare('INSERT INTO SUPPORT VALUES(NULL, :film_id, :utilisateur_id, :support_nom, 1)');
		$req->execute(array(
			'film_id' => $film_id,
			'utilisateur_id' => $utilisateur_id,
			'support_nom' => $support_nom,
		));
		$req->closeCursor();
	?>

	</body>
</html>
