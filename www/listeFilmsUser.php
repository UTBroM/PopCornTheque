<?php
	
	ini_set('dispay_errors', 'On');

	$utilisateur_id = $_POST['utilisateur_id'];

	$req = $bdd->prepare('SELECT * FROM SUPPORT WHERE UTI_ID = ?');
	$req->execute(array($utilisateur_id));

	while($donnees = $req->fetch()){
		echo '</br>', $donnees['UTI_ID'], '</br>', $donnees['FILM_ID'], '</br>', $donnees['SUP_NOM'], '</br>';
	}

?>