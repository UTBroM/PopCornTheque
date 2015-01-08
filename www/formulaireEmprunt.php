<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
		<title>PopCornTheque</title>
	</head>
	<body>
		<?php 
			include 'header.php'; 
			
			$current_id_user = $_GET['current_id_user'];
			$current_id_support = $_GET['current_id_support'];
		?>

		<form action="emprunt.php" method="post">
			<p>
				ID de l'emprunteur : <?php echo htmlspecialchars($current_id_user);?><input type="hidden" name="current_id_user" required value="<?php echo htmlspecialchars($current_id_user);?>"/></br>
				<input type="hidden" name="current_id_support" required value="<?php echo htmlspecialchars($current_id_support);?>"/></br>
				Date de retour:<input type="date" name="retour_emprunt_date" required /></br>
				
				<input type="submit" value="Valider">
			</p>

		</form>

	</body>
</html>