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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!--Scripts trigger de Materialize-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script src="./resources/script.js"></script>
    </head>

    <style>
        p {
            margin-bottom: 0;
        }
    </style>

    <body class="container">

        <?php
            include('model/bd_planning.php');
            include('model/Joueur.php');

            $creneaux = mysqli_query($co, 'SELECT * FROM creneaux ORDER BY jour_debut') or die("Impossible d'exécuter la requête des créaneaux.");

            if (empty($_SESSION)) header('Location:../index.php');
            else {
                if (!$_SESSION['is_admin']) header('Location:../index.php');
                else { ?>

                        <div class="card-panel center semaine" style="margin-top: 20px;">
                            <h3 style="margin-top: 0">💻</h3><h4 style="margin-bottom: 10px; margin-top: 10px;" class="lobster">Back-office - Gérer les créneaux</h4>
                        
                            <a href="controler/deconnexion.php" style="margin-top: 5px" class="red btn waves-effect waves-light">Se déconnecter</a>
                            <a href="./index.php" style="margin-top: 5px" class="blue btn waves-effect waves-light">retour à l'accueil</a>
                        </div>
                <?php
                    foreach ($creneaux as $creneau) {?>

                        <div class="card-panel center semaine">
                            <h5>Créneaux de la semaine n°<?= $creneau['id_creneau'] ?></h5>

                            <div class="row">
                                <div class="col s6">
                                    <p>Jour du début</p>
                                    <input type="text" id="debut_datepicker<?= $creneau['id_creneau'] ?>" class="datepicker">
                                </div>
                                <div class="col s6">
                                    <p>Jour de fin</p>
                                    <input type="text" id="fin_datepicker<?= $creneau['id_creneau'] ?>" class="datepicker">
                                </div>
                            </div>

                            <?php
                                for ($i = 0; $i < $nbCreneaux; $i++){ ?>
                                    <div class="row">
                                        <div class="col s4">
                                            <p>Jour du créneau</p>
                                            <input type="text" id="jour_<?= $i . $creneau['id_creneau'] ?>" class="datepicker">
                                        </div>
                                        <div class="col s4">
                                            <p>Heure de début</p>
                                            <input type="text" id="heure_debut<?= $i . $creneau['id_creneau'] ?>" class="datepicker">
                                        </div>
                                        <div class="col s4">
                                            <p>Heure de fin</p>
                                            <input type="text" id="heure_fin<?= $i . $creneau['id_creneau'] ?>" class="datepicker">
                                        </div>

                                        <script>
                                            $(document).ready(function(){
                                                $('#debut_datepicker<?= $i . $creneau['id_creneau'] ?>').datepicker('setDate', '<?= $creneau['jour_debut'] ?>');
                                                $('#fin_datepicker<?= $i . $creneau['id_creneau'] ?>').datepicker('setDate', '<?= $creneau['jour_debut'] ?>');

                                                $('#jour_<?= $i . $creneau['id_creneau'] ?>').datepicker('setDate', '<?= $creneau['creneau_' . $i . '_jour'] ?>');
                                                $('#heure_debut<?= $i . $creneau['id_creneau'] ?>').datepicker('setDate', '<?= $creneau['creneau_' . $i . '_horaire_debut'] ?>');
                                                $('#heure_fin<?= $i . $creneau['id_creneau'] ?>').datepicker('setDate', '<?= $creneau['creneau_' . $i . '_horaire_fin'] ?>');
                                                
                                                $('.datepicker').datepicker('setInputValue');
                                                //$('.timepicker').timepicker('setInputValue');
                                            });
                                        </script>
                                    </div>
                                <?php } ?>
                        </div>
                <?php }
                }
            } ?>
    </body>
    
</html>