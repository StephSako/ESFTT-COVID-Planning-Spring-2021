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
				$strSet .= "creneau_" . $i . "_horaire_debut = " . ($horaire_debut[$i] ? "'" . $horaire_debut[$i] . "'" : "NULL");
				$strSet .= ", creneau_" . $i . "_horaire_fin = " . ($horaire_fin[$i] ? "'" . $horaire_fin[$i] . "'" : "NULL");
				$strSet .= ", creneau_" . $i . "_jour = " . ($jour[$i] ? "'" . $jour[$i] . "'" : "NULL");
				$strSet .= ($i < $this->nbCreneaux-1 ? ", " : "");
			}
			mysqli_query($this->co, "UPDATE creneaux SET jour_debut = '" . $jour_debut . "', jour_fin = '" . $jour_fin . "', " . $strSet . " WHERE id_creneau = " . $id_creneau) or die('Impossible de modifier le créneau.');
		}

		public function creation($jour_debut, $jour_fin, $horaire_debut, $horaire_fin, $jour){
			$strSet = $strColumn = '';
			for ($i = 0; $i < $this->nbCreneaux; $i++){
				$strColumn .= "creneau_" . $i . "_horaire_debut";
				$strColumn .= ", creneau_" . $i . "_horaire_fin";
				$strColumn .= ", creneau_" . $i . "_jour";
				$strColumn .= ($i < $this->nbCreneaux-1 ? ", " : "");

				$strSet .= ($horaire_debut[$i] ? "'" . $horaire_debut[$i] . "'" : "NULL");
				$strSet .= ", " . ($horaire_fin[$i] ? "'" . $horaire_fin[$i] . "'" : "NULL");
				$strSet .= ", " . ($jour[$i] ? "'" . $jour[$i] . "'" : "NULL");
				$strSet .= ($i < $this->nbCreneaux-1 ? ", " : "");
			}
			mysqli_query($this->co, "INSERT INTO creneaux (jour_debut, jour_fin, " . $strColumn . ") VALUES ('" . $jour_debut . "', '" . $jour_fin . "', " . $strSet . ")") or die('Impossible de créer le créneau.');
		}

		public function suppression($id_creneau){
			mysqli_query($this->co, 'DELETE FROM creneaux WHERE id_creneau = ' . $id_creneau) or die('Impossible de supprimer le créneau.');
		}
	}