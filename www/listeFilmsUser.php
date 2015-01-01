<?php
	
	ini_set('dispay_errors', 'On');

	$utilisateur_id = $_POST['utilisateur_id'];

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('SELECT * FROM SUPPORT WHERE UTI_ID = ?');
	$req->execute(array($utilisateur_id));

	while($donnees = $req->fetch()){
		echo '</br>', $donnees['UTI_ID'], '</br>', $donnees['FILM_ID'], '</br>', $donnees['SUP_NOM'], '</br>';
	}

?>