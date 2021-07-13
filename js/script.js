M.AutoInit();
afficherCommentaire();

function showHideAddProduct() {
  let divAddProducts = document.getElementById("formAddProduct");
  let tableViewProducts = document.getElementById("tableProduct");
  let speechAjoutProduit = document.getElementById("divAjouterProduit");
  if (divAddProducts.style.display === "block") {
    divAddProducts.style.display = "none";
    tableViewProducts.style.display = "block";
    speechAjoutProduit.style.display = "block";
  } else {
    divAddProducts.style.display = "block";
    tableViewProducts.style.display = "none";
    speechAjoutProduit.style.display = "none";
  }
}

function modifyProductsHideForms() {
  const tableToHide = document.getElementById("tableProducts");
  const modify = document.getElementById("modifyProduct");

  modify.addEventListener("click", () => {
    tableToHide.style.display = "none";
  });
}

function hideToModify(){
  let mainHide = document.getElementById("mainProduits"); //Je recupère l'id du main
  if (window.location.search.indexOf('show') > -1) { //Si l'index "show" est present dans l'url,
    mainHide.style.display = "none"; //on cache le main
  }
}
hideToModify(); //Execution de la function au dessus

function hideToModifyUsers(){
  let mainUsersHide = document.getElementById("mainUsers");
  if (window.location.search.indexOf('userModif') > -1) { //Si l'index "show" est present dans l'url,
    mainUsersHide.style.display = "none";
  }
}
hideToModifyUsers();//Execution de la function au dessus

//Envoyer un commentaire depuis la page index
document.getElementById('formIndex').addEventListener('submit',function(e){ // Récup ID du formulaire // quand submit

  e.preventDefault(); // Evite le rechargement de la page
  var avisClient = document.getElementById('avis').value; // On récupère l'id du formulaire avis client
  var noteClient = document.getElementById('note').value; //On recupere la valeur de la note
  var xhr = new XMLHttpRequest(); // Instancier obj XHR

  xhr.onload = function(){
    afficherCommentaire();  // Une fois le commentaire envoyé, on va l'afficher  avec la F afficherCom
    console.log(this.responseText);
  }

  xhr.open('POST', 'action.php', true); // Requête ajax
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send('newCom='+avisClient+'&note='+noteClient); // CF l6 action.php ---- VOICI UN EXMPLE DE CONCATENATION DENVOIE D'INFORMATIONS EN AJAX
  document.forms['formIndex'].reset(); //Vide les inputs du formulaire en question
})
//Envoyer un commentaire depuis la page index
afficherCommentaire();

//Voir les commentaires de la page index
function afficherCommentaire() {

  var xhr2 = new XMLHttpRequest();

  xhr2.onload = function (){ // Au chargement on execute cette fonction

    var RepCom = document.getElementById('response'); // La var récup l'id de la variable vide sur index
    var retour = JSON.parse(this.responseText); // Retour = le résultat du texte au format JSON contenu dans voirCom
    var block = ''; // Instancier var vide

    for(var y in retour){ // Equiv foreach Php
      block += '<div class="avisClient">';
      block += '<p>' + retour[y].avis + '</p>'; // On récupère l'avis en bdd
      block += '<p>' + retour[y].note + ' <i class="las la-star"></i></p>'; // On récupère l'avis en bdd
      block += '<p class="right-align"> Posté par : <b>' + retour[y].prenom + '</b><p>'; // On récupère le prénom en bdd
      block += '</div>';
    }
    RepCom.innerHTML = block; // Dans la div response on envoi les éléments de la boucle for
  }

  xhr2.open('GET','action.php',true); // Requête AJAX
  xhr2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr2.send('voirCom'); // voirCom est un élément HTML qu'on  créé, CF action.php

}//Voir les commentaires de la page index

