<?php
	
	ini_set('display_errors', 'On');
	$target_user_id = $_POST['target_user_id'];
	$current_user_id = $_POST['current_user_id'];

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('INSERT INTO ETRE_AMI VALUES(:target_user_id, :current_user_id)');
	$req = execute(array(
		'target_user_id' => $target_user_id,
		'current_user_id' => $current_user_id,
	));

?>