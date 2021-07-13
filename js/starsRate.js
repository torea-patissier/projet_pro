window.onload = () => { //Quand la fenetre est chargée
    //on va chercher toutes les étoiles
    const stars = document.querySelectorAll(".la-star");

    //on va chercher l'input note
    const note = document.querySelector("#note");

    //on boucle sur les étoiles pour leur ajouter des écouteur d'événements
    for(star of stars){
        //On écoute le survol
        star.addEventListener("mouseover", function(){
            resetStars();
            this.style.color = "red";
            this.classList.add("las");
            this.classList.remove("lar");
            //previousStar = L'élément précédent dans le DOM (de même niveau, balise soeur)
            let previousStar = this.previousElementSibling;
            //tant qu'il y a une étoile précédente je la passe en rouge
            while(previousStar){
                //On passe l'étoile qui précéde en rouge
                previousStar.style.color = "red";
                previousStar.classList.add("las");
                previousStar.classList.remove("lar");
                //On récupére l'étoile qui la précéde
                previousStar = previousStar.previousElementSibling;
            }
        });

        //événement sur le clic
        star.addEventListener("click", function (){
           note.value = this.dataset.value;
        });

        star.addEventListener("mouseout", function(){
            resetStars(note.value);
        });
    }

    //Fonction pour repasser les étoiles en noir
    function resetStars(note = 0){
        for(star of stars){
            if(star.dataset.value > note){
                star.style.color = "black";
                star.classList.add("lar");
                star.classList.remove("las");
            }else{
                star.style.color = "red";
                star.classList.add("las");
                star.classList.remove("lar");
            }
        }
    }
}