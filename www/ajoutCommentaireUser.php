<?php
	
	ini_set('display_errors', 'On');


	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('');
	$req = execute(array(


	));

?>