<?php

	ini_set('display_errors', 'On');

	$film = $_POST['film'];

	try
	{
	$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('SELECT *  FROM `FILM` WHERE `FILM_TITRE` LIKE '%:film%'');
	$req->execute(array(
		'film' => $film
	));

	while($donnees = $reponse->fetch()){

		echo htmlspecialchars($donnees['FILM_TITRE']), '<br />';

	}

?>
