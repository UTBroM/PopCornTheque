<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>PopcornTeque</title>
	</head>

	<body>
		<?php

			ini_set('display_errors', 'On');

			session_start();
			$_SESSION['login'] = '';
			$_SESSION['password'] = '';

			$user = $_POST['user'];
			$password = sha1($_POST['password']);

			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
			}
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}

			$req = $bdd->prepare('SELECT UTI_MOT_DE_PASSE FROM UTILISATEURS WHERE UTI_ID = :nom');
			$req->execute(array(
				'nom' => $user
			));

			$realpassword = $donnees = $req->fetch()[0];

			if ($realpassword == $password){

				echo "Bon mot de passe";
				$_SESSION['login'] = $user;
				$_SESSION['password'] = $password;

			}
			else{

				echo '<p>Mauvais mot de passe</p><p><a href="monespace.php">Accédez à l\'espace ultra sécurisé des membres</a>';

			}

		?>
	</body>
</html>
