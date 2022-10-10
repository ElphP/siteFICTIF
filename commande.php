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
        Tarifs/Commande
    </title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="RP1.css">
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
</head>

<body class="contact">

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
                    <h1> P'tites gourmandises</h1>

                    <h2> Création de gâteaux sur mesure</h2>
                </a>

            </div>
        </header>

        <nav>

            <div class="menu_mobile">
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
        <h1 class="titre1">Commandes & Tarifs</h1>
        <hr style="height: 2px; width: 20%; background-color: black; margin: auto">

        <div class="commande">
            <div class="standard">
                <fieldset>
                    <legend>Commande de gâteau standard</legend>
                    <br>
                    <p>Ces gâteaux sont confectionnés avec de la genoise, de la crème et des fruits.</p><br>
                    <form action="commande1" method="post">
                        <input type='radio' name='taille' value='petit' /><label for="petit"> Petit modèle 3/5P : 25 €
                        </label> <br />
                        <input type='radio' name='taille' value='grand' /><label for="grand"> Grand modèle 6/8P :
                            42 €</label><br><br>
                        <p>Suppléments pour la décoration: <br><input type="checkbox" name="choc"> <label for="choc">
                                Chocolat 3 €</label><br>
                            <input type="checkbox" name="fruit"> <label for="fruit"> Fruits 3 €</label>
                        </p>
                        <br><br>
                        <input type="checkbox" name="livr"><label for="livr"> Livraison sur Lyon : 5 €</label>
                        <br><br>
                        <input type="submit" value="Valider la commande">
                    </form>
                </fieldset>


            </div>
            <div class=" personal">
                <h2>Personnalisation à partir de 68€</h2><br>

                <label for="perso">Décrivez-moi vos envies ici!</label><br><br>
                <form action="commande2" method="post">
                    <textarea name="perso" id="perso" cols="40" rows="10"></textarea><br><br>
                    <input type="submit" value="Envoyer votre demande">
                </form>
            </div>
        </div>

    </div>





</body>

</html>