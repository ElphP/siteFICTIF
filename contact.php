<?php
session_start();
?>
<?php
	if ($_SESSION['connect']) {
		$connection=$_SESSION['connect'];
	}
	else {
		$erreur= "Accès non autorisé . Veuillez vous identifier!";
		header("Location:accueilmdp.php?erreur=".$erreur);

	}
?>
<!doctype html>
<html>

<head>
    <title>
        Me contacter
    </title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="RP1.css">
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
</head>

<body>

    <div class="connect">
        <div class="message"><?php
				echo $connection;
				?>
        </div>
        <form class="deconnect" action="accueilmdp.php" , method="post">
            <button type="submit" , name="reset"><img src="off.png" alt="Bouton de déconnexion" width="35px"
                    height="35px"></button>
        </form>
    </div>

    <div class="page">
        <header>
            <div class="titre">
                <a href='RP1.php?connection= <?php echo $connection?>'>
                    <h1> P' tites gourmandises</h1>

                    <h2> Création de gâteaux sur mesure</h2>
                </a>

            </div>
        </header>

        <nav>

            <div class=" menu_mobile">
                <span class="choix_menu">Menu</span>
                <button class="burger">
                    <span class="bar"></span>

                </button>
            </div>

            <ul class="navbar_lien">
                <li class="navlien"><a href="">Thèmes</a></li>
                <li class="navlien"><a href="">Personnalisation</a></li>
                <li class="navlien"><a href="">Galerie photos</a></li>
                <li class="navlien"><a href="commande.php">Commandes</a></li>
                <li class="navlien"><a href="contact.php">Contact</a></li>
            </ul>


        </nav>

        <div class="contact">

            <h1 class="titre1">Me contacter</h1>
            <hr style="height: 2px; width: 20%; background-color: black; margin: auto">

            <h1 class="titre1">FICTIF Amélie</h1>
            <h2>
                XX XX XX XX XX<br>
                XXXXXX@hotmail.com
            </h2>
        </div>

    </div>


</body>

</html>