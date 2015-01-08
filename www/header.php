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
		<li><a href="index.php">&#8962; Accueil</a></li>
		<li><a href="userSpace.php">Mon Espace</a></li>
		<li><a href="ajoutAmi.html">Ajouter un(e) ami(e)</a></li>
		<li><a href="deconnexion.php">Deconnexion</a></li>
	</ul>
</nav>
