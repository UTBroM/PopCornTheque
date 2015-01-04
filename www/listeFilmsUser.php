<?php
	
	ini_set('dispay_errors', 'On');

	$utilisateur_id = $_POST['utilisateur_id'];

	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	$req = $bdd->prepare('SELECT F.FILM_ID, SUP_NOM, FILM_AFFICHE FROM SUPPORT AS S INNER JOIN FILM AS F ON F.FILM_ID = S.FILM_ID WHERE UTI_ID = ?');
	$req->execute(array($utilisateur_id));

	echo "<table>\n<caption>Liste des support de ", htmlspecialchars($utilisateur_id),"</caption>\n";
	echo "<thead>\n<tr>\n<th>Id du film\n<th>Nom du support\n";
	echo "<tbody>\n";
	while($donnees = $req->fetch()){
		echo "<tr>\n<td>",$donnees['FILM_ID'],'<td>',htmlspecialchars($donnees['SUP_NOM']);
		echo '<img src="', $donnees['FILM_AFFICHE'], '"></br>';
	}
	echo"</table>";

?>
