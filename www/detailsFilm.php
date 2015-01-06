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
			header('Location: index.php'); 
			exit();
		}

		$idfilm = $_GET['idfilm'];

		try{
			$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
		}
		catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
		}

		$req = $bdd->prepare('SELECT * FROM FILM WHERE FILM_ID = ?');
		$req->execute(array($idfilm));

		$donnees = $req->fetch();
		echo '<h1>', $donnees['FILM_TITRE'], '</h1>';
		echo '<img src="', $donnees['FILM_AFFICHE'], '">';
		echo '<h2>Synopsis :</h2><p>', $donnees['FILM_SYNOPSIS'], '</p>';
		

		$req2 = $bdd->prepare('SELECT * FROM SUPPORT WHERE FILM_ID = ?');
		$req2->execute(array($idfilm));

		echo '<h2>Utilisateurs qui disposent de se film :</h2><ul>';
		while($donnees = $req2->fetch()){

			echo '<li>', htmlspecialchars($donnees['UTI_ID']), '</li>';

		}
		echo '</ul>';


		$req3 = $bdd->prepare('SELECT * FROM COMMENTAIRES_FILM WHERE FILM_ID = ?');
		$req3->execute(array($idfilm));

		echo '<h2>Commentaires :</h2><ul>';
		while($donnees = $req3->fetch()){

			echo '<li><h3>', htmlspecialchars($donnees['UTI_ID']), '</h3></li>';
			echo '<li>', htmlspecialchars($donnees['COMF_CONTENU']), '</li>';

		}
		echo '</ul>';

	?>

		<form action="ajoutCommentaireFilm.php" method="post">
			<p>
				ID du Film :<input type="hidden" name="film_id"  value=<?php echo $idfilm; ?>/></br>
				Note : 	<input type="radio" name="note" value="0" id="case0" /><label for="case0">0</label>
					<input type="radio" name="note" value=1 id="case1" /><label for="case1">1</label>
					<input type="radio" name="note" value=2 id="case2" /><label for="case2">2</label>
					<input type="radio" name="note" value=3 id="case3" /><label for="case3">3</label>
					<input type="radio" name="note" value=4 id="case4" /><label for="case4">4</label>
					<input type="radio" name="note" value=5 id="case5" /><label for="case5">5</label>
					<input type="radio" name="note" value=6 id="case6" /><label for="case6">6</label>
					<input type="radio" name="note" value=7 id="case7" /><label for="case7">7</label>
					<input type="radio" name="note" value=8 id="case8" /><label for="case8">8</label>
					<input type="radio" name="note" value=9 id="case9" /><label for="case9">9</label>
					<input type="radio" name="note" value=10 id="case10" /><label for="case10">10</label>
				</br>
				Commentaire : </br><textarea name="commentaire" rows="5" cols="40"></textarea></br>

				<input type="submit" value="Valider">
			</p>

		</form>

	</body>
</html>
