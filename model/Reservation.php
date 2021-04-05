<?php

	class Reservation {

		private $co;
		private $nbCreneaux;

		public function __construct(){
	    	include('bd_planning.php');
			$this->co = $co;
			$this->nbCreneaux = $nbCreneaux;
		}
		
		public function deja_inscrit($id_creneau){
			$result = mysqli_query($this->co, 'SELECT id_reservation FROM reservations WHERE id_joueur = ' . $_SESSION['id_joueur'] . ' AND id_creneau = ' . $id_creneau);
			return (mysqli_num_rows($result) > 0) ? true : false;
		}

		public function suppression($id_creneau){
			mysqli_query($this->co, 'DELETE FROM reservations WHERE id_joueur = ' . $_SESSION['id_joueur'] . ' AND id_creneau = ' . $id_creneau) or die('Impossible de supprimer la réservation.');
		}

		public function modification($id_creneau, $reservations, $reservations_org){
			$strSet = '';
			for ($i = 0; $i < $this->nbCreneaux; $i++){
				$strSet .= 'creneau_' . $i . '_ok = ' . $reservations[$i] . ', creneau_' . $i . '_org = ' . $reservations_org[$i] . ($i < $this->nbCreneaux-1 ? ', ' : '');
			}
			mysqli_query($this->co, 'UPDATE reservations SET ' . $strSet . ' WHERE id_joueur = ' . $_SESSION['id_joueur'] .' AND id_creneau = ' . $id_creneau) or die('Impossible de modifier la réservation.');
		}

		public function inscription($id_creneau, $reservations, $reservations_org, $date){
			$strSetColumns = $strSetValues = '';
			for ($i = 0; $i < $this->nbCreneaux; $i++){
				$strSetColumns .= "creneau_" . $i . "_ok, creneau_" . $i . "_org" . ($i < $this->nbCreneaux-1 ? ", " : "");
				$strSetValues .= "'" . $reservations[$i] . "', '" . $reservations_org[$i] . "'" . ($i < $this->nbCreneaux-1 ? ", " : "");
			}
			mysqli_query($this->co, "INSERT INTO reservations (id_joueur, created_at, id_creneau, " . $strSetColumns . ") VALUES ('" . $_SESSION['id_joueur'] . "', '". $date . "', '" . $id_creneau . "', " . $strSetValues . ")") or die('Impossible d\'enregister la réservation.');
		}
	}