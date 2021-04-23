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

        .card-panel {
            margin-top: 20px !important;
            margin-bottom: 20px !important;
        }
    </style>

    <body>
        <div class="container">

        <?php
            setlocale(LC_TIME, "fr_FR", "French");
            include('model/bd_planning.php');
            include('model/Joueur.php');

            $creneaux = mysqli_query($co, 'SELECT * FROM creneaux ORDER BY jour_debut, jour_fin, id_creneau') or die("Impossible d'exécuter la requête des créaneaux.");

            if (empty($_SESSION)) header('Location:../index.php');
            else {
                if (!$_SESSION['is_admin']) header('Location:../index.php');
                else { ?>
                        <div class="card-panel center semaine" style="margin-top: 20px;">
                            <h3 style="margin-top: 0">💻</h3><h4 style="margin-bottom: 10px; margin-top: 10px;" class="lobster">Back-office - Gérer les créneaux</h3>
                        
                            <a href="controler/deconnexion.php" style="margin-top: 5px" class="red btn waves-effect waves-light">Se déconnecter</a>
                            <a href="./index.php" style="margin-top: 5px" class="blue btn waves-effect waves-light">retour à l'accueil</a>
                        </div>

                        <ul class="collapsible">
                            <li>
                                <div class="collapsible-header"><i class="material-icons">date_range</i><b>Créer une semaine</b></div>
                                <div class="collapsible-body center" style="background-color: white;">
                                    <form class="col s12" method="POST" action="controler/creation_creneau.php">
                                            <h5 class="lobster">Nouvelle semaine</h5>

                                            <div class="row">
                                                <div class="col s6">
                                                    <p><b>Jour du début</b></p>
                                                    <input type="text" name="jour_debut" class="datepicker">
                                                </div>
                                                <div class="col s6">
                                                    <p><b>Jour de fin</b></p>
                                                    <input type="text" name="jour_fin" class="datepicker">
                                                </div>
                                            </div>

                                            <?php
                                                for ($i = 0; $i < $nbCreneaux; $i++){ ?>
                                                    <h5 class="lobster" style="margin-top: 30px; margin-bottom: 0"><?php
                                                        if ($i == 0) echo "Samedi matin";
                                                        else if ($i == 1) echo "Samedi après-midi";
                                                        else if ($i == 2) echo "Dimanche matin";
                                                        else if ($i == 3) echo "Dimanche après-midi";
                                                        else if ($i == 4) echo "Jour férié 1 matin";
                                                        else if ($i == 5) echo "Jour férié 1 après-midi";
                                                        else if ($i == 6) echo "Jour férié 2 matin";
                                                        else if ($i == 7) echo "Jour férié 2 après-midi";
                                                    ?></h5>
                                                    <div class="row">
                                                        <div class="col s4">
                                                            <p style="margin-top: 10px;"><b>Jour du créneau</b></p>
                                                            <input type="text" name="jour<?= $i ?>" class="datepicker">
                                                        </div>
                                                        <div class="col s4">
                                                            <p style="margin-top: 10px;"><b>Heure de début</b></p>
                                                            <input type="text" name="horaire_debut<?= $i ?>">
                                                        </div>
                                                        <div class="col s4">
                                                            <p style="margin-top: 10px;"><b>Heure de fin</b></p>
                                                            <input type="text" name="horaire_fin<?= $i ?>">
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                            <button style="margin-top: 5px" class="green btn waves-effect waves-light">Créer</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                <?php
                    foreach ($creneaux as $creneau) {
                        if (new DateTime() < new DateTime($creneau['jour_fin'])) {?>
                        <div class="card-panel center semaine">
                            <form class="col s12" method="POST" action="controler/modification_creneau.php">
                                <h5 class="lobster">Du <?= ucwords(strftime("%A %e %B", strtotime($creneau['jour_debut']))) ?> au <?= ucwords(strftime("%A %e %B", strtotime($creneau['jour_fin']))) ?></h5>

                                <div class="row">
                                    <div class="col s6">
                                        <p><b>Jour du début</b></p>
                                        <input type="text" name="jour_debut" id="debut_datepicker<?= $creneau['id_creneau'] ?>" class="datepicker">
                                    </div>
                                    <div class="col s6">
                                        <p><b>Jour de fin</b></p>
                                        <input type="text" name="jour_fin" id="fin_datepicker<?= $creneau['id_creneau'] ?>" class="datepicker">
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function(){
                                        $('#debut_datepicker<?= $creneau['id_creneau'] ?>').datepicker('setDate', '<?= $creneau['jour_debut'] ?>');
                                        $('#fin_datepicker<?= $creneau['id_creneau'] ?>').datepicker('setDate', '<?= $creneau['jour_fin'] ?>');
                                    });
                                </script>

                                <?php
                                    for ($i = 0; $i < $nbCreneaux; $i++){ ?>
                                        <h5 class="lobster" style="margin-top: 30px; margin-bottom: 0">
                                            <?php
                                                if ($i == 0){ echo "Samedi matin";}
                                                else if ($i == 1){ echo "Samedi après-midi";}
                                                else if ($i == 2){ echo "Dimanche matin";}
                                                else if ($i == 3){ echo "Dimanche après-midi";}
                                                else if ($i == 4){ echo "Jour férié 1 matin";}
                                                else if ($i == 5){ echo "Jour férié 1 après-midi";}
                                                else if ($i == 6){ echo "Jour férié 2 matin";}
                                                else if ($i == 7){ echo "Jour férié 2 après-midi";}
                                            ?>
                                        </h5>
                                        <div class="row">
                                            <div class="col s4">
                                                <p style="margin-top: 10px;"><b>Jour du créneau</b></p>
                                                <input type="text" name="jour<?= $i ?>" id="jour_<?= $i . $creneau['id_creneau'] ?>" class="datepicker">
                                            </div>
                                            <div class="col s4">
                                                <p style="margin-top: 10px;"><b>Heure de début</b></p>
                                                <input type="text" name="horaire_debut<?= $i ?>" id="heure_debut<?= $i . $creneau['id_creneau'] ?>">
                                            </div>
                                            <div class="col s4">
                                                <p style="margin-top: 10px;"><b>Heure de fin</b></p>
                                                <input type="text" name="horaire_fin<?= $i ?>" id="heure_fin<?= $i . $creneau['id_creneau'] ?>">
                                            </div>

                                            <script>
                                                $(document).ready(function(){
                                                    $('#jour_<?= $i . $creneau['id_creneau'] ?>').datepicker('setDate', '<?= $creneau['creneau_' . $i . '_jour'] ?>');
                                                    $('#heure_debut<?= $i . $creneau['id_creneau'] ?>').val('<?= $creneau['creneau_' . $i . '_horaire_debut'] ?>');
                                                    $('#heure_fin<?= $i . $creneau['id_creneau'] ?>').val('<?= $creneau['creneau_' . $i . '_horaire_fin'] ?>');
                                                });
                                            </script>
                                        </div>
                                    <?php } ?>
                                    <script>
                                        $(document).ready(function(){
                                            $('.datepicker').datepicker('setInputValue');
                                        });
                                    </script>
                                <button name="id_creneau" value="<?= $creneau['id_creneau'] ?>" style="margin-top: 5px" class="blue btn waves-effect waves-light">Enregistrer</button>
                            </form>
                            <form action="controler/suppression_creneau.php" method="POST">
                                <button style="margin-top: 10px" onclick="return confirm('Supprimer le créneau ?');" class="red darken-1 btn waves-effect waves-light" type="submit" name="id_creneau" value="<?= $creneau['id_creneau'] ?>">Supprimer</button>
                            </form>
                        </div>
                    <?php }
                        } ?>
                <?php } ?>
                <footer class="page-footer grey lighten-3">
					<div class="container">
						<div class="row">
							<div class="col s4 center">
								<a href="https://www.esftt.com/"><img class="responsive-img" width="70" height="70" src="https://www.esftt.com/images/logo-new.png"></a>
							</div>
							<div class="col s4 center">
								<a class="lobster" href="https://github.com/StephSako?tab=repositories">Le développeur</a>
							</div>
							<div class="col s4 center">
								<a class="lobster" href="https://github.com/StephSako/ESFTT-COVID-Planning-Spring-2021">Le projet</a>
							</div>
						</div>
					</div>
				</footer>
            <?php } ?>
        </div>
    </body>
</html>