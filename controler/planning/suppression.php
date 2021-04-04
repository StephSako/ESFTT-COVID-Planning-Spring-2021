<?php
	include('../../model/Reservation.php');
    header('Location:../../index.php');

    if( !empty($_POST['id_creneau']) && !empty($_POST['id_joueur']) ){
        $reservation = new Reservation();
        $reservation->suppression(htmlspecialchars($_POST['id_creneau']), $_POST['id_joueur']);
        
	}