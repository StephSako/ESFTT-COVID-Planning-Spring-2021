<?php
	include('../../model/Reservation.php');
    header('Location:../../index.php');

    if( !empty($_POST['table']) && !empty($_POST['delete']) ){
        $reservation = new Reservation();
        $reservation->suppression(htmlspecialchars($_POST['table']), $_POST['delete']);
        
	}