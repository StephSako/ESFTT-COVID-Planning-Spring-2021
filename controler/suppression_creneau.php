<?php
	include('../model/Reservation.php');
	include('../model/Creneau.php');
    header('Location:../backoffice.php');

    if( !empty($_POST['id_creneau'])){
        $creneau = new Creneau();
        $creneau->suppression($_POST['id_creneau']);
	}