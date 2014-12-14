<?php

	$filmrecherche = $_POST['Film'];

	echo "Recherche pour : {$filmrecherche}";

	$object = json_decode(file_get_contents("http://www.omdbapi.com/?s=$filmrecherche"));

	foreach($object->Search as $Film){

		echo 'Nom du Film : '.$Film->Title'<br />';

	}

?>
