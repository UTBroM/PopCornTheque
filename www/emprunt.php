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

			/*Test si l'utilisateur est connecté*/
			session_start();
			if ((!isset($_SESSION['login'])) || (empty($_SESSION['login'])))
			{
				// la variable 'login' de session est non déclaré ou vide
				header('Location: index.php'); 
				exit();
			}


			$current_id_user = $_POST['current_id_user'];
			$current_id_support = $_POST['current_id_support'];
			$currt_date = date("Y-m-d");
			$retour_emprunt_date = $_POST['retour_emprunt_date'];


			$libre = FALSE;


			try{
				$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
			}
			catch (Exception $e){
				die('Erreur : ' . $e->getMessage());
			}

			$req = $bdd->prepare('INSERT INTO EMPRUNT VALUES(NULL, :current_id_user, :current_id_support, :currt_date, :retour_emprunt_date, NULL, :libre)');
			$req->execute(array(
				'current_id_user' => $current_id_user,
				'current_id_support' => $current_id_support,
				'currt_date' => $currt_date,
				'retour_emprunt_date' => $retour_emprunt_date,
				'libre' => $libre
			));

			$req2 = $bdd->prepare('DELETE FROM DEMANDE_EMPRUNT WHERE SUP_ID = :current_id_support AND UTI_ID = :current_id_user');
			$req2->execute(array(
				'current_id_support' => $current_id_support,
				'current_id_user' => $current_id_user,
			));
		?>
	</body>
</html>