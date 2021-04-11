<?php
    include('../model/bd_planning.php');
    include('../model/Creneau.php');
    header('Location:../backoffice.php');

    if(!empty($_POST['id_creneau']) && !empty($_POST['jour_debut']) && !empty($_POST['jour_fin'])) {

        $jour_debut = explode('/', $_POST['jour_debut']);
        $jour_debut = $jour_debut[2] . '-' . $jour_debut[1] . '-' . $jour_debut[0] . ' 23:59:59';
        $jour_fin = explode('/', $_POST['jour_fin']);
        $jour_fin = $jour_fin[2] . '-' . $jour_fin[1] . '-' . $jour_fin[0] . ' 23:59:59';

        $horaire_debut = array_fill(0, $nbCreneaux, null);
        $horaire_fin = array_fill(0, $nbCreneaux, null);
        $jour = array_fill(0, $nbCreneaux, null);

        for ($i = 0; $i < $nbCreneaux; $i++) {
            $horaire_debut[$i] = !empty($_POST['horaire_debut' . $i]) ? htmlspecialchars($_POST['horaire_debut' . $i]) : null;
            $horaire_fin[$i] = !empty($_POST['horaire_fin' . $i]) ? htmlspecialchars($_POST['horaire_fin' . $i]) : null;
            
            if (!empty(trim(htmlspecialchars($_POST['jour' . $i])))) {
                $jour_splited = explode('/', htmlspecialchars($_POST['jour' . $i]));
                $jour_splited = $jour_splited[2] . '-' . $jour_splited[1] . '-' . $jour_splited[0];
                $jour[$i] = $jour_splited . ' 23:59:59';
            } else $jour[$i] = null;
        }

        $creneau = new Creneau();
        $creneau->modification($_POST['id_creneau'], $jour_debut, $jour_fin, $horaire_debut, $horaire_fin, $jour);
	}