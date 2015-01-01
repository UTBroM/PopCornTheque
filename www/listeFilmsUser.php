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

	$req = $bdd->prepare('SELECT FILM_ID, UTI_ID, SUP_NOM  FROM SUPPORT = S WHERE UTI_ID = ? IN (SELECT FILM_ID, FILM_AFFICHE FROM FILM = F WHERE S.FILM_ID = F.FILM_ID)');
	$req->execute(array($utilisateur_id));


	echo " Nom d'utilisateur 	Id du film 		Nom du support"
	while($donnees = $req->fetch()){
		echo '</br>', htmlspecialchars($donnees['UTI_ID']),' ' ,htmlspecialchars($donnees['S.FILM_ID']),' ',htmlspecialchars($donnees['SUP_NOM']), '</br>';
		echo '<img src="', $donnees['FILM_AFFICHE'], '</br>';
	}

?>