<?php
    include('../model/bd_planning.php');
	include('../model/Reservation.php');
    include('../model/Joueur.php');
    //header('Location:../index.php');

    if(!empty($_POST['id_creneau']) && !empty($_POST['horaire_debut']) && !empty($_POST['horaire_fin']) && !empty($_POST['jour'])) {

        $horaire_debut = array_fill(0, $nbCreneaux, null);
        $horaire_fin = array_fill(0, $nbCreneaux, null);
        $jour = array_fill(0, $nbCreneaux, null);

        for ($i = 0; $i < $nbCreneaux; $i++) {
            $horaire_debut[$i] = isset($_POST['horaire_debut' . $i]) ? htmlspecialchars($_POST['horaire_debut' . $i]) : null;
            $horaire_fin[$i] = isset($_POST['horaire_fin' . $i]) ? htmlspecialchars($_POST['horaire_fin' . $i]) : null;
            $jour[$i] = isset($_POST['jour' . $i]) ? htmlspecialchars($_POST['jour' . $i]) : null;
        }
        
        var_dump($horaire_debut);
        var_dump($horaire_fin);
        var_dump($jour);

        /*$creneau = new Creneau();

        $reservation->modification($_POST['id_creneau'], $horaire_debut, $horaire_fin, $jour);*/
	}