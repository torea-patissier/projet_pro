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