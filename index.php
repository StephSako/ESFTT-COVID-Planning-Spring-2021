<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>ESFTT Planning 2021</title>
	<link rel="icon" href="resources/icons/icon.svg">
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Lobster" />
	<!--Import materialize.css-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
	<!--Import my own style.css-->
	<link type="text/css" rel="stylesheet" href="resources/style.css" media="screen,projection" />
</head>

<body>

	<?php
		setlocale(LC_TIME, "fr_FR", "French");
		include('model/bd_planning.php');
		include('model/Joueur.php');
		
		$joueurs = mysqli_query($co, 'SELECT * FROM joueurs ORDER BY nom_joueur') or die("Impossible d'exécuter la requête des joueurs.");
		$creneaux = mysqli_query($co, 'SELECT * FROM creneaux ORDER BY jour_debut') or die("Impossible d'exécuter la requête des créaneaux.");
	?>

	<div class="container">
		<div class="lobster titre">
			<h4 class="center"><b>Planning de réservations - COVID 19</b></h4>
			<h5 class="center lobster"><b>ESFTT - Reprise Printemps 2021</b></h5>

			<h6 class="blue-text center lobster"><i>Bienvenue <?= $_SESSION['nom_joueur'] ?></i></h6>
		</div>

		<!--div class="semaine red lighten-4 cartouche_infos">
			<p class="center red-text"><b>Le site n'est maintenant plus actif ni interactif en raison de la fin des entraînements de reprise.</b></p>
		</div-->

		<div class="semaine cartouche_infos">
			<h5 class="center lobster"><b>Règlements</b></h5>

			<blockquote>Afin d'accéder à la salle, vous devez vous inscrire à la semaine. Pour cela, pas de comptes ni de mots de passe à retenir ! <i class="material-icons">sentiment_very_satisfied</i>
				<br><br>Pour une réservation à la semaine, veuillez simplement :
				<ol class="browser-default">
					<li>sélectionner votre nom dans la liste déroulante,</li>
					<li>cocher chacun des jours pour lesquels :
						<ul class="browser-default">
							<li>vous souhaitez jouer</li>
							<li>vous vous proposez être <b>Organisateur COVID</b> : mise en application des consignes d'hygiène réglementées par la <a href="http://www.fftt.com/site/">FFTT</a>
								(consignes <a href="http://www.fftt.com/site/medias/shares_files/guide-de-reprise-tennis-de-table-fftt-2966.pdf?utm_source=sendinblue&utm_campaign=Protocole_de_reprise_du_Tennis_de_Table&utm_medium=email">ici</a>).
							<br>2 <b>Organisateurs COVID</b> maximum sont requis par jour. Nous essaierons de faire tourner entre nous au fil des semaines. <i class="material-icons">sentiment_satisfied</i></li>
						</ul>
					</li>
					<li>valider en cliquant sur "S'enregistrer".</li>
				</ol>
			</blockquote>

			<blockquote>Cependant, seulement <b>10</b> personnes maximum seront autorisées à pénétrer dans le gymnase. C'est pourquoi les 10 premières personnes
				inscrites seront prioritaires <b>par jour</b>.
			</blockquote>

			<blockquote class="black-text"><b>Au moindre problème</b>, <b>suggestion</b> ou <b>remarque</b>, contactez-moi par mail à <a href="mailto:stephen.sakovitch@orange.fr?subject=Réservation ESFTT - été 2020">stephen.sakovitch@orange.fr</a>, sur Messenger, WhatsApp ou par SMS.</blockquote>
		
			<h6 class="center red-text"><i class="material-icons red-text">report_problem</i> <b>S'il vous plaît</b>, le site a été développé en peu de temps et n'a donc pas de sécurité poussée :<br>ne supprimez pas les réservations des autres ! <i class="material-icons red-text">remove_red_eye</i><i class="material-icons red-text">remove_red_eye</i></h6>
		</div>

		<div class="semaine green lighten-4 cartouche_infos">
			<blockquote>Pour <b>modifier</b> votre réservation d'une semaine, il faut <b>re-cocher toutes les cases des jours</b> de la semaine pour lesquels vous souhaitez participer.<br>
			Pour <b>supprimer</b> votre réservation d'une semaine, cliquer sur le bouton rouge en face de votre nom dans la liste.</blockquote>
		</div>

		<!--div class="container cartouche_infos">
			<ul class="collection with-header semaine blue lighten-4 infos_indispos" style="padding-left: 20px;">
				<li class="collection-header blue lighten-4"><h5 class="lobster"><span class="blue-text text-darken-2"><i class="material-icons">info</i></span> La salle est indisponible pour les dates suivantes :</h5></li>
				<li class="collection-item blue lighten-4 center"><b>Mercredi 24 Juin</b> remplacé par le <b>Jeudi 25 Juin</b></li>
				<li class="collection-item blue lighten-4 center"><b>Mercredi 1er Juillet</b> remplacé par le <b>Jeudi 2 Juillet</b></li>
			</ul>
		</div-->
		
		<?php
			foreach ($creneaux as $creneau){
				$reservations = mysqli_query($co, "SELECT * FROM reservations r NATURAL JOIN joueurs WHERE r.id_creneau = " . $creneau['id_creneau'] . " ORDER BY created_at ASC");

				$subQueryInscr = $subQueryInscr_org = "";
				for ($i = 0; $i < $nbCreneaux; $i++) {
					$subQueryInscr .= "(SELECT COUNT(*) FROM reservations r" . $i . " WHERE creneau_" . $i . "_ok = 1 AND r" . $i . ".id_creneau = r.id_creneau) AS nb_creneau_" . $i . "_ok" . ($i < $nbCreneaux-1 ? ', ' : '');
					$subQueryInscr_org .= "(SELECT COUNT(*) FROM reservations r" . $i . " WHERE creneau_" . $i . "_org = 1 AND r" . $i . ".id_creneau = r.id_creneau) AS nb_creneau_" . $i . "_org" . ($i < $nbCreneaux-1 ? ', ' : '');
				}

				$rowCountInscr = mysqli_fetch_assoc(mysqli_query($co, "SELECT " . $subQueryInscr . " FROM reservations r WHERE r.id_creneau = " . $creneau['id_creneau'] . " LIMIT 1"));
				$rowCountInscr_org = mysqli_fetch_assoc(mysqli_query($co, "SELECT " . $subQueryInscr_org . " FROM reservations r WHERE r.id_creneau = " . $creneau['id_creneau'] . " LIMIT 1"));
		?>

			<div class="semaine">
				<h4 class="center lobster">Du <?= ucwords(strftime("%e %B", strtotime($creneau['jour_debut']))) ?> au <?= ucwords(strftime("%e %B", strtotime($creneau['jour_fin']))) ?></h4>
				
				<table class="centered">
					<thead>
						<tr>
							<th></th>

							<?php
								for ($i = 0; $i < $nbCreneaux; $i++){
									if ($creneau['creneau_' . $i . '_jour']) { ?>
										<th>
											<?= ucwords(strftime("%A %e %B", strtotime($creneau['creneau_' . $i . '_jour']))) ?><br>
											<span class="badge white-text grey darken-2"><?= $creneau['creneau_' . $i . '_horaire'] ?></span><br>
											<span class="badge <?php if ($rowCountInscr['nb_creneau_' . $i . '_ok'] > 6) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr['nb_creneau_' . $i . '_ok'] != null ? $rowCountInscr['nb_creneau_' . $i . '_ok'] : '0') . ' joueurs'; ?></span><br>
											<span class="badge <?php if ($rowCountInscr_org['nb_creneau_' . $i . '_org'] == 0 && $rowCountInscr['nb_creneau_' . $i . '_ok'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_org['nb_creneau_' . $i . '_org'] < 2 && $rowCountInscr['nb_creneau_' . $i . '_ok'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_org['nb_creneau_' . $i . '_org'] != null ? $rowCountInscr_org['nb_creneau_' . $i . '_org'] : '0') . ' organisat.'; ?></span>
										</th>
							<?php }
								}
							?>
							
							<th></th>
							<th></th>
						</tr>
					</thead>

					<tbody>
						<?php
							$i_th_joueurs = array_fill(0, $nbCreneaux, 0);
							while ($reservation = mysqli_fetch_assoc($reservations)){
								$dateFormat = new DateTime($reservation['created_at']); ?>
								<tr>
									<td>
										<?= $reservation['nom_joueur'] ?>
									</td>
									<?php
										for ($i = 0; $i < $nbCreneaux; $i++){
											if ($creneau['creneau_' . $i . '_jour']) {
												echo "<td>";
													if ($reservation['creneau_' . $i . '_ok']) { $i_th_joueurs[$i]++; ?> <i class="material-icons <?php if ($i_th_joueurs[$i] > 6) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
													if ($reservation['creneau_' . $i . '_org']) echo "<i class='material-icons'>remove_red_eye</i>";
												echo "</td>";
											}
										}

									echo "<td style='font-size: 10pt'><b>" . $dateFormat->format('d/m/Y') . "</b><br>" . $dateFormat->format('H:i') . "</td>"; ?>
									<td>
										<form action="controler/suppression.php" method="POST">
											<input type="hidden" name="id_creneau" value="<?= $creneau['id_creneau'] ?>" />
											<button onclick="return confirm('Supprimer votre réservation ?');" class="red darken-1 btn waves-effect waves-light" type="submit" name="id_joueur" value="<?php echo $reservation['id_joueur']; ?>"><i class="material-icons">cancel</i></button>
										</form>
									</td>
								</tr>
						<?php } ?>
					</tbody>
				</table>

				<form class="col s12" method="POST" action="controler/inscription.php">
					<div class="row">
						<div class="row valign-wrapper row_player">
							<div class="input-field col s2">
								<select name="id_joueur" class="browser-default" required>
									<option disabled selected>Votre nom</option>
									<?php
										mysqli_data_seek($joueurs, 0);
										while ($row = mysqli_fetch_assoc($joueurs)) {
											echo "<option value=\"" . $row['id_joueur'] . "\">".$row['nom_joueur']."</option>";
										}
									?>
								</select>
							</div>
							<div class="input-field col s2">
								<p class="center">Je souhaite jouer :</p>
							</div>
							<?php
								for ($i = 0; $i < $nbCreneaux; $i++){
									if ($creneau['creneau_' . $i . '_jour']) { ?>
										<div class="input-field col s2">
											<p>
												<label>
													<input type="checkbox" name="<?= 'creneau_' . $i ?>" />
													<span><?= ucwords(strftime("%A %e", strtotime($creneau['creneau_' . $i . '_jour']))) ?></span>
												</label>
											</p>
										</div>
									<?php }
								} ?>
						</div>

						<div class="row valign-wrapper row_org">
							<div class="input-field col s2">
								<span></span>
							</div>
							<div class="input-field col s2">
								<p class="center">Je me propose organisateur COVID pour :</p>
							</div>
							<?php
								for ($i = 0; $i < $nbCreneaux; $i++){
									if ($creneau['creneau_' . $i . '_jour']) { ?>
										<div class="input-field col s2">
											<p>
												<label>
													<input type="checkbox" name="<?= 'creneau_' . $i . '_org' ?>" />
													<span><?= ucwords(strftime("%A %e", strtotime($creneau['creneau_' . $i . '_jour']))) ?></span>
												</label>
											</p>
										</div>
									<?php }
								} ?>
							<input type="hidden" name="id_creneau" value="<?= $creneau['id_creneau'] ?>" />
						</div>

						<div class="center btn_register">
							<button class="btn waves-effect waves-light" type="submit" name="action">Enregistrer
								<i class="material-icons right">send</i>
							</button>
						</div>

					</div>
				</form>
			</div>
		<?php } ?>

		<footer class="page-footer grey lighten-3">
    		<div class="container">
				<div class="row">
					<div class="col s4 center">
						<a href="https://www.esftt.com/"><img class="responsive-img" width="70" height="70" src="https://www.esftt.com/images/logo-new.png"></a>
					</div>
					<div class="col s4 center">
						<a class="lobster" href="https://github.com/StephSako?tab=repositories">Le développeur</a>
					</div>
					<div class="col s4 center">
						<a class="lobster" href="https://github.com/StephSako/ESFTT-planning">Le projet</a>
					</div>
				</div>
        	</div>
        </footer>
			
		<!--Scripts trigger de Materialize-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
	</body>

</html>