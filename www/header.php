<header>
	<a href="index.php"><img src="images/logo.png" height="140px"></a>
	<div class="license">
		<a rel="license" href="http://creativecommons.org/licenses/by/4.0/">
			<img alt="Licence Creative Commons" src="https://i.creativecommons.org/l/by/4.0/88x31.png" />
		</a>
	</div>
	<span>Cette œuvre est mise à disposition selon les termes de la <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Licence Creative Commons Attribution 4.0 International</a></span>

</header>
<nav>
	<ul>
	<?php
		session_start();
		if ((!isset($_SESSION['login'])) || (empty($_SESSION['login']))){
			// la variable 'login' de session est non déclaré ou vide
			echo '<li><a href="connexion.html" title="Connexion">Connexion</a></li>';
			echo '<li><a href="formulaireinscription.html">Inscription</a></li></nav>';
			exit();
		}
	?>
		<li><a href="index.php"><img src="images/house.png" height="14" weight="14"> Accueil</a></li>
		<li><a href="propos.php"><img src="images/rocket.png" height="14" weight="14"> A propos</a></li>
		<li><a href="userSpace.php"><img src="images/espace.png" height="14" weight="14"> Mon Espace</a></li>
		<li><a href="ajoutAmi.html"><img src="images/heart.png" height="14" weight="14"> Ajouter un(e) ami(e)</a></li>
		<li><a href="deconnexion.php"><img src="images/deconnexion.png" height="14" weight="14"> Déconnexion</a></li>
	</ul>
</nav>
