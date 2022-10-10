<?php
session_start();
?>
<?php
if (isset($_GET['connection'])) {
	$connection=$_SESSION['connect'];
}
else{
	$_SESSION['connect']='';
	$identifiant="";
	$erreur="";

	if (isset($_POST['pseudo']) & isset($_POST['password'])) {
			$_SESSION['pseudo']=$_POST['pseudo'];
			$_SESSION['mdp']=$_POST['password'];
	
			$pseudo=$_SESSION['pseudo'];
			$mdp=$_SESSION['mdp'];
			
            $REG1="/^[A-Z]{2,9}$/";
            $REG2="/^[a-zA-Z0-9]{6,10}$/"; 


            if(!((preg_match($REG1,$pseudo))&&((preg_match($REG2,$mdp)))))  {
               $erreur="<p>L'identifiant ou le mot de passe ne sont pas au bon format!</p>";
					header("Location:index.php?erreur=".$erreur);
            }

            else {
			$link=mysqli_connect("127.0.0.1","root","","password");
				if (!$link) {
					$erreur="<p>Problème de connexion au serveur.</p>";
					header("Location:index.php?erreur=".$erreur);
				}
				else {  
                        
					$resultat=mysqli_query($link, "SELECT * FROM membres");
					if(!$resultat) {
						$erreur="<p>Problème d'échange de données avec le serveur.</p>";
						header("Location:index.php?erreur=".$erreur);
					}
					else {
                        
                        $erreur="";
                        while ($ligne=mysqli_fetch_array($resultat)) {
							if ($ligne['pseudo']==$pseudo) { 
								$identifiant="entree";
								if ($ligne['mdp']==$mdp) {
									if($ligne['Admin']=="1")  {
                                       $connection=" Bonjour ".$pseudo;
										$_SESSION['connect']="Connexion réussie";
                                        header("Location:pageAdmin.php?pseudo=".$pseudo);
                                    }
                                    else {
                                        if ($ligne['sexe']=="F") {
										$connection=" Bonjour ".$pseudo."!<br> Vous êtes connectée!";
										$_SESSION['connect']="Vous êtes connectée.";
									}
									else {
										$connection=" Bonjour ".$pseudo."!<br> Vous êtes connecté!";
										$_SESSION['connect']=" Bonjour ".$pseudo."!<br> Vous êtes connecté!";
									}
                                    }
									
								}
								else {
									$erreur="<p>Mot de passe non valide!</p>";
									header("Location:index.php?erreur=".$erreur);
								}
							}	
						}
						if ($identifiant=="") {
						$erreur="<p>Identifiant non valide!</p>";
						header("Location:index.php?erreur=".$erreur);
						}	
					}
					
				}}
	}
	
}
	
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title> P'tites gourmandises - création gâteaux sur mesure </title>
    <link rel="stylesheet" type="text/css" href="RP1.css">

    <link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
</head>

<body>
    <div class="connect">
        <div class="message"><?php
				echo $connection;
				?>
        </div>
        <form class="deconnect" action="index.php" , method="post">
            <button type="submit" , name="reset"><img src="off.png" alt="Bouton de déconnexion" width="35px"
                    height="35px"></button>
        </form>
    </div>

    <div class="page">
        <header>
            <div class="titre">
                <h1> P'tites gourmandises</h1>

                <h2> Création de gâteaux sur mesure</h2>
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

        <section>
            <div class="titrepresent">Bonjour et bienvenue sur mon site !</div>
            <p class="presentation">
                Je vous propose de découvrir mon univers autour des gâteaux que je confectionne.
                <b>Mes
                    créations</b> peuvent être personalisées selon vos souhaits pour: <b>une fête, un anniversaire
                    ou
                    d'autres
                    évènements particuliers de votre vie</b> . Je propose également des
                <b>gâteaux standards</b> que vous pouvez
                retrouver et choisir à partir de ma galerie de photos. Bonne découverte!
            <p class="presentation fin">
                N'hésitez pas à me contacter si vous désirez avoir plus de renseignements! <br><br>
            </p>
            </p>
            <h3>Wang RunPu</h3>
            <div class=" galerie">
                <h1>Quelques gâteaux de ma création...</h1>
                <div class="slideshow"><img src="1.jpg" alt="Gâteau1" class="slide"><img src="2.jpg" alt="Gâteau2"
                        class="slide"><img src="3.jpg" alt="Gâteau3" class="slide"><img src="4.jpg" alt="Gâteau4"
                        class="slide"></div>
            </div>
        </section>
        <footer>
            <div class="footer2">
                <ul>
                    <li class="footerli"><a href="">Thèmes</a></li>
                    <li class="footerli"><a href="">Personnalisation</a></li>
                    <li class="footerli"><a href="">Galerie photos</a></li>
                    <li class="footerli"><a href="">Commandes</a></li>
                    <li class="footerli"><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer1">© Copyright 2021 By L-FÈJ-P </div>
        </footer>
    </div>
    <script src="RP1.js"></script>
</body>

</html>