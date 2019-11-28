'use strict';

//
// FONCTIONS //
//

//
// VARIABLES & CONSTANTES //
//
const hash = window.location.hash;
//
// CODE //
//
if(hash) {
    $('a[href="'+hash+'"]').tab('show');
}

const deleteButtons = document.querySelectorAll('.delete-button');

for(const button of deleteButtons){
    button.addEventListener('click', (e) => {
        //la fonction preventDefault empeche le fonctionnement normal du navigateur
        e.preventDefault();
        //affichage d'une fenetre d'alerte pour poser la question " Êtes-vous sûr"
        const userConfirm = window.confirm('Êtes-vous sûr de vouloir supprimer ?');

        if(userConfirm){
            //requete ajax
            const url = e.currentTarget.href;
            $.post(url, (id)=> {
                const trElement = document.getElementById(id);
                trElement.parentNode.removeChild(trElement);
            });
        }
    });
}