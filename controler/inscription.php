<?php
    include('../model/bd_planning.php');
	include('../model/Reservation.php');
    include('../model/Joueur.php');
    header('Location:../index.php');

    if(!empty($_POST['id_creneau'])){

        $reservations = array_fill(0, $nbCreneaux, 0);
        $reservations_org = array_fill(0, $nbCreneaux, 0);

        for ($i = 0; $i < $nbCreneaux; $i++) {


            $indispo_checked = isset($_POST['creneau_' . $i . '_indispo']);
            $ok_checked = isset($_POST['creneau_' . $i . '_ok']);
            $org_checked = isset($_POST['creneau_' . $i . '_org']);

            if ($indispo_checked || (!$ok_checked && !$org_checked)){
                $reservations[$i] = 2;
                $reservations_org[$i] = 2;
            } else {
                if ($ok_checked) $reservations[$i] = 1; else $reservations[$i] = 0;
                if ($org_checked) $reservations_org[$i] = 1; else $reservations_org[$i] = 0;
            }
        }
        $reservation = new Reservation();

        if ($reservation->deja_inscrit($_POST['id_creneau'])) $reservation->modification($_POST['id_creneau'], $reservations, $reservations_org);
        else $reservation->inscription($_POST['id_creneau'], $reservations, $reservations_org, date('Y-m-d H:i:s'));
	}