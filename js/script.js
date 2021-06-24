//Initialise automatique toutes les classes de Materialize
M.AutoInit();



$(document).ready(function(){
    $("#modifier").click(function(){
        if("#password" == "#confpass"){
            alert('Votre mot de passe à bien été modifié');
        }else{
            alert("Les mots de passe ne sont pas identique");
        }
    })
})

