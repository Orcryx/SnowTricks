setTimeout(() => {
    let pictureCollection = document.getElementById("picture-collection");
    let addPictureButton = document.getElementById("add-picture");
    let pictureIndex = pictureCollection ? pictureCollection.children.length : 0;
    let videoCollection = document.getElementById("video-collection");
    let addVideoButton = document.getElementById("add-video");
    let videoIndex = videoCollection ? videoCollection.children.length : 0;

    let heroImage = document.querySelector(".hero-picture img");
    let heroTitle = document.querySelector(".hero-text h1");
    let imageInput = document.getElementById("trick_image");
    let titleInput = document.getElementById("trick_name");

    if (imageInput && heroImage) {
        imageInput.addEventListener("input", function () {
            heroImage.src = imageInput.value || "https://img.freepik.com/vecteurs-libre/illustration-icone-galerie_53876-27002.jpg?t=st=1740487305~exp=1740490905~hmac=83aff2dde6b95f4397a299c3ad47f43307c472699f7e33fddd89784565044a42&w=740";
        });
    }

    if (titleInput && heroTitle) {
        titleInput.addEventListener("input", function () {
            heroTitle.textContent = titleInput.value || "Titre par défaut";
        });
    }

    function addCollectionItem(collection, index, type) {
        let prototype = collection.dataset.prototype;
        let newItemHtml = prototype.replace(/__name__/g, index);
        let div = document.createElement("div");
        div.classList.add(type + "-item", "d-flex", "align-items-start", "mb-3", "carte-collection");

        let formContainer = document.createElement("div");
        formContainer.classList.add("flex-column", "zone-media-form");
        formContainer.innerHTML = newItemHtml;

        if (type === "picture") {
            let imagePlaceholder = document.createElement("img");
            imagePlaceholder.src = "https://via.placeholder.com/150";
            imagePlaceholder.alt = "Image du Trick";
            imagePlaceholder.classList.add("img-thumbnail", "mb-2");
            imagePlaceholder.style.width = "210px";
            imagePlaceholder.style.height = "210px";

            let imageInput = formContainer.querySelector("input[id^='trick_picture'][id$='_src']");
            imageInput.addEventListener("input", function () {
                imagePlaceholder.src = imageInput.value || "https://via.placeholder.com/150";
            });

            div.appendChild(imagePlaceholder);
        } else if (type === "video") {
            let videoPlaceholder = document.createElement("iframe");
            videoPlaceholder.src = "https://www.youtube.com/embed/";
            videoPlaceholder.setAttribute("frameborder", "0");
            videoPlaceholder.setAttribute("allowfullscreen", "true");
            videoPlaceholder.classList.add("mb-2");
            videoPlaceholder.style.width = "210px";
            videoPlaceholder.style.height = "210px";

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

        let removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.classList.add("btn", "btn-danger", "remove-" + type);
        removeButton.textContent = "Supprimer";

        formContainer.appendChild(removeButton);
        div.appendChild(formContainer);
        collection.appendChild(div);
    }

    if (addPictureButton && !addPictureButton.dataset.listener) {
        addPictureButton.dataset.listener = "true";
        addPictureButton.addEventListener("click", function () {
            addCollectionItem(pictureCollection, pictureIndex++, "picture");
        });
    }

    if (addVideoButton && !addVideoButton.dataset.listener) {
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

