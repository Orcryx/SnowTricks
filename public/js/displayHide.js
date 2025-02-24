// setTimeout(() => {
//     let pictureCollection = document.getElementById("picture-collection");
//     let videoCollection = document.getElementById("video-collection");
//     let addPictureButton = document.getElementById("add-picture");
//     let addVideoButton = document.getElementById("add-video");
//     let pictureIndex = pictureCollection.children.length;
//     let videoIndex = videoCollection.children.length;

//     function addCollectionItem(collection, index, type) {
//         let prototype = collection.dataset.prototype;
//         let newItemHtml = prototype.replace(/__name__/g, index);
//         let div = document.createElement("div");
//         div.classList.add(type + "-item", "d-flex", "align-items-center", "mb-2", "carte-collection");
//         div.innerHTML = newItemHtml;

//         let removeButton = document.createElement("button");
//         removeButton.type = "button";
//         removeButton.classList.add("btn", "btn-danger", "ms-2", "remove-" + type);
//         removeButton.textContent = "Supprimer";

//         div.appendChild(removeButton);
//         collection.appendChild(div);
//     }

//     // 🔹 Empêcher l'ajout multiple des écouteurs d'événements
//     if (!addPictureButton.dataset.listener) {
//         addPictureButton.dataset.listener = "true"; // Marquer le bouton comme "écouté"
//         addPictureButton.addEventListener("click", function () {
//             addCollectionItem(pictureCollection, pictureIndex++, "picture");
//         });
//     }

//     if (!addVideoButton.dataset.listener) {
//         addVideoButton.dataset.listener = "true";
//         addVideoButton.addEventListener("click", function () {
//             addCollectionItem(videoCollection, videoIndex++, "video");
//         });
//     }

//     // 🔹 Délégation d’événement pour supprimer un élément (évite l'ajout multiple d'écouteurs)
//     document.body.addEventListener("click", function (event) {
//         if (event.target.classList.contains("remove-picture")) {
//             event.target.closest(".picture-item").remove();
//         }
//         if (event.target.classList.contains("remove-video")) {
//             event.target.closest(".video-item").remove();
//         }
//     });

// }, 500);

setTimeout(() => {
    let pictureCollection = document.getElementById("picture-collection");
    let addPictureButton = document.getElementById("add-picture");
    let pictureIndex = pictureCollection.children.length;
    let videoCollection = document.getElementById("video-collection");
    let addVideoButton = document.getElementById("add-video");
    let videoIndex = videoCollection.children.length;

    function addCollectionItem(collection, index, type) {
        let prototype = collection.dataset.prototype;
        let newItemHtml = prototype.replace(/__name__/g, index);
        let div = document.createElement("div");
        div.classList.add(type + "-item", "d-flex", "align-items-start", "mb-3", "carte-collection");

        // Création du conteneur de formulaire
        let formContainer = document.createElement("div");
        formContainer.classList.add("flex-column", "zone-media-form");
        formContainer.innerHTML = newItemHtml;

        if (type === "picture") {
            // Création de l'élément image par défaut
            let imagePlaceholder = document.createElement("img");
            imagePlaceholder.src = "https://via.placeholder.com/150";
            imagePlaceholder.alt = "Image du Trick";
            imagePlaceholder.classList.add("img-thumbnail", "mb-2");
            imagePlaceholder.style.maxWidth = "100%";

            let imageInput = formContainer.querySelector("input[id^='trick_picture'][id$='_src']");
            imageInput.addEventListener("input", function () {
                imagePlaceholder.src = imageInput.value || "https://via.placeholder.com/150";
            });

            div.appendChild(imagePlaceholder);
        } else if (type === "video") {
            // Création de l'élément iframe par défaut pour la vidéo
            let videoPlaceholder = document.createElement("iframe");
            videoPlaceholder.src = "https://www.youtube.com/embed/";
            videoPlaceholder.setAttribute("frameborder", "0");
            videoPlaceholder.setAttribute("allowfullscreen", "true");
            videoPlaceholder.classList.add("mb-2");
            videoPlaceholder.style.width = "100%";
            videoPlaceholder.style.height = "200px";

            let videoInput = formContainer.querySelector("input[id^='trick_video'][id$='_src']");
            videoInput.addEventListener("input", function () {
                let url = videoInput.value;
                if (url.includes("youtu.be/")) {
                    url = url.replace("youtu.be/", "www.youtube.com/embed/");
                } else if (url.includes("watch?v=")) {
                    url = url.replace("watch?v=", "embed/");
                }
                videoPlaceholder.src = url;
            });

            div.appendChild(videoPlaceholder);
        }

        // Bouton de suppression
        let removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.classList.add("btn", "btn-danger", "remove-" + type);
        removeButton.textContent = "Supprimer";

        formContainer.appendChild(removeButton);
        div.appendChild(formContainer);
        collection.appendChild(div);
    }

    if (!addPictureButton.dataset.listener) {
        addPictureButton.dataset.listener = "true";
        addPictureButton.addEventListener("click", function () {
            addCollectionItem(pictureCollection, pictureIndex++, "picture");
        });
    }

    if (!addVideoButton.dataset.listener) {
        addVideoButton.dataset.listener = "true";
        addVideoButton.addEventListener("click", function () {
            addCollectionItem(videoCollection, videoIndex++, "video");
        });
    }

    document.body.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-picture")) {
            event.target.closest(".picture-item").remove();
        }
        if (event.target.classList.contains("remove-video")) {
            event.target.closest(".video-item").remove();
        }
    });

}, 500);
