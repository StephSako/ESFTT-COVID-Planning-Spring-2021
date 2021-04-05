<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>ESFTT Planning 2021</title>
	<link rel="icon" href="resources/icons/icon.svg">
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lobster" />
	<!--Import materialize.css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!--Import my own style.css-->
	<link type="text/css" rel="stylesheet" href="resources/style.css" media="screen,projection" />
</head>

    <body class="container">
        <?php
            include('model/Joueur.php');
            if (!empty($_SESSION)){ header('Location:../index.php');} else { ?>

            <div class="card-panel center" style="margin-top: 40px">
                <h4 class="center lobster">Connexion</h3>
            
                <form action="controler/connexion.php" method="POST">
                    <div class="container">
                        <div class="input-field">
                            <i class="material-icons prefix">account_circle</i>
                            <input id="username" name="_username" type="text" autocapitalize="off" class="validate">
                            <label for="username">Votre pseudo</label>
                        </div>
                        <div class="input-field">
                            <i class="material-icons prefix">lock</i>
                            <input id="password" name="_password" type="password" class="validate">
                            <label for="password">Votre mot de passe</label>
                        </div>
                    </div>

                    <button style="margin-bottom: 20px" class="btn waves-effect waves-light blue lighten-2">C'est parti !</button>
                </form>
            </div>

        <?php } ?>
	</body>

    <!--Scripts trigger de Materialize-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>

</html>