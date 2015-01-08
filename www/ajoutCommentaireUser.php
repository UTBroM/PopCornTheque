<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>PopcornTeque</title>
    </head>

    <body>
    	<header>
            <a href="index.php">
            	<img src="images/logo.png" height="120px">
            </a>
    	</header>


		<?php
			
			ini_set('display_errors', 'On');
			$target_user_id = $_POST['target_user_id'];
			$current_user_id = $_POST['current_user_id'];
			$commentaire = $_POST['commentaire'];
			$note = $_POST['note'];
			$date_actuelle = date("Y-m-d H:i:s");

			echo "Sauvegarde du commentaire terminé";

			include 'connexionBDD.php';

			$req = $bdd->prepare('INSERT INTO COMMENTAIRES_UT VALUES(NULL, :current_user_id, :target_user_id, :commentaire, :note, :date_actuelle)');
			$req->execute(array(
				'current_user_id' => $current_user_id,
				'target_user_id' => $target_user_id,
				'commentaire' => $commentaire,
				'note' => $note,
				'date_actuelle' => $date_actuelle
			));

		?>
	</body>
</html>
