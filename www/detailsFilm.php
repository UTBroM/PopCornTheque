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

		$idfilm = $_GET['idfilm'];

		include 'connexionBDD.php';

		$req = $bdd->prepare('SELECT * FROM FILM WHERE FILM_ID = ?');
		$req->execute(array($idfilm));

		$donnees = $req->fetch();
		echo '<h1>', $donnees['FILM_TITRE'], '</h1>';
		echo '<div class="affiche"><img src="', $donnees['FILM_AFFICHE'], '"></div>';

		if(isset($donnees['FILM_NOTE'])){

			echo '<h2>Note : ', $donnees['FILM_NOTE'], '/10<h2>';

		}

		echo '<h2>Synopsis :</h2><p>', $donnees['FILM_SYNOPSIS'], '</p>';

		echo '<h2>Acteurs :</h2><ul class="auteur">';

		$reqacteurs = $bdd->prepare('SELECT A.ART_NOM, A.ART_PRENOM FROM AVOIR_JOUE_DANS AS J INNER JOIN ARTISTE AS A ON J.ART_ID = A.ART_ID WHERE FILM_ID = ?');
		$reqacteurs->execute(array($idfilm));

		while($donnees = $reqacteurs->fetch()){

			echo '<li>', $donnees['ART_PRENOM'], ' ', $donnees['ART_NOM'], '</li>';

		}
		echo '</ul>';

		$reqacteurs->closeCursor();

		echo '<h2>Réalisateur :</h2><ul class="realisateur">';

		$reqrealisateur = $bdd->prepare('SELECT A.ART_NOM, A.ART_PRENOM FROM REALISER AS R INNER JOIN ARTISTE AS A ON R.ART_ID = A.ART_ID WHERE FILM_ID = ?');
		$reqrealisateur->execute(array($idfilm));

		while($donnees = $reqrealisateur->fetch()){

			echo '<li>', $donnees['ART_PRENOM'], ' ', $donnees['ART_NOM'], '</li>';

		}
		echo '</ul>';

		$reqrealisateur->closeCursor();

		$req2 = $bdd->prepare('SELECT * FROM SUPPORT WHERE FILM_ID = ? AND SUP_LIBRE = 1 AND UTI_ID != ?');
		$req2->execute(array($idfilm, $_SESSION['login']));

		echo '<h2>Utilisateurs qui disposent de ce film (cliquez pour faire une demande d\'emprunt):</h2><ul class="emprunt">';
		while($donnees = $req2->fetch()){

			echo '<li><a href="demandeEmprunt.php?sup_id=', $donnees['SUP_ID'], '">', htmlspecialchars($donnees['UTI_ID']), ' (', htmlspecialchars($donnees['SUP_NOM']), ')', '</a></li>';

		}
		echo '</ul>';

		$req2->closeCursor();
	?>

		<h2>Je possède ce film !</h2>

		<form action="ajoutSupport.php" method="post">

			Nom du support : <select name="support_nom">
			<option value="DVD">DVD</option>
			<option value="Blu-Ray">Blu-Ray</option>
			<option value="VHS">VHS</option>
			<option value="Support Virtuel">Support Virtuel</option>
			<option value="Bobine">Bobine</option>
			<option value="Autre">Autre ...</option>
			</select>

	<?php

		echo '<input type="hidden" name="film_id" value=',$idfilm,'>';
		echo '<input type="hidden" name="utilisateur_id" value="',$_SESSION['login'],'">';
		echo '<input type="submit" value="Valider"></form>';

		$req3 = $bdd->prepare('SELECT * FROM COMMENTAIRES_FILM WHERE FILM_ID = ?');
		$req3->execute(array($idfilm));

		echo '<h2>Commentaires :</h2><ul>';
		while($donnees = $req3->fetch()){
			echo '<li class="commentaire"><ul>';
				echo '<li class="pseudo-commentaire">', htmlspecialchars($donnees['UTI_ID']), '</li>'; 
				echo '<li class="date-commentaire"> (', date("d/m/Y", strtotime($donnees['COMF_DATE'])), ') : </li>';
				echo '<li ><p>', htmlspecialchars($donnees['COMF_CONTENU']), '</p></li>';
				echo '<li class="note-commentaire">Note : ', $donnees['COMF_NOTE'], '/10</li>';
			echo '</div></ul>';

		}
		echo '</ul>';

		$req3->closeCursor();

	?>

		<form action="ajoutCommentaireFilm.php" method="post">
			<p>

				<input type="hidden" name="film_id"  value=<?php echo $idfilm; ?>></br>
				Note : 	<input type="radio" name="note" value="0" id="case0" ><label for="case0">0</label>
					<input type="radio" name="note" value=1 id="case1" ><label for="case1">1</label>
					<input type="radio" name="note" value=2 id="case2" ><label for="case2">2</label>
					<input type="radio" name="note" value=3 id="case3" ><label for="case3">3</label>
					<input type="radio" name="note" value=4 id="case4" ><label for="case4">4</label>
					<input type="radio" name="note" value=5 id="case5" ><label for="case5">5</label>
					<input type="radio" name="note" value=6 id="case6" ><label for="case6">6</label>
					<input type="radio" name="note" value=7 id="case7" ><label for="case7">7</label>
					<input type="radio" name="note" value=8 id="case8" ><label for="case8">8</label>
					<input type="radio" name="note" value=9 id="case9" ><label for="case9">9</label>
					<input type="radio" name="note" value=10 id="case10" checked><label for="case10">10</label>

				</br>
				Commentaire : </br><textarea name="commentaire" rows="5" cols="40"></textarea></br>

				<input type="submit" value="Valider">
			</p>

		</form>

	</body>
</html>
