<?php
session_start();
$erreur="";
if (isset($_POST['reset'])) {
	$_SESSION=array();
	session_destroy();
	$erreur="Vous avez été déconnecté(e), veuillez vous identifier de nouveau.";
}
	
if (isset($_GET['erreur'])) {
	$erreur=$_GET['erreur'];
}
?>

<!doctype html>
<html>

<head>
    <title>
        Page d'identification
    </title>
    <meta charset="utf-8">

    <link rel="stylesheet" type="text/css" href="RP1.css">
    <link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
</head>


<body>


    <div class="fenetre">
        <h1 class="titre1">Bienvenue sur le site de <span style="white-space: nowrap">WANG RunPu</span></h1>
        <br><br>
        <h1 class="titre2">Page de connection</h1>
        <form id="myform" action="RP1.php" method="post">
            <h2>
                <label>Identifiant : </label>
                <input type="text" , name="pseudo" , required>
                <br><br>
                <label> Mot de passe : </label>
                <input name="password" , required>
            </h2>
            <button type="submit" , onmouseover="color (this.form)" , onmouseout="uncolor()">Valider</button>
        </form>

        <div class="erreur"><?php echo $erreur?>
        </div>
    </div>
    <script>
    function color(formulaire) {
        var button = document.querySelector("button");

        if (((/^[A-Z]{2,9}$/).test(formulaire.pseudo.value)) && ((/^[a-zA-Z0-9]{6,10}$/).test(formulaire.password
                .value))) {
            button.style.backgroundColor = "#00DB29";
        } else {
            button.style.backgroundColor = "#FF2124";
        }
    }

    function uncolor() {
        var button = document.querySelector("button");
        button.style.backgroundColor = "lightgray";
    }
    </script>
</body>

</html>