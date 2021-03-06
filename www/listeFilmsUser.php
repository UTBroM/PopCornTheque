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

		ini_set('dispay_errors', 'On');

		$utilisateur_id = $_GET['utilisateur_id'];

		include 'connexionBDD.php';

		$req = $bdd->prepare('SELECT F.FILM_ID, SUP_NOM, FILM_AFFICHE, FILM_TITRE FROM SUPPORT AS S INNER JOIN FILM AS F ON F.FILM_ID = S.FILM_ID WHERE UTI_ID = ?');
		$req->execute(array($utilisateur_id));

		echo "<table>\n<caption><h1>Liste des support de ", htmlspecialchars($utilisateur_id),"</h1></caption>\n";
		echo "<thead>\n<tr>\n<th>Id du film\n<th>Titre\n<th>Nom du support\n<th>\n";
		echo "<tbody>\n";
		while($donnees = $req->fetch()){
			echo "<tr>\n<td>",$donnees['FILM_ID'],"\n<td>",'<a href="detailsFilm.php?idfilm=', htmlspecialchars($donnees['FILM_ID']), '">', $donnees['FILM_TITRE'],"</a>\n<td>",htmlspecialchars($donnees['SUP_NOM']),"\n";
			echo '<td><img src="', $donnees['FILM_AFFICHE'], '" width=40% height=40%>';
		}
		echo"</table>";

		$req->closeCursor();
	?>
	</body>
</html>
