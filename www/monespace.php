<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>PopcornTeque</title>
	</head>

	<body>
		<?php
			session_start();
			if ((!isset($_SESSION['login'])) || (empty($_SESSION['login'])))
			{
			// la variable 'login' de session est non déclaré ou vide
			echo '  <p><a href="connexion.html" title="Connexion">Connexion d\'abord !</a></p>';
			exit();
			}
		?>

		<h1>Bienvenue dans l'epace ultra sécurisé !</h1>

		<h2>Informations sur l'utilisateur :</h2>

		<?php

			ini_set('display_errors', 'On');

			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
			}
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}

			$reponse = $bdd->prepare('SELECT * FROM UTILISATEURS WHERE UTI_ID = :nom');
			$reponse->execute(array(
				'nom' => $_SESSION['login']
			));

			$donnees = $reponse->fetch();

			?>

			<p>

				Nom d'utilisateur : <?php echo $donnees['UTI_ID']; ?><br />
				Nom : <?php echo $donnees['UTI_NOM']; ?><br />
				Prénom <?php echo $donnees['UTI_PRENOM']; ?><br />
				Date de naissance : <?php echo $donnees['UTI_DATE_NAISSANCE']; ?><br />
				Rue : <?php echo $donnees['UTI_RUE']; ?><br />
				Code postal : <?php echo $donnees['UTI_CODE_POSTAL']; ?><br />
				Ville : <?php echo $donnees['UTI_VILLE']; ?><br />
				eMail : <?php echo $donnees['UTI_MAIL']; ?>

			</p>

			<?php

			$reponse->closeCursor(); // Termine le traitement de la requête

		?>

	</body>
</html>
