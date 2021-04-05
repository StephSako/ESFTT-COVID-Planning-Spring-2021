<?php include('../model/Joueur.php');
	header('Location:../login.php');
	$decoMembre = new Joueur(htmlspecialchars($_SESSION['id_joueur']));
	$decoMembre->deconnexion();
?>