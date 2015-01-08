<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
	<link rel="stylesheet" href="style.css" />
	<title>PopcornTeque</title>
	</head>

	<body>

	<?php
		include 'header.php'; 
		ini_set('display_errors', 'On');

		if(isset($_POST['target_user_id'])){

			$target_user_id = $_POST['target_user_id'];

		}
		else{

			$target_user_id = $_GET['target_user_id'];

		}

		$current_user_id = $_SESSION['login'];

		if($target_user_id == $current_user_id){

			header('Location: index.php');
			exit();

		}

		echo "Demande d'ami(e) effectuée";

		include 'connexionBDD.php';

		$req = $bdd->prepare('INSERT INTO ETRE_AMI VALUES(:target_user_id, :current_user_id)');
		$req->execute(array(
			'target_user_id' => $target_user_id,
			'current_user_id' => $current_user_id,
		));

	?>

	</body>
</html>
