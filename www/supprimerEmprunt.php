<?php

	session_start();
	if ((!isset($_SESSION['login'])) || (empty($_SESSION['login'])))
	{
		// la variable 'login' de session est non déclaré ou vide
		header('Location: index.php'); 
		exit();
	}

	$uti_id = $_GET['uti_id'];
	$sup_id = $_GET['sup_id'];

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('DELETE FROM DEMANDE_EMPRUNT WHERE UTI_ID=? AND SUP_ID=?');
	$req->execute(array(
		$uti_id,
		$sup_id
	));

	header("Location: ".$_SERVER['HTTP_REFERER']."");
	
	$req->closeCursor();
?>
