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

        // on incrémente
        index++;
    }

    // la fonction qui ajoute un lien de suppression
    function addDeleteLink($prototype) {
        // Création du lien
        var $deleteLink = $('<a href="#" class="btn btn-danger">Supprimer</a>');

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