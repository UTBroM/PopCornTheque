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

			$req->closeCursor();
		?>
		<section>
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
		</section>
		
		<section>
			<p>
				<h2>Mes demande d'amis<br/></h2>
				<?php 
					$req2->closeCursor();

					$req3 = $bdd->prepare("SELECT * FROM ETRE_AMI WHERE UTI_ID_SOURCE = ? ");
					$req3->execute(array($user));

					while($donnees3 = $req3->fetch()){
						echo htmlspecialchars($donnees3['UTI_ID_CIBLE']), "<br/>";
					}
					$req3->closeCursor();
					
				?>
				<h2>Mes invitations</h2>
				<?php 
					$req4 = $bdd->prepare("SELECT * FROM ETRE_AMI WHERE UTI_ID_CIBLE = ? ");
					$req4->execute(array($user));

					while($donnees4 = $req4->fetch()){
						echo htmlspecialchars($donnees4['UTI_ID_SOURCE']), "<br/>";
					}
					$req4->closeCursor();
				?>
			</p>
		</section>

		<section>
			<p>
				<h2>Mes emprunts<br/></h2>
				<?php 
					$req5 = $bdd->prepare("SELECT * FROM EMPRUNT WHERE UTI_ID = ? ");
					$req5->execute(array($user));

					while($donnees5 = $req5->fetch()){
						echo htmlspecialchars($donnees5['SUP_ID']), "à rendre le ", htmlspecialchars($donnees5['EMPR_RETOUR_THEORIQUE']), "<br/>";
					}
					$req5->closeCursor();
				?>
			</p>
		</section>

		<section>
			<p>
				<h2>Demande d'empreint envoyée<br/></h2>
				<?php 
					$req6 = $bdd->prepare("SELECT S.SUP_ID, F.FILM_ID, F.FILM_TITRE FROM DEMANDE_EMPRUNT AS DE 
													INNER JOIN SUPPORT AS S 
														ON DE.SUP_ID = S.SUP_ID 
													INNER JOIN FILM AS F 
														ON S.FILM_ID = F.FILM_ID  
													WHERE DE.UTI_ID = ? ");
					
					$req6->execute(array($user));
					echo "Vous avez demandé :<br/>";
					while($donnees6 = $req6->fetch()){
						echo '<a href=', "http://popcorntheque.ddns.net/detailsFilm.php?idfilm=", htmlspecialchars($donnees6['FILM_ID']), '>', htmlspecialchars($donnees6['FILM_TITRE']), '</a><br/>';
					}
					$req6->closeCursor();
				?>
			</p>
		</section>

		<section>
			<p>
				<h2>Demande d'empreint reçue<br/></h2>
				<?php 
					$req7 = $bdd->prepare("SELECT S.SUP_ID, F.FILM_ID, F.FILM_TITRE FROM DEMANDE_EMPRUNT AS DE 
													INNER JOIN SUPPORT AS S 
														ON DE.SUP_ID = S.SUP_ID 
													INNER JOIN FILM AS F 
														ON S.FILM_ID = F.FILM_ID  
													WHERE S.UTI_ID = ? ");
					
					$req7->execute(array($user));
					echo "Vous avez demandé :<br/>";
					while($donnees7 = $req7->fetch()){
						echo '<a href=', "http://popcorntheque.ddns.net/detailsFilm.php?idfilm=", htmlspecialchars($donnees7['FILM_ID']), '>', htmlspecialchars($donnees7['FILM_TITRE']), '</a><br/>';
					}
					$req7->closeCursor();
				?>
			</p>
		</section>
	</body>
</html>
