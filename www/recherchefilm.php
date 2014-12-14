<p>Tu veux trouver le film : <?php echo $_POST['Film']; ?></p>
</br>

<?php

        $filmrecherche = $_POST['Film'];

        $object = json_decode(file_get_contents("http://www.omdbapi.com/?s=$filmrecherche"));

        foreach($object->Search as $Film){

                echo '<p>', $Film->Title, '</p></br>';
		$details = json_decode(file_get_contents("http://www.omdbapi.com/?i=$Film->imdbID&plot=short&r=json"));
                echo '<img src="', $details->Poster, '"\/></br>';


        }

?>

