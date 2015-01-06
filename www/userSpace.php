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

			$user = $_SESSION['login'];

			echo "Profil de ",htmlspecialchars($user);

			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
			}
			catch (Exception $e)
			{
				die('Erreur : ' . $e->getMessage());
			}

			$req = $bdd->prepare("SELECT F.FILM_ID, SUP_NOM, FILM_AFFICHE, FILM_TITRE FROM SUPPORT AS S INNER JOIN FILM AS F ON F.FILM_ID = S.FILM_ID WHERE UTI_ID = ?");
			$req->execute(array($user));

			echo "<br/><br/><table>\n<caption><h2>Mes Films</h2></caption>\n";
			echo "<thead>\n<tr>\n<th>Id du film\n<th>Titre\n<th>Nom du support\n<th>\n";
			echo "<tbody>\n";
			while($donnees = $req->fetch()){
				echo "<tr>\n<td>",$donnees['FILM_ID'],"\n<td>",$donnees['FILM_TITRE'],"\n<td>",htmlspecialchars($donnees['SUP_NOM']),"\n";
			}
			echo"</table>";

			$req2 = $bdd->prepare("SELECT * FROM UTILISATEURS WHERE UTI_ID = ?");
			$req2->execute(array($user));
			$donnees2 = $req2->fetch();
			$dateMySQL = $donnees2['UTI_DATE_NAISSANCE'];
			$datenaissance = date("d/m/Y", strtotime($dateMySQL));

		?>
		<p>
			<h2>Mes infos<br/></h2>
			Nom d'utilisateur : <?php echo htmlspecialchars($donnees2['UTI_ID']); ?><br />
			Nom : <?php echo htmlspecialchars($donnees2['UTI_NOM']); ?><br />
			Prénom <?php echo htmlspecialchars($donnees2['UTI_PRENOM']); ?><br />
			Date de naissance : <?php echo $datenaissance; ?><br />
			Rue : <?php echo htmlspecialchars($donnees2['UTI_RUE']); ?><br />
			Code postal : <?php echo $donnees2['UTI_CODE_POSTAL']; ?><br />
			Ville : <?php echo htmlspecialchars($donnees2['UTI_VILLE']); ?><br />
			eMail : <?php echo htmlspecialchars($donnees2['UTI_MAIL']); ?>
		</p>

	</body>
</html>