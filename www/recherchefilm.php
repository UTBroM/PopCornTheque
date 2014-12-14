<?php

	$object = json_decode(file_get_contents("http://www.omdbapi.com/?s=$_POST['Film']"));

	foreach($object->Search as $Film){

		echo 'Nom du Film : '.$Film->Title'<br />';

	}

?>
