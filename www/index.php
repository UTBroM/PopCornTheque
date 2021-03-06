<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<link rel="icon" type="image/x-icon" href="favicon.ico" />
		<title>PopcornTeque</title>
	</head>

	<body>

		<?php include 'header.php'; ?>

		<h1>Bienvenue sur PopcornTeque</h1>

		<section class="recherche">
			<form action="filtrageFilms.php" method="post">
				<div>
				    <input type="text" name="film" />
				    <input type="submit" value="Rechercher" />
				</div>
			</form>
		</section>
		
		<ul class="tableau-film">
			<?php
				include 'connexionBDD.php';

				$req = $bdd->prepare("SELECT *  FROM FILM");
				$req->execute(array($film));

				while($donnees = $req->fetch()){

					echo '<a href="detailsFilm.php?idfilm=',$donnees['FILM_ID'],'"><li>';
					echo '<h4>',htmlspecialchars($donnees['FILM_TITRE']),"</h4>\n";
					echo '<img src="', $donnees['FILM_AFFICHE'], '">';
					echo "\n</li></a>";
				}
			?>
		</ul>


		<a href="rechercheFilm.html" title="Ajouter film possédé" style="position: fixed; bottom: 0; right: 0;">
			<div id="badge-plus"><img src="images/plus.png" alt="Ajouter un film possédé"></div>
		</a>

	</body>
</html>
