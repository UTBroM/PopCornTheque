<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
        <title>PopcornTeque</title>
    </head>

    <body>
    	<header>
            <a href="index.html"></a><img src="images/logoPopCornTheque.png" height="60px">
    	</header>
    	<nav>
    		<ul>
		<?php
			session_start();
			if ((!isset($_SESSION['login'])) || (empty($_SESSION['login'])))
			{
			// la variable 'login' de session est non déclaré ou vide
			echo '<li><a href="connexion.html" title="Connexion">Connexion</a></li>';
			echo '<li><a href="formulaireinscription.html">Inscription</a></li></nav>';
			exit();
			}
		?>
                <li><a href="rechercheFilm.html">Ajouter film</a></li>
    			<li><a href="ajoutAmi.html">Ajouter un(e) ami(e)</a></li>
    			<li><a href="ajoutCommentaireFilm.html">Ajouter un commentaire sur un film</a></li>
    			<li><a href="ajoutCommentaireUser.html">Ajouter un commentaire sur un user</a></li>
    			<li><a href="demandeEmprunt.html">Faire une demande d'emprunt</a></li>
    			<li><a href="emprunt.html">Emprunter</a></li>
                <li><a href="listeFilmsUser.html">Liste des Films par user</a></li>
			<li><a href="filtrageFilms.html">Filtrage</a></li>
			<li><a href="deconnexion.html">Deconnexion</a></li>
    		</ul>
    	</nav>
		<h1>Bienvenue sur PopcornTeque</h1>

		<ul>
			<li class="menu"><img src="images/films.png" name="Logo films">Films</li>
		</ul>

		<div class="tableau-film">				
			<ul>
				<li>
					<div>
						<h1>Tron</h1>
						<img class="tableau-film-image" src="images/tron.png">
					</div>
				</li>
				<li>
					<div>
						<h1>Hobbit</h1>
						<img class="tableau-film-image" src="images/hobbit.png">
					<div>
				</li>
			</ul>
		</article>

        <a href="ajoutSupport.html" title="Ajouter Support"><div id="badge-plus"><img src="images/plus.png" alt="Ajouter un Support"></div></a>
    
    </body>
</html>
