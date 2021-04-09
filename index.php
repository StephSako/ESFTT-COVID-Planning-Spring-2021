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
		<!--Scripts trigger de Materialize-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
	</head>

	<body>

		<div class="container">

			<?php
				setlocale(LC_TIME, "fr_FR", "French");
				include('model/bd_planning.php');
				include('model/Joueur.php');
		
				$creneaux = mysqli_query($co, 'SELECT * FROM creneaux ORDER BY jour_debut') or die("Impossible d'exécuter la requête des créaneaux.");
				if (empty($_SESSION)){ header('Location:../login.php');} else { ?>
				
				<div class="titre center">
					<h4 class="lobster">🏓<b>Planning de réservations - COVID 19</b>🏓</h4>
					<h5 class="lobster"><b>ESFTT - Reprise Printemps 2021</b></h5>

					<h6 style="margin-top: 25px" class="blue-text"><b>Bienvenue <?= $_SESSION['nom_joueur'] ?></b></h6>
					<a href="controler/deconnexion.php" style="margin-top: 5px" class="red btn waves-effect waves-light">Se déconnecter</a>
					<?php if ($_SESSION['is_admin']) { ?>
						<a href="./backoffice.php" style="margin-top: 5px" class="blue btn waves-effect waves-light">Back-office</a>
					<?php } ?>
				</div>

				<!--div class="semaine red lighten-4 cartouche_infos">
					<p class="center red-text"><b>Le site n'est dorénavant plus actif ni interactif pour ce printemps 2021 en raison de la fin des entraînements de reprise.</b></p>
				</div-->

				<div class="semaine cartouche_infos">
					<h5 class="center lobster"><b>Règlement</b></h5>

					<blockquote>Afin d'accéder aux tables installées <b>en extérieur (selon les conditions météorologiques)</b>, vous devez vous inscrire pour les créneaux de votre choix à la semaine.</blockquote>
					
					<blockquote>Pour chaque créneau, veuillez simplement :
						<ol>
							<li>Cocher/décocher les créneaux pour lesquels :
								<ul class="browser-default">
									<li>vous êtes indisponible</li>
									<li>vous souhaitez jouer</li>
									<li>vous vous proposez être <b>responsable (personnes habituées à la gestion au club, détentrices d'un badge d'ouverture de salle, du code d'alarme/du placard)</b> : mise en application des <a href="./affiche-reprise-en-exterieur.pdf" target="blank">consignes d'hygiène</a> réglementées par la <a href="http://www.fftt.com/site/accueil">FFTT.</a></li>
								</ul>
							</li>
							<li>Valider en cliquant sur <b>ENREGISTRER</b>.</li>
						</ol>
					</blockquote>

					<b>Si vous ne cliquez sur aucune case pour un créneau, vous serez indiqué comme étant "Indisponible" par défaut.
					<br>Si vous êtes marqué comme "Indisponible" pour un créneau, vous vous verrez refuser l'accès à l'aire de jeu.</b>

					<h6 class="red-text center"><b><u>Attention : un créneau sera annulé si aucun responsable</u> (symbole <i style="vertical-align: text-top;" class="black-text material-icons">remove_red_eye</i> ) <u>n'est marqué disponible pour ledit créneau.</u></b></h6>
					
					<blockquote>Cependant, seulement <b>6 joueurs</b> par créneau seront autorisés à accéder aux tables. C'est pourquoi les <b>6 premières personnes inscrites</b> seront prioritaires pour chaque créneau. Soyez alertes dans la journée pour d'éventuels désistements.</blockquote>

					<p class="blue-text center" style="padding: 0;"><span style="font-size: 20px">📣</span> Nous comptons sur <b>chacun d'entre vous</b>, tant joueurs que responsables, pour installer et désinstaller le matériel en début et fin de séance. 😉</p>

					<blockquote class="black-text"><b>Au moindre problème</b>, <b>suggestion</b> ou <b>remarque</b>, contactez-moi par mail à <a href="mailto:stephen.sakovitch@orange.fr?subject=Réservation ESFTT - été 2020">stephen.sakovitch@orange.fr</a>, sur Messenger, WhatsApp ou par SMS.</blockquote>
				</div>

				<div class="semaine">
					<div class="row">
						<div class="col s4 center"><h5 class="lobster"><b>Légendes pour chaque créneau</b></h5></div>
						<div class="col s2 center"><p><i class="material-icons grey-text lighten-3">highlight_off</i><br>Joueur indisponible</p></div>
						<div class="col s2 center"><p><i class="material-icons green-text lighten-3">check_circle</i><br>Joueur prioritaire</p></div>
						<div class="col s2 center"><p><i class="material-icons red-text lighten-3">check_circle</i><br>Joueur non prioritaire</p></div>
						<div class="col s2 center"><p><i class="material-icons">remove_red_eye</i><br>Responsable</p></div>
					</div>
				</div>

				<!--div class="container cartouche_infos">
					<ul class="collection with-header semaine blue lighten-4 infos_indispos" style="padding-left: 20px;">
						<li class="collection-header blue lighten-4"><h5 class="lobster"><span class="blue-text text-darken-2"><i class="material-icons">info</i></span> La salle est indisponible pour les dates suivantes :</h5></li>
						<li class="collection-item blue lighten-4 center"><b>Mercredi 24 Juin</b> remplacé par le <b>Jeudi 25 Juin</b></li>
						<li class="collection-item blue lighten-4 center"><b>Mercredi 1er Juillet</b> remplacé par le <b>Jeudi 2 Juillet</b></li>
					</ul>
				</div-->
				
				<?php
					foreach ($creneaux as $creneau) {
						if ($creneau['jour_debut'] && ($creneau['jour_fin'] && new DateTime() < new DateTime($creneau['jour_fin']))) {
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
								<h5 class="center lobster">Semaine du <?= ucwords(strftime("%A %e %B", strtotime($creneau['jour_debut']))) ?> au <?= ucwords(strftime("%A %e %B", strtotime($creneau['jour_fin']))) ?></h5>
								
								<table class="centered">
									<thead>
										<tr>
											<th></th>
											<?php
												for ($i = 0; $i < $nbCreneaux; $i++){
													if ($creneau['creneau_' . $i . '_jour'] && $creneau['creneau_' . $i . '_horaire_debut'] && $creneau['creneau_' . $i . '_horaire_fin']) { ?>
														<th>
															<?php
																echo ucwords(strftime("%a %e", strtotime($creneau['creneau_' . $i . '_jour'])));
																if ($i == 0) echo " matin";
																else if ($i == 1) echo " apr.midi";
																else if ($i == 2) echo " matin";
																else if ($i == 3) echo " apr.midi";
																else if ($i == 4) echo " matin";
																else if ($i == 5) echo " apr.midi";
																else if ($i == 6) echo " matin";
																else if ($i == 7) echo " apr.midi";
															?><br>
															<span class="badge white-text grey darken-2"><?= $creneau['creneau_' . $i . '_horaire_debut'] ?>-<?= $creneau['creneau_' . $i . '_horaire_fin'] ?></span><br>
															<span class="badge <?php if ($rowCountInscr['nb_creneau_' . $i . '_ok'] > 6) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr['nb_creneau_' . $i . '_ok'] != null ? $rowCountInscr['nb_creneau_' . $i . '_ok'] : '0') . ' joueurs'; ?></span><br>
															<span class="badge <?php if ($rowCountInscr_org['nb_creneau_' . $i . '_org'] == 0 && $rowCountInscr['nb_creneau_' . $i . '_ok'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_org['nb_creneau_' . $i . '_org'] < 1 && $rowCountInscr['nb_creneau_' . $i . '_ok'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_org['nb_creneau_' . $i . '_org'] != null ? $rowCountInscr_org['nb_creneau_' . $i . '_org'] : '0') . ' resp.'; ?></span>
														</th>
												<?php } } ?>
											<th></th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										<?php
											$i_th_joueurs = array_fill(0, $nbCreneaux, 0);
											$row_connected_user = null;
											while ($reservation = mysqli_fetch_assoc($reservations)){
												if ($reservation['id_joueur'] == $_SESSION['id_joueur']) $row_connected_user = $reservation;
												$dateFormat = new DateTime($reservation['created_at']); ?>
												<tr>
													<td>
														<?= $reservation['nom_joueur'] ?>
													</td>
													<?php
														for ($i = 0; $i < $nbCreneaux; $i++){
															if ($creneau['creneau_' . $i . '_jour'] && $creneau['creneau_' . $i . '_horaire_debut'] && $creneau['creneau_' . $i . '_horaire_fin']) { ?>
																<td class='td_resa'>
																	<?php
																		if ($reservation['creneau_' . $i . '_ok'] == 2) echo "<i class='grey-text  lighten-3 material-icons'>highlight_off</i>";
																		else{
																			if ($reservation['creneau_' . $i . '_ok'] == 1) {
																				$i_th_joueurs[$i]++; ?>
																				<i class="material-icons <?= $i_th_joueurs[$i] > 6 ? 'red-text lighten-3' : 'green-text lighten-3' ?>" >check_circle</i>
																		<?php }
																			if ($reservation['creneau_' . $i . '_org'] == 1) { echo "<i class='material-icons'>remove_red_eye</i>"; }
																		} ?>
																</td>
															<?php }
														} ?>

													<td style='font-size: 10pt'><b><?= $dateFormat->format('d/m') ?></b><br><?= $dateFormat->format('H:i') ?></td>
													<td>
														<?php
															if ($_SESSION['id_joueur'] == $reservation['id_joueur']) { ?>
																<form action="controler/suppression.php" method="POST">
																	<button onclick="return confirm('Supprimer votre réservation ?');" class="red darken-1 btn waves-effect waves-light" type="submit" name="id_creneau" value="<?= $creneau['id_creneau'] ?>"><i class="material-icons">cancel</i></button>
																</form>
														<?php } ?>
													</td>
												</tr>
										<?php } ?>
									</tbody>
								</table>

								<form class="col s12" method="POST" action="controler/inscription.php">
									<div class="row valign-wrapper row_player">
										<div class="input-field col s2" style="padding-left: 0">
											<p class="center">Je joue :</p>
										</div>
										<?php
											for ($i = 0; $i < $nbCreneaux; $i++){
												if ($creneau['creneau_' . $i . '_jour'] && $creneau['creneau_' . $i . '_horaire_debut'] && $creneau['creneau_' . $i . '_horaire_fin']) { ?>
													<div class="input-field col s2">
														<p>
															<label>
																<input id="check_ok<?= $i . $creneau['id_creneau'] ?>" type="checkbox" name="<?= 'creneau_' . $i . '_ok' ?>" <?php if ($row_connected_user['creneau_' . $i . '_ok']  != 0){ echo "checked=\"checked\""; } ?> />
																<span><?php
																		echo ucwords(strftime("%a", strtotime($creneau['creneau_' . $i . '_jour'])));
																		if ($i == 0) echo " matin";
																		else if ($i == 1) echo " apr.midi";
																		else if ($i == 2) echo " matin";
																		else if ($i == 3) echo " apr.midi";
																		else if ($i == 4) echo " matin";
																		else if ($i == 5) echo " apr.midi";
																		else if ($i == 6) echo " matin";
																		else if ($i == 7) echo " apr.midi";
																	?></span>
															</label>
														</p>
													</div>
												<?php }
											} ?>
									</div>

									<div class="row valign-wrapper row_org">
										<div class="input-field col s2" style="padding-left: 0">
											<p class="center">Je suis responsable :</p>
										</div>
										<?php
											for ($i = 0; $i < $nbCreneaux; $i++){
												if ($creneau['creneau_' . $i . '_jour'] && $creneau['creneau_' . $i . '_horaire_debut'] && $creneau['creneau_' . $i . '_horaire_fin']) { ?>
													<div class="input-field col s2">
														<p>
															<label>
																<input id="check_org<?= $i . $creneau['id_creneau'] ?>" type="checkbox" name="<?= 'creneau_' . $i . '_org' ?>" <?php if ($row_connected_user['creneau_' . $i . '_org'] != 0){ echo "checked=\"checked\""; } ?> />
																<span><?php
																		echo ucwords(strftime("%a", strtotime($creneau['creneau_' . $i . '_jour'])));
																		if ($i == 0) echo " matin";
																		else if ($i == 1) echo " apr.midi";
																		else if ($i == 2) echo " matin";
																		else if ($i == 3) echo " apr.midi";
																		else if ($i == 4) echo " matin";
																		else if ($i == 5) echo " apr.midi";
																		else if ($i == 6) echo " matin";
																		else if ($i == 7) echo " apr.midi";
																	?></span>
															</label>
														</p>
													</div>
												<?php }
											} ?>
										<input type="hidden" name="id_creneau" value="<?= $creneau['id_creneau'] ?>" />
									</div>

									<div class="row">
									<div class="row valign-wrapper row_player">
										<div class="input-field col s2" style="padding-left: 0">
											<p class="center">Je suis indisponible :</p>
										</div>
										<?php
											for ($i = 0; $i < $nbCreneaux; $i++){
												if ($creneau['creneau_' . $i . '_jour'] && $creneau['creneau_' . $i . '_horaire_debut'] && $creneau['creneau_' . $i . '_horaire_fin']) { ?>
													<div class="input-field col s2">
														<p>
															<label>
																<input id="check_indispo<?= $i . $creneau['id_creneau'] ?>" type="checkbox" name="<?= 'creneau_' . $i . '_indispo' ?>" <?php if ($row_connected_user['creneau_' . $i . '_ok'] == 2){ echo "checked=\"checked\""; } ?> />
																<span>
																	<?php
																		echo ucwords(strftime("%a", strtotime($creneau['creneau_' . $i . '_jour'])));
																		if ($i == 0) echo " matin";
																		else if ($i == 1) echo " apr.midi";
																		else if ($i == 2) echo " matin";
																		else if ($i == 3) echo " apr.midi";
																		else if ($i == 4) echo " matin";
																		else if ($i == 5) echo " apr.midi";
																		else if ($i == 6) echo " matin";
																		else if ($i == 7) echo " apr.midi";
																	?>
																</span>
															</label>
														</p>

														<script>
															if ($('#check_indispo<?= $i . $creneau['id_creneau'] ?>').is(":checked") ){
																$('#check_ok<?= $i . $creneau['id_creneau'] ?>').prop('checked', false).prop('disabled', true);
																$('#check_org<?= $i . $creneau['id_creneau'] ?>').prop('checked', false).prop('disabled', true);
															}

															$('#check_indispo<?= $i . $creneau['id_creneau'] ?>').on('change', function () {
																if ($('#check_indispo<?= $i . $creneau['id_creneau'] ?>').is(":checked")){
																	$('#check_ok<?= $i . $creneau['id_creneau'] ?>').prop('checked', false).prop('disabled', true);
																	$('#check_org<?= $i . $creneau['id_creneau'] ?>').prop('checked', false).prop('disabled', true);
																}
																else {
																	$('#check_ok<?= $i . $creneau['id_creneau'] ?>').prop('checked', false).prop('disabled', false);
																	$('#check_org<?= $i . $creneau['id_creneau'] ?>').prop('checked', false).prop('disabled', false);
																}
															});
														</script>

													</div>
												<?php }
											} ?>
										</div>

										<div class="center btn_register">
											<button class="btn blue waves-effect waves-light" type="submit" name="action">Enregistrer
												<i class="material-icons right">send</i>
											</button>
										</div>

									</div>
								</form>
							</div>
					<?php } } ?>

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
									<a class="lobster" href="https://github.com/StephSako/ESFTT-COVID-Planning-Spring-2021">Le projet</a>
								</div>
							</div>
						</div>
					</footer>
			<?php } ?>
		</div>
	</body>
</html>