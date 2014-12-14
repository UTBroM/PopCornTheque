<p>Tu veut trouver le film : <?php echo $_POST['Film']; ?></p>

<?php

	$filmrecherche = $_POST['Film'];

	$object = json_decode(file_get_contents("http://www.omdbapi.com/?s=$filmrecherche"));

	foreach($object->Search as $Film){

		echo 'Nom du Film : '.$Film->Title'<br />';

	}

?>
