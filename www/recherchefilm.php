<p>Tu veux trouver le film : <?php echo htmlspecialchars($_POST['Film']); ?></p>
</br>

<?php

        $filmrecherche = $_POST['Film'];

        $object = json_decode(file_get_contents("http://www.omdbapi.com/?s=$filmrecherche"));

        foreach($object->Search as $Film){

                echo '<p>', $Film->Title, '</p></br>';
		$details = json_decode(file_get_contents("http://www.omdbapi.com/?i=$Film->imdbID&plot=short&r=json"));
                $posterURL = $details->Poster;

                if ($posterURL != "N/A"){

                        //$posterFile = basename($posterURL);
                        //file_put_contents(tempPoster/$posterFile, fopen($posterURL, 'r'));
                        echo '<img src="', $posterURL, '"></br>';

                }



        }

?>

