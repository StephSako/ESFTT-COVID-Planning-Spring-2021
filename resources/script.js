$(document).ready(function(){
    $('.datepicker').datepicker({
        format: 'd/m/yyyy',
        i18n: {
            cancel: 'Annuler',
            done: 'OK',
            months: [
                'Janvier',
                'Février',
                'Mars',
                'Avril',
                'Mai',
                'Juin',
                'Juillet',
                'Août',
                'Septembre',
                'Octobre',
                'Novembre',
                'Décembre'
            ],
            monthsShort: [
                'Jan',
                'Fév',
                'Mar',
                'Avr',
                'Mai',
                'Jui',
                'Jul',
                'Aoû',
                'Sep',
                'Oct',
                'Nov',
                'Déc'
            ],
            weekdays: [
                'Dimanche',
                'Lundi',
                'Jeudi',
                'Mercredi',
                'Jeudi',
                'Vendredi',
                'Samedi'
            ],
            weekdaysShort: [
                'Dim',
                'Lun',
                'Mar',
                'Mer',
                'Jeu',
                'Ven',
                'Sam'
            ],
            weekdaysAbbrev: ['D','L','M','M','J','V','S']
        }
    });

    $('.timepicker').timepicker({
        twelveHour: false,
        i18n: {
            cancel: 'Annuler',
            done: 'OK'
        }
    });
});