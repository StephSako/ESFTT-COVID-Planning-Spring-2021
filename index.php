<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>ESFTT Planning</title>
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
		include('model/bd_planning.php');
		
		$joueurs = mysqli_query($co, 'SELECT * FROM joueurs ORDER BY nom_joueur') or die("Impossible d'exécuter la requête des joueurs.");

		$inscriptions_22Jn_28Jn = mysqli_query($co, "SELECT * FROM 22Jn_28Jn INNER JOIN joueurs ON 22Jn_28Jn.id_joueur = joueurs.id ORDER BY dateInscription ASC");
		$inscriptions_29Jn_5Jt = mysqli_query($co, "SELECT * FROM 29Jn_5Jt INNER JOIN joueurs ON 29Jn_5Jt.id_joueur = joueurs.id ORDER BY dateInscription ASC");
		$inscriptions_6Jt_12Jt = mysqli_query($co, "SELECT * FROM 6Jt_12Jt INNER JOIN joueurs ON 6Jt_12Jt.id_joueur = joueurs.id ORDER BY dateInscription ASC");

		$rowCountInscr_22Jn_28Jn = mysqli_fetch_assoc(mysqli_query($co, "SELECT (SELECT COUNT(*) FROM 22Jn_28Jn WHERE mardi = 1) as nb_mardi, (SELECT COUNT(*) FROM 22Jn_28Jn WHERE mercredi = 1) as nb_mercredi, (SELECT COUNT(*) FROM 22Jn_28Jn WHERE vendredi = 1) as nb_vendredi, (SELECT COUNT(*) FROM 22Jn_28Jn WHERE dimanche_matin = 1) as nb_dimanche_matin FROM 22Jn_28Jn LIMIT 1"));
		$rowCountInscr_29Jn_5Jt = mysqli_fetch_assoc(mysqli_query($co, "SELECT (SELECT COUNT(*) FROM 29Jn_5Jt WHERE mardi = 1) as nb_mardi, (SELECT COUNT(*) FROM 29Jn_5Jt WHERE mercredi = 1) as nb_mercredi, (SELECT COUNT(*) FROM 29Jn_5Jt WHERE vendredi = 1) as nb_vendredi, (SELECT COUNT(*) FROM 29Jn_5Jt WHERE dimanche_matin = 1) as nb_dimanche_matin FROM 29Jn_5Jt LIMIT 1"));
		$rowCountInscr_6Jt_12Jt = mysqli_fetch_assoc(mysqli_query($co, "SELECT (SELECT COUNT(*) FROM 6Jt_12Jt WHERE mardi = 1) as nb_mardi, (SELECT COUNT(*) FROM 6Jt_12Jt WHERE mercredi = 1) as nb_mercredi, (SELECT COUNT(*) FROM 6Jt_12Jt WHERE vendredi = 1) as nb_vendredi, (SELECT COUNT(*) FROM 6Jt_12Jt WHERE dimanche_matin = 1) as nb_dimanche_matin FROM 6Jt_12Jt LIMIT 1"));
		
		$rowCountInscr_22Jn_28Jn_org = mysqli_fetch_assoc(mysqli_query($co, "SELECT (SELECT COUNT(*) FROM 22Jn_28Jn WHERE org_mardi = 1) as nb_mardi, (SELECT COUNT(*) FROM 22Jn_28Jn WHERE org_mercredi = 1) as nb_mercredi, (SELECT COUNT(*) FROM 22Jn_28Jn WHERE org_vendredi = 1) as nb_vendredi, (SELECT COUNT(*) FROM 22Jn_28Jn WHERE org_dimanche_matin = 1) as nb_dimanche_matin FROM 22Jn_28Jn LIMIT 1"));
		$rowCountInscr_29Jn_5Jt_org = mysqli_fetch_assoc(mysqli_query($co, "SELECT (SELECT COUNT(*) FROM 29Jn_5Jt WHERE org_mardi = 1) as nb_mardi, (SELECT COUNT(*) FROM 29Jn_5Jt WHERE org_mercredi = 1) as nb_mercredi, (SELECT COUNT(*) FROM 29Jn_5Jt WHERE org_vendredi = 1) as nb_vendredi, (SELECT COUNT(*) FROM 29Jn_5Jt WHERE org_dimanche_matin = 1) as nb_dimanche_matin FROM 29Jn_5Jt LIMIT 1"));
		$rowCountInscr_6Jt_12Jt_org = mysqli_fetch_assoc(mysqli_query($co, "SELECT (SELECT COUNT(*) FROM 6Jt_12Jt WHERE org_mardi = 1) as nb_mardi, (SELECT COUNT(*) FROM 6Jt_12Jt WHERE org_mercredi = 1) as nb_mercredi, (SELECT COUNT(*) FROM 6Jt_12Jt WHERE org_vendredi = 1) as nb_vendredi, (SELECT COUNT(*) FROM 6Jt_12Jt WHERE org_dimanche_matin = 1) as nb_dimanche_matin FROM 6Jt_12Jt LIMIT 1"));
	?>

	<div class="container">
		<div class="titre">
			<h2 class="center"><b>Planning de réservations</b></h1>
			<h4 class="center"><b>ESFTT - Reprise été 2020</b></h3>
		</div>

		<div class="semaine red lighten-4 cartouche_infos">
			<p class="center red-text"><b>Le site n'est maintenant plus actif ni interactif en raison de la fin des entraînements de reprise.</b></p>
		</div>

		<div class="semaine cartouche_infos">
			<h5 class="center"><b>Règlements</b></h5>

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

			<blockquote>Voici le schema d'installation des tables jusqu'au <b>12 Juillet</b> normalement :<br>
				<div class="center"><img class="responsive-img" width="60%" height="60%" src="https://scontent-cdt1-1.xx.fbcdn.net/v/t1.15752-9/104635673_279499220079736_793975621420349828_n.jpg?_nc_cat=110&_nc_sid=b96e70&_nc_ohc=o4DBMR1if2gAX-Etesb&_nc_ht=scontent-cdt1-1.xx&oh=ca492d77084ccfdfd817ef35e1d8fa23&oe=5F126E40"></div>
			</blockquote>

			<blockquote class="black-text"><b>Au moindre problème</b>, <b>suggestion</b> ou <b>remarque</b>, contactez-moi par mail à <a href="mailto:stephen.sakovitch@orange.fr?subject=Réservation ESFTT - été 2020">stephen.sakovitch@orange.fr</a>, sur Messenger, WhatsApp ou par SMS.</blockquote>
		
			<h6 class="center red-text"><i class="material-icons red-text">report_problem</i> <b>S'il vous plaît</b>, le site a été développé en peu de temps et n'a donc pas de sécurité poussée :<br>ne supprimez pas les réservations des autres ! <i class="material-icons red-text">remove_red_eye</i><i class="material-icons red-text">remove_red_eye</i></h6>
		</div>

		<div class="semaine green lighten-4 cartouche_infos">
			<blockquote>Pour <b>modifier</b> votre réservation d'une semaine, il faut <b>re-cocher toutes les cases des jours</b> de la semaine pour lesquels vous souhaitez participer.<br>
			Pour <b>supprimer</b> votre réservation d'une semaine, cliquer sur le bouton rouge en face de votre nom dans la liste.</blockquote>
		</div>

		<div class="container cartouche_infos">
			<ul class="collection with-header semaine blue lighten-4 infos_indispos" style="padding-left: 20px;">
				<li class="collection-header blue lighten-4"><h5><span class="blue-text text-darken-2"><i class="material-icons">info</i></span> La salle est indisponible pour les dates suivantes :</h5></li>
				<li class="collection-item blue lighten-4 center"><b>Mercredi 24 Juin</b> remplacé par le <b>Jeudi 25 Juin</b></li>
				<li class="collection-item blue lighten-4 center"><b>Mercredi 1er Juillet</b> remplacé par le <b>Jeudi 2 Juillet</b></li>
			</ul>
		</div>

		<div class="semaine">
			<div class="row">
				<div class="col s2 center"><h5><b>Légendes</b></h5></div>
				<div class="col s3 center"><p><i class="material-icons green-text lighten-3">check_circle</i><br>Joueur prioritaire <b>du jour</b></p></div>
				<div class="col s4 center"><p><i class="material-icons red-text lighten-3">check_circle</i><br>Joueur non prioritaire <b>du jour</b></p></div>
				<div class="col s3 center"><p><i class="material-icons">remove_red_eye</i><br>Organisateur COVID</p></div>
			</div>
		</div>

		<div class="semaine">
			<h4 class="center title_semaine">Semaine du 22 Juin au 28 Juin 2020</h4>
			<table class="centered">
				<thead>
					<tr>
						<th></th>

						<th>Mardi 23 Juin<br>
							<span class="badge white-text grey darken-2">19h30-22h00</span><br>
							<span class="badge <?php if ($rowCountInscr_22Jn_28Jn['nb_mardi'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_22Jn_28Jn['nb_mardi'] != null ? $rowCountInscr_22Jn_28Jn['nb_mardi'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_22Jn_28Jn_org['nb_mardi'] == 0 && $rowCountInscr_22Jn_28Jn['nb_mardi'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_22Jn_28Jn_org['nb_mardi'] < 2 && $rowCountInscr_22Jn_28Jn['nb_mardi'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_22Jn_28Jn_org['nb_mardi'] != null ? $rowCountInscr_22Jn_28Jn_org['nb_mardi'] : '0') . ' organisat.'; ?></span>
						</th>

						<th>Jeudi 25 Juin<br>
							<span class="badge white-text grey darken-2">19h30-22h00</span><br>
							<span class="badge <?php if ($rowCountInscr_22Jn_28Jn['nb_mercredi'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_22Jn_28Jn['nb_mercredi'] != null ? $rowCountInscr_22Jn_28Jn['nb_mercredi'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_22Jn_28Jn_org['nb_mercredi'] == 0 && $rowCountInscr_22Jn_28Jn['nb_mercredi'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_22Jn_28Jn_org['nb_mercredi'] < 2 && $rowCountInscr_22Jn_28Jn['nb_mercredi'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_22Jn_28Jn_org['nb_mercredi'] != null ? $rowCountInscr_22Jn_28Jn_org['nb_mercredi'] : '0') . ' organisat.'; ?></span>
						</th>

						<th>Vendredi 26 Juin<br>
							<span class="badge white-text grey darken-2">19h30-22h00</span><br>
							<span class="badge <?php if ($rowCountInscr_22Jn_28Jn['nb_vendredi'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_22Jn_28Jn['nb_vendredi'] != null ? $rowCountInscr_22Jn_28Jn['nb_vendredi'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_22Jn_28Jn_org['nb_vendredi'] == 0 && $rowCountInscr_22Jn_28Jn['nb_vendredi'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_22Jn_28Jn_org['nb_vendredi'] < 2 && $rowCountInscr_22Jn_28Jn['nb_vendredi'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_22Jn_28Jn_org['nb_vendredi'] != null ? $rowCountInscr_22Jn_28Jn_org['nb_vendredi'] : '0') . ' organisat.'; ?></span>
						</th>

						<th>Dimanche matin<br>28 Juin<br>
							<span class="badge white-text grey darken-2">10h00-12h00</span><br>
							<span class="badge <?php if ($rowCountInscr_22Jn_28Jn['nb_dimanche_matin'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_22Jn_28Jn['nb_dimanche_matin'] != null ? $rowCountInscr_22Jn_28Jn['nb_dimanche_matin'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_22Jn_28Jn_org['nb_dimanche_matin'] == 0 && $rowCountInscr_22Jn_28Jn['nb_dimanche_matin'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_22Jn_28Jn_org['nb_dimanche_matin'] < 2 && $rowCountInscr_22Jn_28Jn['nb_dimanche_matin'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_22Jn_28Jn_org['nb_dimanche_matin'] != null ? $rowCountInscr_22Jn_28Jn_org['nb_dimanche_matin'] : '0') . ' organisat.'; ?></span>
						</th>

						<th></th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$i_mardi 			= 0;
						$i_vendredi 		= 0;
						$i_jeudi	 		= 0;
						$i_dimanche_matin 	= 0;
						
						while ($row = mysqli_fetch_assoc($inscriptions_22Jn_28Jn)) {
							$dateFormat = new DateTime($row['dateInscription']); ?>
							<tr>
								<td>
									<?= $row['nom_joueur'] ?>
								</td>
								<td>
									<?php 
										if ($row['mardi']) { $i_mardi++; ?> <i class="material-icons <?php if ($i_mardi > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
										if ($row['org_mardi']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td>";
									if ($row['mercredi']) { $i_jeudi++; ?> <i class="material-icons <?php if ($i_jeudi > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
									if ($row['org_mercredi']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td>";
									if ($row['vendredi']) { $i_vendredi++; ?> <i class="material-icons <?php if ($i_vendredi > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
									if ($row['org_vendredi']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td>";
									if ($row['dimanche_matin']) { $i_dimanche_matin++; ?> <i class="material-icons <?php if ($i_dimanche_matin > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
									if ($row['org_dimanche_matin']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td style='font-size: 10pt'><b>" . $dateFormat->format('d/m/Y') . "</b><br>" . $dateFormat->format('H:i') . "</td>"; ?>
								<td>
									<!--form action="controler/planning/suppression.php" method="POST"-->
										<input type="hidden" name="table" value="22Jn_28Jn" />
										<button class="red darken-1 btn waves-effect waves-light" type="submit" name="delete" value="<?php echo $row['id_joueur']; ?>"><i class="material-icons">cancel</i></button>
									<!--/form-->
								</td>
							</tr>
						<?php }
					?>
				</tbody>
			</table><br><br>

			<!--form class="col s12" method="POST" action="controler/planning/inscription.php"-->
				<div class="row">
					<div class="row valign-wrapper row_player">
						<div class="input-field col s2">
							<select name="id_joueur" class="browser-default" required>
								<option disabled selected>Votre nom</option>
								<?php
									while ($row = mysqli_fetch_assoc($joueurs)) {
										echo "<option value=\"".$row['id']."\">".$row['nom_joueur']."</option>";
									}
								?>
							</select>
						</div>
						<div class="input-field col s2">
							<p class="center">Je souhaite jouer :</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="mardi" />
									<span>Mardi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="mercredi" />
									<span>Jeudi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="vendredi" />
									<span>Vendredi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="dimanche_matin" />
									<span>Dimanche matin</span>
								</label>
							</p>
						</div>
					</div>

					<div class="row valign-wrapper row_org">
						<div class="input-field col s2">
							<span></span>
						</div>
						<div class="input-field col s2">
							<p class="center">Je me propose organisateur COVID pour :</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_mardi" />
									<span>Mardi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_mercredi" />
									<span>Jeudi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_vendredi" />
									<span>Vendredi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_dimanche_matin" />
									<span>Dimanche matin</span>
								</label>
							</p>
						</div>
						<input type="hidden" name="table" value="22Jn_28Jn" />
					</div>

					<div class="center btn_register">
						<button class="btn waves-effect waves-light" type="submit" name="action">S'enregistrer
							<i class="material-icons right">send</i>
						</button>
					</div>

				</div>
			<!--/form-->
		</div>

		<div class="semaine">
			<h4 class="center title_semaine">Semaine du 29 Juin au 5 Juillet 2020</h4>
			<table class="centered">
				<thead>
					<tr>
						<th></th>

						<th>Mardi 30 Juin<br>
							<span class="badge white-text grey darken-2">20h00-22h00</span><br>
							<span class="badge <?php if ($rowCountInscr_29Jn_5Jt['nb_mardi'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_29Jn_5Jt['nb_mardi'] != null ? $rowCountInscr_29Jn_5Jt['nb_mardi'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_29Jn_5Jt_org['nb_mardi'] == 0 && $rowCountInscr_29Jn_5Jt['nb_mardi'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_29Jn_5Jt_org['nb_mardi'] < 2 && $rowCountInscr_29Jn_5Jt['nb_mardi'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_29Jn_5Jt_org['nb_mardi'] != null ? $rowCountInscr_29Jn_5Jt_org['nb_mardi'] : '0') . ' organisat.'; ?></span>
						</th>

						<th>Jeudi 2 Juillet<br>
							<span class="badge white-text grey darken-2">19h30-22h00</span><br>
							<span class="badge <?php if ($rowCountInscr_29Jn_5Jt['nb_mercredi'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_29Jn_5Jt['nb_mercredi'] != null ? $rowCountInscr_29Jn_5Jt['nb_mercredi'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_29Jn_5Jt_org['nb_mercredi'] == 0 && $rowCountInscr_29Jn_5Jt['nb_mercredi'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_29Jn_5Jt_org['nb_mercredi'] < 2 && $rowCountInscr_29Jn_5Jt['nb_mercredi'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_29Jn_5Jt_org['nb_mercredi'] != null ? $rowCountInscr_29Jn_5Jt_org['nb_mercredi'] : '0') . ' organisat.'; ?></span>
						</th>

						<th>Vendredi 3 Juillet<br>
							<span class="badge white-text grey darken-2">19h30-22h00</span><br>
							<span class="badge <?php if ($rowCountInscr_29Jn_5Jt['nb_vendredi'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_29Jn_5Jt['nb_vendredi'] != null ? $rowCountInscr_29Jn_5Jt['nb_vendredi'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_29Jn_5Jt_org['nb_vendredi'] == 0 && $rowCountInscr_29Jn_5Jt['nb_vendredi'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_29Jn_5Jt_org['nb_vendredi'] < 2 && $rowCountInscr_29Jn_5Jt['nb_vendredi'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_29Jn_5Jt_org['nb_vendredi'] != null ? $rowCountInscr_29Jn_5Jt_org['nb_vendredi'] : '0') . ' organisat.'; ?></span>
						</th>

						<th>Dimanche matin<br>5 Juillet<br>
							<span class="badge white-text grey darken-2">10h00-12h00</span><br>
							<span class="badge <?php if ($rowCountInscr_29Jn_5Jt['nb_dimanche_matin'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_29Jn_5Jt['nb_dimanche_matin'] != null ? $rowCountInscr_29Jn_5Jt['nb_dimanche_matin'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_29Jn_5Jt_org['nb_dimanche_matin'] == 0 && $rowCountInscr_29Jn_5Jt['nb_dimanche_matin'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_29Jn_5Jt_org['nb_dimanche_matin'] < 2 && $rowCountInscr_29Jn_5Jt['nb_dimanche_matin'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_29Jn_5Jt_org['nb_dimanche_matin'] != null ? $rowCountInscr_29Jn_5Jt_org['nb_dimanche_matin'] : '0') . ' organisat.'; ?></span>
						</th>

						<th></th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$i_mardi 			= 0;
						$i_vendredi 		= 0;
						$i_jeudi 			= 0;
						$i_dimanche_matin 	= 0;

						while ($row = mysqli_fetch_assoc($inscriptions_29Jn_5Jt)) {
							$dateFormat = new DateTime($row['dateInscription']); ?>

							<tr>
								<td>
									<?= $row['nom_joueur'] ?>
								</td>
								<td>
									<?php 
										if ($row['mardi']) { $i_mardi++; ?> <i class="material-icons <?php if ($i_mardi > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
										if ($row['org_mardi']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td>";
									if ($row['mercredi']) { $i_jeudi++; ?> <i class="material-icons <?php if ($i_jeudi > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
									if ($row['org_mercredi']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td>";
									if ($row['vendredi']) { $i_vendredi++; ?> <i class="material-icons <?php if ($i_vendredi > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
									if ($row['org_vendredi']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td>";
									if ($row['dimanche_matin']) { $i_dimanche_matin++; ?> <i class="material-icons <?php if ($i_dimanche_matin > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
									if ($row['org_dimanche_matin']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td style='font-size: 10pt'><b>" . $dateFormat->format('d/m/Y') . "</b><br>" . $dateFormat->format('H:i') . "</td>"; ?>
								<td>
									<!--form action="controler/planning/suppression.php" method="POST"-->
										<input type="hidden" name="table" value="29Jn_5Jt" />
										<button class="red darken-1 btn waves-effect waves-light" type="submit" name="delete" value="<?php echo $row['id_joueur']; ?>"><i class="material-icons">cancel</i></button>
									<!--/form-->
								</td>
							</tr>
						<?php }
					?>
				</tbody>
			</table><br><br>
			
			<!--form class="col s12" method="POST" action="controler/planning/inscription.php"-->
				<div class="row">
					<div class="row valign-wrapper row_player">
						<div class="input-field col s2">
							<select name="id_joueur" class="browser-default" required>
								<option disabled selected>Votre nom</option>
								<?php
									mysqli_data_seek($joueurs, 0);
									while ($row = mysqli_fetch_assoc($joueurs)) {
										echo "<option value=\"".$row['id']."\">".$row['nom_joueur']."</option>";
									}
								?>
							</select>
						</div>
						<div class="input-field col s3">
							<p class="center">Je souhaite jouer :</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="mardi" />
									<span>Mardi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="mercredi" />
									<span>Jeudi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="vendredi" />
									<span>Vendredi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s3">
							<p>
								<label>
									<input type="checkbox" name="dimanche_matin" />
									<span>Dimanche matin</span>
								</label>
							</p>
						</div>
					</div>

					<div class="row valign-wrapper row_org">
						<div class="input-field col s2">
							<span></span>
						</div>
						<div class="input-field col s3">
							<p class="center">Je me propose organisateur COVID pour :</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_mardi" />
									<span>Mardi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_mercredi" />
									<span>Jeudi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_vendredi" />
									<span>Vendredi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s3">
							<p>
								<label>
									<input type="checkbox" name="org_dimanche_matin" />
									<span>Dimanche matin</span>
								</label>
							</p>
						</div>
						<input type="hidden" name="table" value="29Jn_5Jt" />
					</div>

					<div class="center btn_register">
						<button class="btn waves-effect waves-light" type="submit" name="action">S'enregistrer
							<i class="material-icons right">send</i>
						</button>
					</div>

				</div>
			<!--/form-->
		</div>

		<div class="semaine">
			<h4 class="center title_semaine">Semaine du 6 Juillet au 12 Juillet 2020</h4>
			<table class="centered">
				<thead>
					<tr>
						<th></th>
						
						<th>Mardi 7 Juillet<br>
							<span class="badge white-text grey darken-2">19h30-22h00</span><br>
							<span class="badge <?php if ($rowCountInscr_6Jt_12Jt['nb_mardi'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_6Jt_12Jt['nb_mardi'] != null ? $rowCountInscr_6Jt_12Jt['nb_mardi'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_6Jt_12Jt_org['nb_mardi'] == 0 && $rowCountInscr_6Jt_12Jt['nb_mardi'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_6Jt_12Jt_org['nb_mardi'] < 2 && $rowCountInscr_6Jt_12Jt['nb_mardi'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_6Jt_12Jt_org['nb_mardi'] != null ? $rowCountInscr_6Jt_12Jt_org['nb_mardi'] : '0') . ' organisat.'; ?></span>
						</th>

						<th>Mercredi 8 Juillet<br>
							<span class="badge white-text grey darken-2">19h30-22h00</span><br>
							<span class="badge <?php if ($rowCountInscr_6Jt_12Jt['nb_mercredi'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_6Jt_12Jt['nb_mercredi'] != null ? $rowCountInscr_6Jt_12Jt['nb_mercredi'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_6Jt_12Jt_org['nb_mercredi'] == 0 && $rowCountInscr_6Jt_12Jt['nb_mercredi'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_6Jt_12Jt_org['nb_mercredi'] < 2 && $rowCountInscr_6Jt_12Jt['nb_mercredi'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_6Jt_12Jt_org['nb_mercredi'] != null ? $rowCountInscr_6Jt_12Jt_org['nb_mercredi'] : '0') . ' organisat.'; ?></span>
						</th>

						<th>Vendredi 10 Juillet<br>
							<span class="badge white-text grey darken-2">19h30-22h00</span><br>
							<span class="badge <?php if ($rowCountInscr_6Jt_12Jt['nb_vendredi'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_6Jt_12Jt['nb_vendredi'] != null ? $rowCountInscr_6Jt_12Jt['nb_vendredi'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_6Jt_12Jt_org['nb_vendredi'] == 0 && $rowCountInscr_6Jt_12Jt['nb_vendredi'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_6Jt_12Jt_org['nb_vendredi'] < 2 && $rowCountInscr_6Jt_12Jt['nb_vendredi'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_6Jt_12Jt_org['nb_vendredi'] != null ? $rowCountInscr_6Jt_12Jt_org['nb_vendredi'] : '0') . ' organisat.'; ?></span>
						</th>

						<th>Dimanche matin<br>12 Juillet<br>
							<span class="badge white-text grey darken-2">10h00-12h00</span><br>
							<span class="badge <?php if ($rowCountInscr_6Jt_12Jt['nb_dimanche_matin'] > 10) echo "red-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_6Jt_12Jt['nb_dimanche_matin'] != null ? $rowCountInscr_6Jt_12Jt['nb_dimanche_matin'] : '0') . ' joueurs'; ?></span><br>
							<span class="badge <?php if ($rowCountInscr_6Jt_12Jt_org['nb_dimanche_matin'] == 0 && $rowCountInscr_6Jt_12Jt['nb_dimanche_matin'] > 0) echo "red-text darken-1"; else if ($rowCountInscr_6Jt_12Jt_org['nb_dimanche_matin'] < 2 && $rowCountInscr_6Jt_12Jt['nb_dimanche_matin'] > 0) echo "orange-text darken-1"; else echo "green-text lighten-3"; ?>"><?php echo ($rowCountInscr_6Jt_12Jt_org['nb_dimanche_matin'] != null ? $rowCountInscr_6Jt_12Jt_org['nb_dimanche_matin'] : '0') . ' organisat.'; ?></span>
						</th>
						
						<th></th>
						<th></th>
					</tr>
				</thead>

				<tbody>
					<?php
						$i_mardi 			= 0;
						$i_mercredi 		= 0;
						$i_vendredi 		= 0;
						$i_dimanche_matin 	= 0;

						while ($row = mysqli_fetch_assoc($inscriptions_6Jt_12Jt)) {
							$dateFormat = new DateTime($row['dateInscription']); ?>
							<tr>
								<td>
									<?= $row['nom_joueur'] ?>
								</td>
								<td>
									<?php 
										if ($row['mardi']) { $i_mardi++; ?> <i class="material-icons <?php if ($i_mardi > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
										if ($row['org_mardi']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td>";
									if ($row['mercredi']) { $i_mercredi++; ?> <i class="material-icons <?php if ($i_mercredi > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
									if ($row['org_mercredi']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td>";
									if ($row['vendredi']) { $i_vendredi++; ?> <i class="material-icons <?php if ($i_vendredi > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
									if ($row['org_vendredi']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td>";
									if ($row['dimanche_matin']) { $i_dimanche_matin++; ?> <i class="material-icons <?php if ($i_dimanche_matin > 10) echo 'red-text lighten-3'; else echo 'green-text lighten-3'; ?>" >check_circle</i> <?php }
									if ($row['org_dimanche_matin']) echo "<i class='material-icons'>remove_red_eye</i>";
								echo "</td>

								<td style='font-size: 10pt'><b>" . $dateFormat->format('d/m/Y') . "</b><br>" . $dateFormat->format('H:i') . "</td>"; ?>
								<td>
									<!--form action="controler/planning/suppression.php" method="POST"-->
										<input type="hidden" name="table" value="6Jt_12Jt" />
										<button class="red darken-1 btn waves-effect waves-light" type="submit" name="delete" value="<?php echo $row['id_joueur']; ?>"><i class="material-icons">cancel</i></button>
									<!--/form-->
								</td>
							</tr>
						<?php }
					?>
				</tbody>
			</table><br><br>

			<!--form class="col s12" method="POST" action="controler/planning/inscription.php"-->
				<div class="row">
					<div class="row valign-wrapper row_player">
						<div class="input-field col s2">
							<select name="id_joueur" class="browser-default" required>
								<option disabled selected>Votre nom</option>
								<?php
									mysqli_data_seek($joueurs, 0);
									while ($row = mysqli_fetch_assoc($joueurs)) {
										echo "<option value=\"".$row['id']."\">".$row['nom_joueur']."</option>";
									}
								?>
							</select>
						</div>
						<div class="input-field col s2">
							<p class="center">Je souhaite jouer :</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="mardi" />
									<span>Mardi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="mercredi" />
									<span>Mercredi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="vendredi" />
									<span>Vendredi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="dimanche_matin" />
									<span>Dimanche matin</span>
								</label>
							</p>
						</div>
					</div>

					<div class="row valign-wrapper row_org">
						<div class="input-field col s2">
							<span></span>
						</div>
						<div class="input-field col s2">
							<p class="center">Je me propose organisateur COVID pour :</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_mardi" />
									<span>Mardi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_mercredi" />
									<span>Mercredi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_vendredi" />
									<span>Vendredi</span>
								</label>
							</p>
						</div>
						<div class="input-field col s2">
							<p>
								<label>
									<input type="checkbox" name="org_dimanche_matin" />
									<span>Dimanche matin</span>
								</label>
							</p>
						</div>
						<input type="hidden" name="table" value="6Jt_12Jt" />
					</div>

					<div class="center btn_register">
						<button class="btn waves-effect waves-light" type="submit" name="action">S'enregistrer
							<i class="material-icons right">send</i>
						</button>
					</div>

				</div>
			<!--/form-->
		</div>

		<footer class="page-footer grey lighten-3">
    		<div class="container">
				<div class="row">
					<div class="col s4 center">
						<a href="https://www.esftt.com/"><img class="responsive-img" width="70" height="70" src="https://www.esftt.com/images/logo-new.png"></a>
					</div>
					<div class="col s4 center">
						<a href="https://github.com/StephSako?tab=repositories">Le développeur</a>
					</div>
					<div class="col s4 center">
						<a  href="https://github.com/StephSako/ESFTT-planning">Le projet</a>
					</div>
				</div>
        	</div>
        	<div class="footer-copyright">
        		<div class="container black-text">© 2020 Copyright Text</div>
        	</div>
        </footer>
			
		<!--Scripts trigger de Materialize-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
	</body>

</html>