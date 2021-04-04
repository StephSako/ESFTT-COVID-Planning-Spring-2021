<?php
	include('../../model/Reservation.php');
    header('Location:../../index.php');

    if( !empty($_POST['table']) && !empty($_POST['id_joueur']) && !(empty($_POST['mardi']) && empty($_POST['mercredi']) && empty($_POST['vendredi']) && empty($_POST['dimanche_matin']) ) ){
        
        $mardi = (isset($_POST['mardi'])) ? 1 : 0;
        $mercredi = (isset($_POST['mercredi'])) ? 1 : 0;
        $vendredi = (isset($_POST['vendredi'])) ? 1 : 0;
        $dimanche_matin = (isset($_POST['dimanche_matin'])) ? 1 : 0;
        $org_mardi = (!empty($_POST['org_mardi'])) ? 1 : 0;
        $org_mercredi = (!empty($_POST['org_mercredi'])) ? 1 : 0;
        $org_vendredi = (!empty($_POST['org_vendredi'])) ? 1 : 0;
        $org_dimanche_matin = (!empty($_POST['org_dimanche_matin'])) ? 1 : 0;

        $reservation = new Reservation();

        if ( $reservation->deja_inscrit(htmlspecialchars($_POST['table']), $_POST['id_joueur']) )
            $reservation->modification(htmlspecialchars($_POST['table']), $_POST['id_joueur'], $mardi, $mercredi, $vendredi, $dimanche_matin, $org_mardi, $org_mercredi, $org_vendredi, $org_dimanche_matin);
        else
            $reservation->inscription(htmlspecialchars($_POST['table']), $_POST['id_joueur'], $mardi, $mercredi, $vendredi, $dimanche_matin, $org_mardi, $org_mercredi, $org_vendredi, $org_dimanche_matin, date('Y-m-d H:i:s'));
	}