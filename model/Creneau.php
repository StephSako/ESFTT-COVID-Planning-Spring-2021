<?php

	class Creneau {
		private $co;

		public function __construct(){
			include('bd_planning.php');
			$this->co = $co;
            $this->nbCreneaux = $nbCreneaux;
	    }

        public function modification($id_creneau, $jour_debut, $jour_fin, $horaire_debut, $horaire_fin, $jour){
			$strSet = '';
			for ($i = 0; $i < $this->nbCreneaux; $i++){
				$strSet .= "creneau_" . $i . "_horaire_debut = " . ($horaire_debut[$i] ? "'" . $horaire_debut[$i] . "'" : " NULL"); 
				$strSet .= ", creneau_" . $i . "_horaire_fin = " . ($horaire_fin[$i] ? "'" . $horaire_fin[$i] . "'" : " NULL");
				$strSet .= ", creneau_" . $i . "_jour = " . ($jour[$i] ? "'" . $jour[$i] . "'" : " NULL");
				$strSet .= ($i < $this->nbCreneaux-1 ? ", " : "");
			}
			mysqli_query($this->co, "UPDATE creneaux SET jour_debut = '" . $jour_debut . "', jour_fin = '" . $jour_fin . "', " . $strSet . " WHERE id_creneau = " . $id_creneau) or die('Impossible de modifier le créneau.');
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