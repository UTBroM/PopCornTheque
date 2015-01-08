<header>
	<a href="index.php">
		<img src="images/logo.png" height="120px">
	</a>
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
		<li><a href="index.php"><img src="images/home.svg"> Accueil</a></li>
		<li><a href="propos.php"><img src="images/rocket.svg"> A propos</a></li>
		<li><a href="userSpace.php"><img src="images/espace.svg"> Mon Espace</a></li>
		<li><a href="ajoutAmi.html"><img src="images/heart.svg"> Ajouter un(e) ami(e)</a></li>
		<li><a href="deconnexion.php"><img src="images/deconnexion.svg"> Déconnexion</a></li>
	</ul>
	
</nav>
