<?php
	include('../model/Reservation.php');
	include('../model/Joueur.php');
    header('Location:../index.php');

    if( !empty($_POST['id_creneau'])){
        $reservation = new Reservation();
        $reservation->suppression(htmlspecialchars($_POST['id_creneau']));
	}