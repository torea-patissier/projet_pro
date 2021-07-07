import {enableBodyScroll, disableBodyScroll} from "../js/body-scroll-lock.js"
//on importe depuis le fichier la fonction pour ne plus scroller le body
/**
 * @property {HTMLElement} element
 * @property {string[]} images chemins des images de la lightbox
 * @property {string[]} url Images actuelles affichées

 */
class Lightbox {

    static init () { //Methode statique qui initie la lightbox
        const links = Array.from(document.querySelectorAll('a[href$=".png"], a[href$=".jpg"], a[href$=".jpeg"]')) //On selectionne tous les liens qui mennent vers des fichiers avec  l'extension est celles contenues dans le tableau
        const gallery = links.map(link => link.getAttribute('href'))//pour chaque lien je vais faire un map et recuperer directement l'attribut href
        links.forEach(link => link.addEventListener('click', e => { //foreach - pour chaque lien, on ajoute un event listener click - lorsque l'on clique, on initie une fonction qui prend en parametre l'evenement
                e.preventDefault() //stop le comportement par defaut
                new Lightbox(e.currentTarget.getAttribute('href'), gallery //initie une nouvelle lightbox - on recupere l'evenement, on selectionne le lien sur lequel on vient de cliquer et on recupere l'url du lien
                )
            }))
    }

   /**
    * @param {string} url URL de l'image
    * @param {string[]} images chemins des images de la lightbox
    */
   constructor (url, images) { // contructeur qui prend en parametre l'url et images(tableau contenant toutes les mimages)
       this.element = this.buildDOM(url) //on construit notre dom a partir de l'url . this.element permettra d'acceder a l'element partout dans le code
       this.images = images //on definit dans la propriete images le parametre que l'on vient de recevoir
       this.loadImage(url) //on charge l'image sur laquelle on a cliqué
       this.onKeyUp = this.onKeyUp.bind(this)
       document.body.appendChild(this.element) // on ajoute l'element - la lightbox
       disableBodyScroll(this.element) //Quand on charge la lightbox, on désactive le scroll de la page (body)
       document.addEventListener('keyup', this.onKeyUp) //Des qu'on charge le systeme, on rajoute le keyUp
   }

    /**
     * @param {string} url URL de l'image
     */
   loadImage (url){ //methode qui charge le loader, une fois l'image chargée le loader disparait et affiche l'image
        this.url = null //Lorsque qu'on fait un loadImage, l'url sera null
        const image = new Image(); //On crée une nouvelle image
        const container = this.element.querySelector('.lightbox__container') //On selection l'element qui a comme class .lightbox__container
        const loader = document.createElement('div') //On crée un element qui sera une div
        loader.classList.add('lightbox__loader') //on ajoute au loader la classe lightbox__loader
        container.innerHTML = '' //On vide la precedente image dans l'url
        container.appendChild(loader) //on y ajoute a container le loader
        image.onload = () => { //lorsque l'image est bien chargée
            container.removeChild(loader) //On supprime l'enfant loader // cache le loader
            container.appendChild(image) //On ajouter l'enfant image // on affiche l'image
            this.url = url //Quand l'image sera chargée, l'url prend la valeur de l'url d'image
        }
        image.src = url
   }
    /**
     * Ferme la lightbox
     * @param {KeyboardEvent} e
     */
   onKeyUp (e) { //Methode qui prend en parametre un evenement de type keyboard event
        if (e.key === 'Escape') { //si la clé qui est pressée c'est escape/echape
            this.close(e) //on ferme l'evenement (lightbox)
        } else if (e.key === 'ArrowLeft') { //si on appuie sur la fleche de gauche
            this.prev(e) //On passe a l'image precedente
        } else if (e.key === 'ArrowRight') { //si on appuie sur la fleche de droite
            this.next(e) //On passe a la prochaine image
        }
    }

    /**
     * Ferme la lightbox
     * @param {MouseEvent|KeyboardEvent} e
     */
   close (e) { //fonction qui ferme la lightbox
    e.preventDefault() //on annule le comportement par defaut du bouton
        this.element.classList.add('fadeOut') //On prend l'element (lightbox) et on ajoute la classe fadeOut
        enableBodyScroll(this.element) //quand on ferme la lightbox, on reactive le scroll de la page (body)
        window.setTimeout(() => { //au bout de 500 milisecondes on supprime la lightbox
            this.element.parentElement.removeChild(this.element)  //
        }, 500) //
        document.removeEventListener('keyup', this.onKeyUp) //on supprime l'evement pour qu'il ne reste pas en memoire - nettoie le listener pour qu'il ne soit pas déclenché plusieurs fois
   }

    /**
     * prochaine image de la lightbox
     * @param {MouseEvent|KeyboardEvent} e
     */

    next (e) { //methode pour passer a la prochaine image
        e.preventDefault() //on empeche le comportement inital du bouton
        let i = this.images.findIndex(image => image === this.url) //je trouve l'index
        if (i === this.images.length -1){ //Si l'index est égal au nombre d'images qu'on a -1 ça veut dire que l'on est au bout, on defini i = -1 pour revenir au debut
            i = -1
        }
        this.loadImage(this.images[i + 1]) //on charge l'image qui sera a l'index +1 (prochaine)
   }

    /**
     * precedente image de la lightbox
     * @param {MouseEvent|KeyboardEvent} e
     */

    prev (e) { //methode pour revenir a l'image precedente
        e.preventDefault() //on empeche le comportement inital du bouton
        let i = this.images.findIndex(image => image === this.url) //je trouve l'index
        if (i === 0){
            i = this.images.length
        }
        this.loadImage(this.images[i - 1]) //on charge l'image qui sera a l'index -1 (precedente)
    }
    /**
     * @param {string} url URL de l'image
     * @return {HTMLElement}
     */
   buildDOM(url){ //Methode qui retourne un url
       const dom = document.createElement('div') //on crée un nouvel element qui sera une liste
        dom.classList.add('lightbox') //on ajoute la classe lightbox
        dom.innerHTML = `<button class="lightbox__close">Fermer</button> 
            <button class="lightbox__next">Suivant</button>
            <button class="lightbox__prev">Précédent</button>
            <div class="lightbox__container"></div>`
        dom.querySelector('.lightbox__close').addEventListener('click', //on selectionne l'element et lorsque l'on clique dessus on execute une fonction
            this.close.bind(this))
        dom.querySelector('.lightbox__next').addEventListener('click',  //on selectionne l'element et lorsque l'on clique dessus on execute une fonction
            this.next.bind(this))
        dom.querySelector('.lightbox__prev').addEventListener('click',  //on selectionne l'element et lorsque l'on clique dessus on execute une fonction
            this.prev.bind(this))
        return dom
   }
}
/**
 <div class="lightbox">
 <button class="lightbox__close">Fermer</button>
 <button class="lightbox__next">Suivant</button>
 <button class="lightbox__prev">Précédent</button>
 <div class="lightbox__container">
 <img src="https://picsum.photos/900/1800" alt="">
 </div>
 </div> **/
Lightbox.init(); //Des le chargement de la plage d'initier la livebox