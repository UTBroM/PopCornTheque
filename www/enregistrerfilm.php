<?php

	session_start();
	if ((!isset($_SESSION['login'])) || (empty($_SESSION['login'])))
	{
		// la variable 'login' de session est non déclaré ou vide
		header('Location: index.php'); 
		exit();
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
	<title>PopcornTeque</title>
	</head>

	<body>

		<form action="ajoutSupport.php" method="post">

			Nom du support : <input type="text" name="support_nom"></br>

		<?php

			ini_set('display_errors', 'On');

			$idfilm = $_GET['detailsfilm'];

			$details = json_decode(file_get_contents("http://www.omdbapi.com/?i=$idfilm&plot=full&r=json"));

			$sortie = date("Y-m-d",strtotime($details->Released));
			$posterURL = $details->Poster;
			$poster = NULL;

			if ($posterURL != "N/A"){

				$posterFile = basename($posterURL);
				$poster = "tempPoster/$posterFile";

				if(!file_exists("tempPoster/$posterFile")) file_put_contents("tempPoster/$posterFile", file_get_contents("$posterURL"));

			}

			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
			}
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}


			$reponse = $bdd->prepare('SELECT * FROM FILM WHERE FILM_AFFICHE = ?');
			$reponse->execute(array($poster));

			$donnees = $reponse->fetch();

			// Si le film existe déjà on ne fait rien
			if($donnees['FILM_ID'] > 0){

				$filmid = $donnees['FILM_ID'];

			}
			else{

				$req = $bdd->prepare('INSERT INTO FILM VALUES(NULL, :titre, :synopsis, :sortie, :affiche, NULL, :age, :imdb)');
				$req->execute(array(
					'titre' => $details->Title,
					'synopsis' => $details->Plot,
					'sortie' => $sortie,
					'affiche' => $poster,
					'age' => $details->Rated,
					'imdb' => $idfilm
				));

				$filmid = $bdd->lastInsertId('FILM');

				$listeacteurs = explode(", ", $details->Actors);

				foreach($listeacteurs as $acteur){

					$curacteur = explode(" ",$acteur);
					$req = $bdd->prepare('INSERT INTO ARTISTE VALUES(NULL, :nom, :prenom)');
					$req->execute(array(
						'nom' => $curacteur[1],
						'prenom' => $curacteur[0]
					));


					$req = $bdd->prepare('SELECT ART_ID FROM ARTISTE WHERE ART_NOM = :nom AND ART_PRENOM = :prenom');
					$req->execute(array(
						'nom' => $curacteur[1],
						'prenom' => $curacteur[0]
					));
					$artid = $req->fetch()[0];

					$req = $bdd->prepare('INSERT INTO AVOIR_JOUE_DANS VALUES(:idfilm, :idart)');
					$req->execute(array(
						'idfilm' => $filmid,
						'idart' => $artid
					));

				}

				$directeur = explode(" ",$details->Director);
				$req = $bdd->prepare('INSERT INTO ARTISTE VALUES(NULL, :nom, :prenom)');
				$req->execute(array(
					'nom' => $directeur[1],
					'prenom' => $directeur[0]
				));

				$req = $bdd->prepare('SELECT ART_ID FROM ARTISTE WHERE ART_NOM = :nom AND ART_PRENOM = :prenom');
				$req->execute(array(
					'nom' => $directeur[1],
					'prenom' => $directeur[0]
				));
				$artid = $req->fetch()[0];

				$req = $bdd->prepare('INSERT INTO REALISER VALUES(:idart, :idfilm)');
				$req->execute(array(
					'idfilm' => $filmid,
					'idart' => $artid
				));

			}

			echo'<input type="hidden" name="film_id" value=',$filmid,'>';
			echo'<input type="hidden" name="utilisateur_id" value="',$_SESSION['login'],'">';

		?>

			<input type="submit" value="Valider">

		</form>
	</body>
</html>

