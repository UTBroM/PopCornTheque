<?php

	ini_set('display_errors', 'On');

	echo "ça marche !";

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

	$req = $bdd->prepare('INSERT INTO FILM VALUES(NULL, :titre, :synopsis, :sortie, :affiche, NULL, :age)');
	$req->execute(array(
		'titre' => $details->Title,
		'synopsis' => $details->Plot,
		'sortie' => $sortie,
		'affiche' => $poster,
		'age' => $details->Rated
	));



?>


