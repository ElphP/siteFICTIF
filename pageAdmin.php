<?php
session_start();
?>
<?php
if ($_SESSION['connect']) {
		$connection=$_SESSION['connect'];
        $erreur="";
        $success="";
        $erreur2="";
        $success2="";
        
		
       
   
if (isset($_GET['erreur'])) {
	$erreur=$_GET['erreur'];
}


    if (isset($_POST['pseudo']) && isset($_POST['sexe'])) {
            
			$pseudo=$_POST['pseudo'];
			$sexe=$_POST['sexe'];

	
            
            if  (isset($_POST['email']))  {
             $email=$_POST['email'];   
            }
            else {$email="";}
            
            if  (isset($_POST['date']))  {
             $date=$_POST['date'];   
            }
            else {$date="0000-00-00";}

           
            $REG1="/^[A-Z]{2,9}$/";
            $REG2="/^(H|F)$/";

            
            if(!((preg_match($REG1,$pseudo))&&((preg_match($REG2,$sexe)))))  {
               $erreur="<p>Le pseudo ou le sexe ne sont pas au bon format!</p>";
					header("Location:pageAdmin.php?erreur=".$erreur);
            }

            else {
			$link=mysqli_connect("127.0.0.1","root","","password");
				if (!$link) {
					$erreur="<p>Problème de connexion au serveur.</p>";
					header("Location:pageAdmin.php?erreur=".$erreur);
				}
				else {
                    $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                    $shfl = str_shuffle($comb);
                    $pwd = substr($shfl,0,8);       
                    $sql= "INSERT INTO membres VALUES (NULL,'$pseudo','$pwd','$sexe','$email','$date','0')";
                   
					if(!mysqli_query ($link,$sql)) {
						$erreur="<p>Problème d'échange de données avec le serveur.</p>";
					}
                    else {$success="Le nouveau membre a été inscrit dans la base de données!";}
                 }
   

}}
    else if(isset($_POST['ID']))  {
        $ID=$_POST['ID'];
        $link=mysqli_connect("127.0.0.1","root","","password");
				if (!$link) {
					$erreur="<p>Problème de connexion au serveur.</p>";
					header("Location:pageAdmin.php?erreur=".$erreur);
				}
				else {
                          
                    $sql= "DELETE FROM membres WHERE ID='$ID'";
                   
					if(!mysqli_query ($link,$sql)) {
						$erreur2="<p>Problème d'échange de données avec le serveur.</p>";
					}
                    else {$success2="Le membre a bien été supprimé, son accès sera refusé!";}
                 }
    }

	}
	else {
		$erreur= "Problème sur la page administrateur . Veuillez vous identifier de nouveau!";
		header("Location:index.php?erreur=".$erreur);
	}
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Page Administration </title>
    <link rel="stylesheet" type="text/css" href="RP1.css">

    <link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
</head>

<body>

    <div class="connect fenetreAdmin">
        <h1 class="title">Page réservée à l'administration</h1>
        <div class="message"><?php
				echo $connection;
				?>
        </div>
        <form class="deconnect" action="index.php" , method="post">
            <button type="submit" , name="reset"><img src="off.png" alt="Bouton de déconnexion" width="35px"
                    height="35px"></button>
        </form>
        <h2>Liste des contacts</h2>

        <?php 
         $link=mysqli_connect("127.0.0.1","root","","password");
				if (!$link) {
					$erreur="<p>Problème de connexion au serveur.</p>";
					header("Location:pageAdmin.php?erreur=".$erreur);
				}
				else {     
					$resultat=mysqli_query($link, "SELECT * FROM membres");
					
                    if(!$resultat) {
						$erreur="<p>Problème d'échange de données avec le serveur.</p>";
						header("Location:pageAdmin.php?erreur=".$erreur);
					}
                    
					else {
   
        $table="<table>
            <tr>
                <th>ID</th>
                <th>Pseudo</th>
                <th>Mot de passe</th>
                <th>Sexe</th>
                <th>Email</th>
                <th>Date de naissance</th>
                <th>Administrateur</th>
            </tr>";
        
        
        while ($ligne=mysqli_fetch_array($resultat))  {
			                               
          $table .= "<tr>". 
          '<td>'.$ligne['ID']  .'</td>'. 
          '<td>'.$ligne['pseudo']  .'</td>'. 
          '<td>'.$ligne['mdp']  .'</td>'.    
          '<td>'.$ligne['sexe']  .'</td>'. 
          '<td>'.$ligne['email']  .'</td>'. 
          '<td>'.$ligne['Date_de_naissance']  .'</td>'. 
          '<td>'.$ligne['Admin']  .'</td>'. 
           "</tr>" ;
                                      
		} ;
        
        $table .=  '</table>';
     
    }}
           
            
            echo $table;  
            ?>


        <div class="ajout">
            <h2>Ajouter un contact</h2>
            <fieldset>
                <form action="pageAdmin.php" method="post">
                    <input type="text" name="pseudo" id="pseudo" placeholder="pseudo en Majuscules" required>
                    <input type=" text" name="sexe" id="sexe" placeholder="Sexe: H ou F" required>
                    <input type=" email" name="email" id="email" placeholder="email">
                    <input type="date" name="date" id="date" placeholder="Date de naissance">
                    <input class="btn" type="submit" value="Enregistrer">
                </form>
            </fieldset>
            <?php echo $erreur;
            echo $success;                 
            ?>
        </div>
        <div class="suppr">
            <h2>Supprimer un contact</h2>
            <fieldset>
                <form action="pageAdmin.php" method="post">
                    <input type="number" name="ID" id="ID" placeholder="ID du contact à supprimer" required>

                    <input class="btn" type="submit" value="Supprimer">
                </form>
            </fieldset>
            <?php echo $erreur2;
            echo $success2;                 
            ?>
        </div>



</body>

</html>