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

			$req2 = $bdd->prepare('SELECT SUP_ID FROM EMPRUNT WHERE EMPR_ID = :emprunt_id');
			$req2->execute(array(
				'emprunt_id' => $emprunt_id
			));

			$current_id_support = $req2->fetch()[0];

			$req3 = $bdd->prepare('UPDATE SUPPORT SET SUP_LIBRE = 1 WHERE SUP_ID = :current_id_support');
			$req3->execute(array(
				'current_id_support' => $current_id_support
			));

			header('Location: userSpace.php');
		?>
	</body>
</html>
