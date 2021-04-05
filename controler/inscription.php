<?php
    include('../model/bd_planning.php');
	include('../model/Reservation.php');
    include('../model/Joueur.php');
    header('Location:../index.php');

    if(!empty($_POST['id_creneau'])){

        $reservations = array_fill(0, $nbCreneaux, 0);
        $reservations_org = array_fill(0, $nbCreneaux, 0);

        for ($i = 0; $i < $nbCreneaux; $i++) {
            $reservations[$i] = isset($_POST['creneau_' . $i]) ? 1 : 0;
            $reservations_org[$i] = isset($_POST['creneau_' . $i . '_org']) ? 1 : 0;
        }
        $reservation = new Reservation();

        if ($reservation->deja_inscrit($_POST['id_creneau'])) $reservation->modification($_POST['id_creneau'], $reservations, $reservations_org);
        else $reservation->inscription($_POST['id_creneau'], $reservations, $reservations_org, date('Y-m-d H:i:s'));
	}