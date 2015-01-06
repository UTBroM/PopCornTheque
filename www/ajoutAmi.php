<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
	<title>PopcornTeque</title>
	</head>

	<body>

	<?php

		ini_set('display_errors', 'On');

		session_start();
		if ((!isset($_SESSION['login'])) || (empty($_SESSION['login'])))
		{
			// la variable 'login' de session est non déclaré ou vide
			header('Location: index.php'); 
			exit();
		}

		$target_user_id = $_POST['target_user_id'];
		$current_user_id = $_SESSION['login'];

		if($target_user_id == $current_user_id){

			header('Location: index.php');

		}

		echo "Demande d'ami(e) effectuée";

		try{
			$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
		}
		catch (Exception $e){
			die('Erreur : ' . $e->getMessage());
		}

		$req = $bdd->prepare('INSERT INTO ETRE_AMI VALUES(:target_user_id, :current_user_id)');
		$req->execute(array(
			'target_user_id' => $target_user_id,
			'current_user_id' => $current_user_id,
		));

		

	?>

	</body>
</html>
