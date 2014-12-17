<p>Tu veux trouver le film : <?php echo htmlspecialchars($_POST['Film']); ?></p>
</br>

<?php

        echo ini_get('max_execution_time');
        ini_set('display_errors', 'On');
        $t1=time();

        $filmrecherche = $_POST['Film'];

        $object = json_decode(file_get_contents("http://www.omdbapi.com/?s=$filmrecherche"));

        foreach($object->Search as $Film){

                echo '<p>', $Film->Title, '</p></br>';
                $details = json_decode(file_get_contents("http://www.omdbapi.com/?i=$Film->imdbID&plot=short&r=json"));
                $posterURL = $details->Poster;

                if ($posterURL != "N/A"){

                        $posterFile = basename($posterURL);
                        if(file_exists("tempPoster/$posterFile"){ file_put_contents("tempPoster/$posterFile", file_get_contents("$posterURL"));}
                        echo '<img src="', "tempPoster/$posterFile", '"></br>';

                }



        }

        $t2=time();

        $t_lapsed=$t2-$t1;
        echo "Temps d'execution = $t_lapsed";

?>

