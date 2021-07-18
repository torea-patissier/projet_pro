M.AutoInit();

  // AJOUTER UN PRODUIT AU PANIER
  $(".addPanier").click(function(e){
    e.preventDefault();
    // Requête ajax 4 param (url du lien donc addpanier.php
    // object (dans notre cas ce sera {} donc la $ qui contient l'id du produit)
    // fonction à utiliser
    // Format, dans notre cas JSON)
    
    $.get($(this).attr('href'),{},function(data){

      if(data.error){ //C.F error dans addpanier.php
        alert(data.message);
      }else{
        // Ici error vaut false et retourne le message qui confirme l'ajout au panier 
        if(confirm(data.message + '. Voulez vous consulter votre panier?')){
          location.href = 'panier.php'; // Redirection si on clique sur 'ok'
        }
      }

    },"json");
    return false;
  });


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

function hideToModify() {
  let mainHide = document.getElementById("mainProduits"); //Je recupère l'id du main
  if (window.location.search.indexOf("show") > -1) {
    //Si l'index "show" est present dans l'url,
    mainHide.style.display = "none"; //on cache le main
  }
}
hideToModify(); //Execution de la function au dessus

function hideToModifyUsers() {
  let mainUsersHide = document.getElementById("mainUsers");
  if (window.location.search.indexOf("userModif") > -1) {
    //Si l'index "show" est present dans l'url,
    mainUsersHide.style.display = "none";
  }
}
hideToModifyUsers(); //Execution de la function au dessus

// ENVOYER UN COMMENTAIRE DEPUIS LA PAGE INDEX
document.getElementById("formIndex").addEventListener("submit", function (e) {
  // Récup ID du formulaire // quand submit

  e.preventDefault(); // Evite le rechargement de la page
  var avisClient = document.getElementById("avis").value; // On récupère l'id du formulaire avis client
  var xhr = new XMLHttpRequest(); // Instancier obj XHR

  xhr.onload = function () {
    afficherCommentaire(); // Une fois le commentaire envoyé, on va l'afficher  avec la F afficherCom
    avisClient.innerHTML = "";
  };

  xhr.open("POST", "action.php", true); // Requête ajax
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.send("newCom=" + avisClient); // CF l6 action.php
});
//Envoyer un commentaire depuis la page index

// AFFICHER LES COMMENTAIRES DE LA PAGE INDEX
function afficherCommentaire() {
  var xhr2 = new XMLHttpRequest();

  xhr2.onload = function () {
    // Au chargement on execute cette fonction

    var RepCom = document.getElementById("response"); // La var récup l'id de la variable vide sur index
    var retour = JSON.parse(this.responseText); // Retour = le résultat du texte au format JSON contenu dans voirCom
    console.log(retour);
    var block = ""; // Instancier var vide

    for (var y in retour) {
      // Equiv foreach Php
      block += '<div class="avisClient">';
      block += "<p>" + retour[y].avis + "</p>"; // On récupère l'avis en bdd
      block +=
        '<p class="right-align"> Posté par : ' + retour[y].prenom + "<p>"; // On récupère le prénom en bdd
      block += "</div>";
    }
    RepCom.innerHTML = block; // Dans la div response on envoi les éléments de la boucle for
  };

  xhr2.open("GET", "action.php", true); // Requête AJAX
  xhr2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr2.send("voirCom"); // voirCom est un élément HTML qu'on  créé, CF action.php
} //Voir les commentaires de la page index
