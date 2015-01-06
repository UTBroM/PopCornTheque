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

			$user = $_SESSION['login'];

			echo htmlspecialchars($user);

			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
			}
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}

			$req = $bdd->prepare("SELECT *  FROM FILM WHERE FILM_TITRE LIKE CONCAT('%', ?, '%')");
			$req->execute(array($film));

			while($donnees = $req->fetch()){

				echo '<br />', htmlspecialchars($donnees['FILM_TITRE']), '<br />';
				echo '<img src="', $donnees['FILM_AFFICHE'], '"></br>';

			}

		?>

	</body>
</html>