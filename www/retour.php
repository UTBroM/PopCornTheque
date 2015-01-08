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


			$emprunt_id = $_GET['emprunt_id'];
			$retour_emprunt_date = date("Y-m-d");
			$libre = TRUE;


			include 'connexionBDD.php';

			$req = $bdd->prepare('UPDATE EMPRUNT SET EMPR_RETOUR_REEL = :retour_emprunt_date, EMPR_RENDU = :libre WHERE EMPR_ID = :emprunt_id');
			$req->execute(array(
				'emprunt_id' => $emprunt_id,
				'retour_emprunt_date' => $retour_emprunt_date,
				'libre' => $libre
			));
			header('Location: userSpace.php');
		?>
	</body>
</html>
