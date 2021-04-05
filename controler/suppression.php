<?php
	include('../../model/Reservation.php');
    header('Location:../../index.php');

    if( !empty($_POST['id_creneau'])){
        $reservation = new Reservation();
        $reservation->suppression(htmlspecialchars($_POST['id_creneau']));
        
	}