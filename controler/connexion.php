<?php
	include('../model/bd_planning.php');
	include('../model/Joueur.php');

	if(!empty($_POST['_username']) && !empty($_POST['_password'])){

		$username = htmlspecialchars($_POST['_username']);
		$password = htmlspecialchars($_POST['_password']);

		$stmt = $co->prepare('SELECT id_joueur, nom_joueur, password FROM joueurs WHERE username = ?');
		$stmt->bind_param('s', $username);
		$stmt->execute();
		$result = $stmt->get_result();
		$stmt->close();

		if (mysqli_num_rows($result) == 0) header('Location:../login.php');
		else {
			$row = mysqli_fetch_assoc($result);
			if (password_verify($password, ($row['password']))) {
				header('Location:../index.php');
				$newMembre = new Joueur($row['id_joueur'], $row['nom_joueur'], $username);
				$newMembre->connexion();
			} else header('Location:../login.php');
		}
	} else header('Location:../login.php');
?>