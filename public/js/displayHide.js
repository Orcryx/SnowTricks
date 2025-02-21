

setTimeout(() => {
    
        let pictureCollection = document.getElementById("picture-collection");
        let videoCollection = document.getElementById("video-collection");
        let addPictureButton = document.getElementById("add-picture");
        let addVideoButton = document.getElementById("add-video");
        let pictureIndex = pictureCollection.children.length;
        let videoIndex = videoCollection.children.length;
        
        function addCollectionItem(collection, index, type) {
        let prototype = collection.dataset.prototype;
        let newItemHtml = prototype.replace(/__name__/g, index);
        let div = document.createElement("div");
        div.classList.add(type + "-item", "d-flex", "align-items-center", "mb-2");
        div.innerHTML = newItemHtml;
        
        let removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.classList.add("btn", "btn-danger", "ms-2", "remove-" + type);
        removeButton.textContent = "Supprimer";
        
        div.appendChild(removeButton);
        collection.appendChild(div);
        }
        
        // Gestion de l'ajout des images et vidéos
        addPictureButton.addEventListener("click", function () {
        addCollectionItem(pictureCollection, pictureIndex++, "picture");
        });
        
        addVideoButton.addEventListener("click", function () {
        addCollectionItem(videoCollection, videoIndex++, "video");
        });
        
        // 🔹 Délégation d’événement pour gérer la suppression d’éléments dynamiques
        document.body.addEventListener("click", function (event) {
        if (event.target.classList.contains("remove-picture")) {
        event.target.closest(".picture-item").remove();
        }
        if (event.target.classList.contains("remove-video")) {
        event.target.closest(".video-item").remove();
        }
        });
   
        
}, 500);