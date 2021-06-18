M.AutoInit();

function showHideAddProduct() {
  var divAddProducts = document.getElementById("formAddProduct");
  var tableViewProducts = document.getElementById("tableProduct");
  if (divAddProducts.style.display === "block") {
    divAddProducts.style.display = "none";
    tableViewProducts.style.display = "block";
  } else {
    divAddProducts.style.display = "block";
    tableViewProducts.style.display = "none";
  }
}
