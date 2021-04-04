<?php

	class Reservation {

		private $co;

		public function __construct(){
	    	include('bd_planning.php');
			$this->co = $co;
		}
		
		public function deja_inscrit($table, $id_joueur){
			$result = mysqli_query($this->co, "SELECT id_reservation FROM " . $table . " WHERE id_joueur = " . $id_joueur);
			return (mysqli_num_rows($result) > 0) ? true : false;
		}

		public function suppression($table, $id_joueur){
			mysqli_query($this->co, "DELETE FROM " . $table . " WHERE id_joueur = " . $id_joueur);
		}

		public function modification($table, $id_joueur, $mardi, $mercredi, $vendredi, $dimanche_matin, $org_mardi, $org_mercredi, $org_vendredi, $org_dimanche_matin){
			mysqli_query($this->co, "UPDATE " . $table . " SET mardi = ". $mardi .", mercredi = ". $mercredi .", vendredi = ". $vendredi .", dimanche_matin = ". $dimanche_matin .", org_mardi = ". $org_mardi .", org_mercredi = ". $org_mercredi .", org_vendredi = ". $org_vendredi .", org_dimanche_matin = ". $org_dimanche_matin ." WHERE id_joueur = " . $id_joueur .";") or die("Impossible d'effectuer la modification de la réservation.");
		}

		public function inscription($table, $id_joueur, $mardi, $mercredi, $vendredi, $dimanche_matin, $org_mardi, $org_mercredi, $org_vendredi, $org_dimanche_matin, $date){
			$result = mysqli_query($this->co, "INSERT INTO ". $table ." (id_joueur, dateInscription, mardi, mercredi, vendredi, dimanche_matin, org_mardi, org_mercredi, org_vendredi, org_dimanche_matin) VALUES ('". $id_joueur ."', '". $date . "', '". $mardi ."', '". $mercredi ."', '". $vendredi ."', '". $dimanche_matin ."', '". $org_mardi ."', '". $org_mercredi ."', '". $org_vendredi ."', '". $org_dimanche_matin ."');") or die("Impossible d'effectuer l'inscription.");
		}
	}