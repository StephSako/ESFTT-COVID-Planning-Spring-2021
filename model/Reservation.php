<?php

	class Reservation {

		private $co;
		private $nbCreneaux;

		public function __construct(){
	    	include('bd_planning.php');
			$this->co = $co;
			$this->nbCreneaux = $nbCreneaux;
		}
		
		public function deja_inscrit($id_creneau, $id_joueur){
			$result = mysqli_query($this->co, 'SELECT id_reservation FROM reservations WHERE id_joueur = ' . $id_joueur . ' AND id_creneau = ' . $id_creneau);
			return (mysqli_num_rows($result) > 0) ? true : false;
		}

		public function suppression($id_creneau, $id_joueur){
			mysqli_query($this->co, 'DELETE FROM reservations WHERE id_joueur = ' . $id_joueur . ' AND id_creneau = ' . $id_creneau) or die('Impossible de supprimer la réservation.');
		}

		public function modification($id_creneau, $id_joueur, $mardi, $mercredi, $vendredi, $dimanche_matin, $org_mardi, $org_mercredi, $org_vendredi, $org_dimanche_matin){
			mysqli_query($this->co, 'UPDATE reservations SET mardi = ' . $mardi . ', mercredi = ' . $mercredi . ', vendredi = ' . $vendredi . ', dimanche_matin = ' . $dimanche_matin . ', org_mardi = ' . $org_mardi . ', org_mercredi = ' . $org_mercredi . ', org_vendredi = ' . $org_vendredi . ', org_dimanche_matin = ' . $org_dimanche_matin . ' WHERE id_joueur = ' . $id_joueur .' AND id_creneau = ' . $id_creneau) or die('Impossible de modifier la réservation.');
		}

		public function inscription($table, $id_joueur, $mardi, $mercredi, $vendredi, $dimanche_matin, $org_mardi, $org_mercredi, $org_vendredi, $org_dimanche_matin, $date){
			$result = mysqli_query($this->co, 'INSERT INTO ' . $table . ' (id_joueur, dateInscription, mardi, mercredi, vendredi, dimanche_matin, org_mardi, org_mercredi, org_vendredi, org_dimanche_matin) VALUES (\''. $id_joueur .'\', \''. $date . '\', \''. $mardi .'\', \''. $mercredi .'\', \''. $vendredi .'\', \''. $dimanche_matin .'\', \''. $org_mardi .'\', \''. $org_mercredi .'\', \''. $org_vendredi .'\', \''. $org_dimanche_matin .'\')') or die('Impossible d\'enregister la réservation.');
		}
	}