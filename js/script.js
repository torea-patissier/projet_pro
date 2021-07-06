M.AutoInit();

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

$(document).ready(function () {
  function showdata() {//  Fonction pour afficher les commentaires sur INDEX.HTML de façon Asynchrone

    $.ajax({
      url: "action.php", // Récupère les résultats de echo $pageAction->voirAvisClients();
      success : function (result) { // result == résultat PHP
        data = JSON.parse(result); // data == result sous format JSON
        //console.log(data); // On peut console result pour voir le format de result dans la console
        //console.log(result); // On peut console data pour voir le format de data dans la console

        data.forEach((result) => {
          // Boucle for each en Jquery
          $("#afficherCommentaire").append(
              `<p>${result.avis} <br/> ${result.prenom} ${result.nom}</p>`
          );
        });
      },
    });
  }
  showdata();
});