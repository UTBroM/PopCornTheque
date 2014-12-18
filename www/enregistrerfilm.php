<?php

        ini_set('display_errors', 'On');

        echo "ça marche !";


        $details = json_decode(file_get_contents("http://www.omdbapi.com/?i=$_GET['detailsfilm']&plot=full&r=json"));

        $sortie = date(Y-m-d,strtotime($details->Released));
        $poster = tempPoster/basename($details->Poster);

        try
        {
                $bdd = new PDO('mysql:host=localhost;dbname=PopCornTheque', 'poppoppop', 'nnd47D2JQWAzh97H');
        }
        catch (Exception $e)
        {
                die('Erreur : ' . $e->getMessage());
        }

        $req = $bdd->prepare('INSERT INTO FILM VALUES(NULL, :titre, :synopsis, :sortie, :affiche, NULL, :age)');
        $req->execute(array(
                'titre' => $details->Title,
                'synopsis' => $details->Plot,
                'sortie' => $sortie,
                'affiche' => $poster,
                'age' => $details->Rated
        ));



?>

