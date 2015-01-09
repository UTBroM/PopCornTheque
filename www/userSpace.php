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

			echo '<h1>Profil de ',htmlspecialchars($user), "</h1>";

			include 'connexionBDD.php';
		?>

		<table border="1">
			<caption><h2>Mes Films</h2></caption>
			<thead>
				<tr>
				<th>Titre du film
				<th>Nom du Support
			<tbody>
		<?php
			$req = $bdd->prepare("SELECT F.FILM_ID, SUP_NOM, FILM_AFFICHE, FILM_TITRE FROM SUPPORT AS S INNER JOIN FILM AS F ON F.FILM_ID = S.FILM_ID WHERE UTI_ID = ? ORDER BY F.FILM_TITRE");
			$req->execute(array($user));

			while($donnees = $req->fetch()){
				echo "<tr>\n<td>",$donnees['FILM_TITRE'],"\n<td>",htmlspecialchars($donnees['SUP_NOM']),"\n";
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
				<h2>Mes amis<br/></h2>
				<?php 
					$req2->closeCursor();

					$req3 = $bdd->prepare("SELECT * FROM ETRE_AMI WHERE UTI_ID_SOURCE = ? ");
					$req3->execute(array($user));

					while($donnees3 = $req3->fetch()){
						echo '<a href="listeFilmsUser.php?utilisateur_id=', htmlspecialchars($donnees3['UTI_ID_CIBLE']),'">',htmlspecialchars($donnees3['UTI_ID_CIBLE']), "</a><br/>";
					}
					$req3->closeCursor();
					
				?>
				<h2>Followers</h2>
				<?php 
					$req4 = $bdd->prepare("SELECT * FROM ETRE_AMI WHERE UTI_ID_CIBLE = ? ");
					$req4->execute(array($user));

					echo '<ul>';

					while($donnees4 = $req4->fetch()){
						echo '<li>', htmlspecialchars($donnees4['UTI_ID_SOURCE']);
						echo '<a href="http://popcorntheque.ddns.net/ajoutAmi.php?target_user_id=', $donnees4['UTI_ID_SOURCE'], '">Ajouter aux amis</a>';
					}

					echo '</ul>';

					$req4->closeCursor();
				?>
			</p>
		</section>

		<section>
			<table border="1">
				<caption><h2>Mes Films</h2></caption>
				<thead>
					<tr>
					<th>Titre du film
					<th>Date de Retour
				<tbody>				
				<?php 
					$req5 = $bdd->prepare("SELECT E.EMPR_RETOUR_THEORIQUE, F.FILM_TITRE FROM EMPRUNT AS E INNER JOIN SUPPORT AS S ON E.SUP_ID = S.SUP_ID INNER JOIN FILM AS F ON S.FILM_ID = F.FILM_ID WHERE E.UTI_ID = ? AND EMPR_RENDU = FALSE");
					$req5->execute(array($user));

					while($donnees5 = $req5->fetch()){
						echo "<tr>\n<td>", htmlspecialchars($donnees5['FILM_TITRE']), "\n<td>", date("d/m/Y", strtotime($donnees5['EMPR_RETOUR_THEORIQUE'])), "\n";
					}
					echo"</table>";
					$req5->closeCursor();
				?>
			</p>
		</section>

		<section>
			<p>
				<h2>Mes prets<br/></h2>
				<?php 
					$req5 = $bdd->prepare("SELECT S.UTI_ID, E.EMPR_RETOUR_THEORIQUE, F.FILM_TITRE, E.UTI_ID, E.EMPR_ID FROM EMPRUNT AS E INNER JOIN SUPPORT AS S ON E.SUP_ID = S.SUP_ID INNER JOIN FILM AS F ON S.FILM_ID = F.FILM_ID WHERE S.UTI_ID = ? AND EMPR_RENDU = FALSE");
					$req5->execute(array($user));

					while($donnees5 = $req5->fetch()){
						echo htmlspecialchars($donnees5['FILM_TITRE']), "    a été emprunté par    ", htmlspecialchars($donnees5['UTI_ID']), "    et devra etre rendu le    ", date("d/m/Y", strtotime($donnees5['EMPR_RETOUR_THEORIQUE']));
						echo '     <a href="retour.php?emprunt_id=', htmlspecialchars($donnees5['EMPR_ID']), '">Rendu</a><br/>';
					}
					$req5->closeCursor();
				?>
			</p>
		</section>

		<section>
			<table border="1">
				<caption><h2>Vous voulez emprunter :</h2></caption>
				<thead>
					<tr>
					<th>Utilisateur
					<th>Titre du film
					<th>Annuler la demande
				<tbody>

				<?php 
					$req6 = $bdd->prepare("SELECT S.SUP_ID, S.UTI_ID ,F.FILM_ID, F.FILM_TITRE FROM DEMANDE_EMPRUNT AS DE 
													INNER JOIN SUPPORT AS S 
														ON DE.SUP_ID = S.SUP_ID 
													INNER JOIN FILM AS F 
														ON S.FILM_ID = F.FILM_ID  
													WHERE DE.UTI_ID = ? ");
					
					$req6->execute(array($user));
					while($donnees6 = $req6->fetch()){
						echo '<tr><td>', $donnees6['UTI_ID'];
						echo '<td><a href=', "detailsFilm.php?idfilm=", htmlspecialchars($donnees6['FILM_ID']), '>', htmlspecialchars($donnees6['FILM_TITRE']), '</a>';
						echo '<td><a href="supprimerEmprunt.php?uti_id=', htmlspecialchars($user), '&sup_id=', htmlspecialchars($donnees6['SUP_ID']), '">Supprimer</a>';
					}
					$req6->closeCursor();
				?>
			</table>
		</section>

		<section>
			<p>
				<?php 
					$req7 = $bdd->prepare("SELECT DE.UTI_ID, S.SUP_ID, F.FILM_ID, F.FILM_TITRE FROM DEMANDE_EMPRUNT AS DE 
													INNER JOIN SUPPORT AS S 
														ON DE.SUP_ID = S.SUP_ID 
													INNER JOIN FILM AS F 
														ON S.FILM_ID = F.FILM_ID  
													WHERE S.UTI_ID = ? AND S.SUP_LIBRE = 1");
					
					$req7->execute(array($user));

				?>

				<table border="1">
					<caption><h2>On veut vous emprunter :</h2></caption>
					<thead>
						<tr>
						<th>Utilisateur
						<th>Titre du film
						<th>Créer l'emprunt
						<th>Refuser la demande
					<tbody>

					<?php
						while($donnees7 = $req7->fetch()){
							echo '<tr><td>', $donnees7['UTI_ID'];
							echo '<td><a href=', "detailsFilm.php?idfilm=", htmlspecialchars($donnees7['FILM_ID']), '>', htmlspecialchars($donnees7['FILM_TITRE']), '</a>';
							echo '<td><a href="formulaireEmprunt.php?current_id_user=', htmlspecialchars($donnees7['UTI_ID']), '&current_id_support=', htmlspecialchars($donnees7['SUP_ID']), '">Valider</a>';
							echo '<td><a href="supprimerEmprunt.php?uti_id=', htmlspecialchars($donnees7['UTI_ID']), '&sup_id=', htmlspecialchars($donnees7['SUP_ID']), '">Supprimer</a>';
						}
						$req7->closeCursor();
					?>

				</table>

			</p>
		</section>
	</body>
</html>
