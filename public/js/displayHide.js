// document.addEventListener("DOMContentLoaded", () => {
//     document.querySelectorAll('.add_item_link').forEach(btn => {
//         btn.addEventListener("click", addFormToCollection);
//     });

//     // Ajouter les événements aux éléments déjà présents dans le formulaire
//     document.querySelectorAll('div.picture-data').forEach((picture) => {
//         addTagFormDeleteLink(picture);
//         picture.addEventListener("click", () => highlightMedia(picture, "img"));
//     });

//     document.querySelectorAll('ul.video li').forEach((video) => {
//         addTagFormDeleteLink(video);
//         video.addEventListener("click", () => highlightMedia(video, "video, iframe"));
//     });

//     // Appeler la fonction hideDisplay une fois le DOM chargé
//     // hideDisplay();
// });


// function addFormToCollection(e) {
//     const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    
//     const item = document.createElement('div');
//     item.classList.add("picture-data");
    
//     item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
    
//     collectionHolder.appendChild(item);
    
//     collectionHolder.dataset.index++;
    
//     addTagFormDeleteLink(item);

//     const type = collectionHolder.classList.contains('picture') ? "img" : "video, iframe";
//     item.addEventListener("click", () => highlightMedia(item, type));
// }

// function addTagFormDeleteLink(item) {
//     const removeFormButton = document.createElement('button');
//     removeFormButton.innerText = 'Supprimer';
//     removeFormButton.classList.add('btn', 'btn-danger', 'remove-item');
    
//     item.append(removeFormButton);
    
//     removeFormButton.addEventListener('click', (e) => {
//         e.preventDefault();
//         item.remove();
//     });
// }

// function highlightMedia(item, selector) {
//     const inputField = item.querySelector('input[type="text"]');
//     if (!inputField) return;

//     let mediaSrc = inputField.value.trim();
//     if (!mediaSrc) return;

//     // Normalisation de l'URL pour YouTube
//     mediaSrc = mediaSrc.replace("youtu.be/", "www.youtube.com/embed/")
//                        .replace("watch?v=", "embed/");

//     // Supprimer les anciens surlignages
//     document.querySelectorAll('#carrousel .card').forEach(card => {
//         card.classList.remove('highlight');
//     });

//     // Trouver l’élément correspondant dans le carrousel
//     const mediaElement = [...document.querySelectorAll(`#carrousel .card ${selector}`)].find(el => {
//         if (el.tagName === "IFRAME") {
//             return el.src.includes(mediaSrc);
//         }
//         if (el.tagName === "VIDEO") {
//             return [...el.getElementsByTagName('source')].some(source => source.src.includes(mediaSrc));
//         }
//         return el.src.includes(mediaSrc);
//     });

//     if (mediaElement) {
//         mediaElement.closest('.card').classList.add('highlight');
//         mediaElement.scrollIntoView({ behavior: "smooth", block: "center" });
//     }
// }

// function hideDisplay() {
//     const heroInputContainer = document.querySelector("#editTrick-input");
//     const editHeroPictureBtn = document.querySelector("#editBtn-hero");
//     const buttonContainer = editHeroPictureBtn ? editHeroPictureBtn.parentElement : null; // Conteneur des boutons
//     const heroImage = document.querySelector(".hero-picture img"); // Sélection de l'image

//     if (heroInputContainer) {
//         // Masquer le champ au chargement de la page
//         heroInputContainer.style.display = "none";
//     }

//     if (editHeroPictureBtn && buttonContainer) {
//         editHeroPictureBtn.addEventListener("click", function (e) {
//             e.preventDefault();

//             // Basculer l'affichage du champ
//             if (heroInputContainer.style.display === "none") {
//                 heroInputContainer.style.display = "block";

//                 // Ajouter dynamiquement le bouton Supprimer s'il n'existe pas
//                 if (!document.querySelector("#deleteHeroPictureBtn")) {
//                     const deleteBtn = document.createElement("button");
//                     deleteBtn.id = "deleteHeroPictureBtn";
//                     deleteBtn.innerHTML = '<i class="fa fa-trash"></i>'; // Icône poubelle
//                     deleteBtn.classList.add("delete-btn"); // Ajoute la classe

//                     // Ajouter l'événement pour effacer le contenu du champ et l'image
//                     deleteBtn.addEventListener("click", function (e) {
//                         e.preventDefault();
                        
//                         // Effacer le contenu de l'input file
//                         const fileInput = heroInputContainer.querySelector("input");
//                         if (fileInput) {
//                             fileInput.value = ""; // Réinitialiser l'input
//                         }

//                         // Effacer l'image en vidant le src
//                         if (heroImage) {
//                             heroImage.src = "";
//                             heroImage.alt = "Aucune image disponible"; // Facultatif
//                         }
//                     });

//                     // Ajouter le bouton à droite du bouton éditer
//                     buttonContainer.appendChild(deleteBtn);
//                 }
//             } else {
//                 heroInputContainer.style.display = "none";
//                 const deleteBtn = document.querySelector("#deleteHeroPictureBtn");
//                 if (deleteBtn) deleteBtn.remove(); // Supprime le bouton supprimer si on ferme
//             }
//         });
//     }
// }


// document.addEventListener("DOMContentLoaded", () => {
//     document.body.addEventListener("click", (event) => {
//         if (event.target.matches(".add_item_link")) {
//             addFormToCollection(event);
//         }
//         if (event.target.matches(".remove-item")) {
//             event.preventDefault();
//             event.target.closest(".picture-data, li").remove();
//         }
//     });

//     observeDOMChanges();
// });

// function addFormToCollection(e) {
//     const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
//     const item = document.createElement('div');
//     item.classList.add("picture-data");
//     item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
//     collectionHolder.appendChild(item);
//     collectionHolder.dataset.index++;
// }

// function highlightMedia(item, selector) {
//     const inputField = item.querySelector('input[type="text"]');
//     if (!inputField) return;

//     let mediaSrc = inputField.value.trim();
//     if (!mediaSrc) return;

//     mediaSrc = mediaSrc.replace("youtu.be/", "www.youtube.com/embed/")
//                        .replace("watch?v=", "embed/");

//     document.querySelectorAll('#carrousel .card').forEach(card => {
//         card.classList.remove('highlight');
//     });

//     const mediaElement = [...document.querySelectorAll(`#carrousel .card ${selector}`)].find(el => {
//         if (el.tagName === "IFRAME") {
//             return el.src.includes(mediaSrc);
//         }
//         if (el.tagName === "VIDEO") {
//             return [...el.getElementsByTagName('source')].some(source => source.src.includes(mediaSrc));
//         }
//         return el.src.includes(mediaSrc);
//     });

//     if (mediaElement) {
//         mediaElement.closest('.card').classList.add('highlight');
//         mediaElement.scrollIntoView({ behavior: "smooth", block: "center" });
//     }
// }

// function observeDOMChanges() {
//     const observer = new MutationObserver(() => {
//         document.querySelectorAll('div.picture-data').forEach((picture) => {
//             picture.addEventListener("click", () => highlightMedia(picture, "img"));
//         });
//         document.querySelectorAll('ul.video li').forEach((video) => {
//             video.addEventListener("click", () => highlightMedia(video, "video, iframe"));
//         });
//     });
//     observer.observe(document.body, { childList: true, subtree: true });
// }

// function hideDisplay() {
//     const heroInputContainer = document.querySelector("#editTrick-input");
//     const editHeroPictureBtn = document.querySelector("#editBtn-hero");
//     const buttonContainer = editHeroPictureBtn ? editHeroPictureBtn.parentElement : null;
//     const heroImage = document.querySelector(".hero-picture img");

//     if (heroInputContainer) {
//         heroInputContainer.style.display = "none";
//     }

//     if (editHeroPictureBtn && buttonContainer) {
//         editHeroPictureBtn.addEventListener("click", function (e) {
//             e.preventDefault();

//             if (heroInputContainer.style.display === "none") {
//                 heroInputContainer.style.display = "block";

//                 if (!document.querySelector("#deleteHeroPictureBtn")) {
//                     const deleteBtn = document.createElement("button");
//                     deleteBtn.id = "deleteHeroPictureBtn";
//                     deleteBtn.innerHTML = '<i class="fa fa-trash"></i>';
//                     deleteBtn.classList.add("delete-btn");

//                     deleteBtn.addEventListener("click", function (e) {
//                         e.preventDefault();
//                         const fileInput = heroInputContainer.querySelector("input");
//                         if (fileInput) {
//                             fileInput.value = "";
//                         }
//                         if (heroImage) {
//                             heroImage.src = "";
//                             heroImage.alt = "Aucune image disponible";
//                         }
//                     });
//                     buttonContainer.appendChild(deleteBtn);
//                 }
//             } else {
//                 heroInputContainer.style.display = "none";
//                 const deleteBtn = document.querySelector("#deleteHeroPictureBtn");
//                 if (deleteBtn) deleteBtn.remove();
//             }
//         });
//     }
// }

// hideDisplay();

