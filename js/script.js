M.AutoInit(); // Permet de charger toutes les animations JS de Materialize

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



//Backoffice
function showHideAddProduct() {
  var divAddProducts = document.getElementById("formAddProduct"); // ID du formulaire
  var tableViewProducts = document.getElementById("tableProduct"); // ID table
  if (divAddProducts.style.display === "block") {
    // Si formulaire afficher
    divAddProducts.style.display = "none"; // Form == display none
    tableViewProducts.style.display = "block"; // Table == display block
  } else {
    divAddProducts.style.display = "block"; // Formulaire == block
    tableViewProducts.style.display = "none"; // Table none
  }
}

//Backoffice
function modifyProductsHideForms() {
  const tableToHide = document.getElementById("tableProducts"); // ID table
  const modify = document.getElementById("modifyProduct"); // ID form modifier produit
  modify.addEventListener("click", () => {
    // Si click sur element modifier produit
    tableToHide.style.display = "none"; // Table DisNone
  });
}



// $(document).ready(function(){
//     $("#envoyerCommentaire").click(function(e){
//         e.preventDefault();
//          const commentaire = $("#avis").serialize(); // L'id du formulaire HTML devient la var commentaire donc #avis == var commentaire
//         if(commentaire != ""){
//             $.ajax({
//                 url: "action.php",
//                 type: "POST",
//                 data: commentaire,
//                 success: function (data){
//                     console.log(commentaire);
//                 }
//             })

//         }else{
//             $("#response").html(' Remplissez le champs');
//         }
//     })
// })
