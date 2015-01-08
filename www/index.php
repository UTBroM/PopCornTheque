<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>PopcornTeque</title>
    </head>

    <body>

		<?php include 'header.php'; ?>

		<h1>Bienvenue sur PopcornTeque</h1>

		<section>
			<form action="filtrageFilms.php" method="post">
			<p>
			    <img class="loupe" src="images/loupe.png">
			    <input type="text" name="film" />
			    <input type="submit" value="Rechercher" />
			</p>
			</form>
		</section>
		
	<ul class="tableau-film">
	
	<?php

		try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
		}
		catch (Exception $e)
		{
			die('Erreur : ' . $e->getMessage());
		}

		$req = $bdd->prepare("SELECT *  FROM FILM");
		$req->execute(array($film));

		while($donnees = $req->fetch()){

			echo '<a href="detailsFilm.php?idfilm=',$donnees['FILM_ID'],'"><li>';
			echo '<h5>',htmlspecialchars($donnees['FILM_TITRE']),"</h5>\n";
			echo '<img src="', $donnees['FILM_AFFICHE'], '">';
			echo "\n</li></a>";

		}

	?>

	</ul>


        <a href="rechercheFilm.html" title="Ajouter film possédé" style="position: fixed; bottom: 0; right: 0;"><div id="badge-plus"><img src="images/plus.png" alt="Ajouter un film possédé"></div></a>
    
    </body>
</html>
