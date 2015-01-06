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

		<ul>
			<li class="menu"><img src="images/films.png" name="Logo films">Films</li>
		</ul>

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


        <a href="rechercheFilm.html" title="Ajouter film possédé"><div id="badge-plus"><img src="images/plus.png" alt="Ajouter un film possédé"></div></a>
    
    </body>
</html>
