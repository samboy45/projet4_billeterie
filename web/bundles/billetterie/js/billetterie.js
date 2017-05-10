
/* ----------------------------------------
 AJOUT ET SUPPRESSION DE BILLET
 ---------------------------------------- */

$(document).ready(function () {
    // récupération de la balise div contenant l'attribut data-prototype

    var $container = $('div#billetteriebundle_commande_billets');

    // compteur unique pour nommer les champs ajouter dynamiquement
    var index = $container.find(':input').length;

    // ajout d'un new form à chaque clic sur le lien d'ajout
    $('#add_billet').click(function (e) {
        addBillet($container);

        e.preventDefault();
        return false;
    });

    // ajout d'un premier champ automatiquement
    if (index == 0){
        addBillet($container);
    }else {
        // s'il existe déjas des billets, on  ajoute un lien de suppression pour chacune d'entre elles
        $container.children('div').each(function () {
            addDeleteLink($(this));
        });
    }

    // La fonction qui ajoute un formulaire billet
    function addBillet($container) {
        var template = $container.attr('data-prototype')
                .replace(/__name__label__/g, '')
            .replace(/__name__/g, index)
        ;

        //objet jquery qui contient ce template
        var $prototype = $(template);

        // ajoute au prototype pour pouvoir supprimer le billet
        addDeleteLink($prototype);

        // ajoute le prototype modifié à la fin de la balise <div>
        $container.append($prototype);
        $('.dateOfBirth').mask("99-99-9999",{placeholder:"JJ-MM-AAAA"});
        // on incrémente
        index++;
    }

    // la fonction qui ajoute un lien de suppression
    function addDeleteLink($prototype) {
        // Création du lien
        var $deleteLink = $('<a href="#" class="btn red">Supprimer</a>');

        // Ajout du lien
        $prototype.append($deleteLink);

        //Ajout du listener sur le clic du lien
        $deleteLink.click(function (e) {
            $prototype.remove();

            e.preventDefault();
            return false;
        });
    }
});

/* ----------------------------------------
 DATEPICKER
 ---------------------------------------- */

var maDate = new Date();
var year = maDate.getFullYear();
var G = year%19;
var C = Math.floor(year/100);
var H = (C - Math.floor(C/4) - Math.floor((8*C+13)/25) + 19*G + 15)%30;
var I = H - Math.floor(H/28)*(1 - Math.floor(H/28)*Math.floor(29/(H + 1))*Math.floor((21 - G)/11));
var J = (year + Math.floor(year/4) + I + 2 - C + Math.floor(C/4))%7;
var L = I - J;
var MoisPaques = 3 + Math.floor((L + 40)/44);
var JourPaques = L + 28 - 31*Math.floor(MoisPaques/4);
$('.datepicker').pickadate({

    selectMonths: true, // Creates a dropdown to control month
    selectYears: 2,
    monthsFull: [ 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre' ],
    monthsShort: [ 'Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Juin', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec' ],
    weekdaysFull: [ 'Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi' ],
    weekdaysShort: [ 'Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam' ],
    today: 'Aujourd\'hui',
    clear: 'Effacer',
    close: false,
    format: 'dd mmmm yyyy',
    formatSubmit: 'yyyy-mm-dd',
    labelMonthNext:"Mois suivant",
    labelMonthPrev:"Mois précédent",
    labelMonthSelect:"Sélectionner un mois",
    labelYearSelect:"Sélectionner une année",


    // An integer (positive/negative) sets it relative to today.
    min: true,
    // `true` sets it to today. `false` removes any limits.
    max: false,
    firstDay: 1,
    disable: [
        2,7,
        //Année courant
        new Date(year, 0, 1), //jour de l'an
        new Date(year, 4, 1), //fête du travail
        new Date(year, 4, 8), //8 mai 1945
        new Date(year, 6, 14), //Fête nationale
        new Date(year, 7, 15), //Assomption
        new Date(year, 10, 1), //Toussaint
        new Date(year, 10, 11), //Armistice
        new Date(year, 11, 25), //Noel
        new Date(year, MoisPaques-1, JourPaques),//Paques
        new Date(year, MoisPaques-1, JourPaques+1),//lundi de paques
        new Date(year, MoisPaques-1, JourPaques+39),//Ascension
        new Date(year, MoisPaques-1, JourPaques+49),//jourPaques
        new Date(year, MoisPaques-1, JourPaques+50),//LundiPentecote
        //Année suivante
        new Date(year+1, 0, 1), //jour de l'an
        new Date(year+1, 4, 1), //fête du travail
        new Date(year+1, 4, 8), //8 mai 1945
        new Date(year+1, 6, 14), //Fête nationale
        new Date(year+1, 7, 15), //Assomption
        new Date(year+1, 10, 1), //Toussaint
        new Date(year+1, 10, 11), //Armistice
        new Date(year+1, 11, 25), //Noel
        new Date(year+1, MoisPaques-1, JourPaques),//Paques
        new Date(year+1, MoisPaques-1, JourPaques+1),//lundi de paques
        new Date(year+1, MoisPaques-1, JourPaques+39),//Ascension
        new Date(year+1, MoisPaques-1, JourPaques+49),//jourPaques
        new Date(year+1, MoisPaques-1, JourPaques+50)//LundiPentecote
    ]
});


jQuery(function($){
    $('.dateOfBirth').mask("99-99-9999",{placeholder:"JJ-MM-AAAA"});
});
