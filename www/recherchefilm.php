<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="style.css" />
		<title>PopcornTeque</title>
	</head>

	<body>

		<?php include 'header.php'; ?>

		<p>Recherche du film : <?php echo htmlspecialchars($_POST['Film']); ?><br />Cliquez sur le film correspondant</p>
		</br>

		<?php

			ini_set('display_errors', 'On');

			$filmrecherche = urlencode($_POST['Film']);

			$object = json_decode(file_get_contents("http://www.omdbapi.com/?s=$filmrecherche&type=movie"));

			foreach($object->Search as $Film){

				$details = json_decode(file_get_contents("http://www.omdbapi.com/?i=$Film->imdbID&plot=short&r=json"));

				echo '<a href=', "enregistrerfilm.php?detailsfilm=$Film->imdbID", '>', $Film->Title, '<br />';
				$posterURL = $details->Poster;

				if ($posterURL != "N/A"){

					$posterFile = basename($posterURL);
					if(!file_exists("tempPoster/$posterFile")) file_put_contents("tempPoster/$posterFile", file_get_contents("$posterURL"));
					echo '<img src="', "tempPoster/$posterFile", '"><br />';

				}

				echo '</a>';

			}

		?>

	</body>
</html>
