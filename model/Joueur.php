<?php

    session_start();

	class Joueur {

		private $co;
		private $id_joueur;
		private $nom_joueur;
		private $username;
		private $is_admin;

		public function __construct(){
			include('bd_planning.php');
			$this->co = $co;

			$stmt = $this->co->prepare('SELECT username FROM joueurs WHERE id_joueur = ? AND is_admin = 1');
            $id_joueur = func_get_arg(0);
			$stmt->bind_param('i', $id_joueur);
			$stmt->execute();

			if (mysqli_num_rows($stmt->get_result()) == 0) $this->is_admin = false;
			else $this->is_admin = true;

	        $this->id_joueur = $id_joueur;
	        $this->nom_joueur = func_get_arg(1);
	        $this->username = func_get_arg(2);
	    }

        public function connexion(){
			$_SESSION['id_joueur'] = $this->id_joueur;
			$_SESSION['username'] = $this->username;
			$_SESSION['nom_joueur'] = $this->nom_joueur;
			$_SESSION['is_admin'] = $this->is_admin;
            var_dump($_SESSION);
		}

        public function deconnexion(){
			session_unset();
			mysqli_close($this->co);
		}
	}