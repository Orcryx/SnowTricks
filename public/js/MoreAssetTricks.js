
// document.querySelectorAll('.add_item_link').forEach(btn => {
//     btn.addEventListener("click", addFormToCollection)
//     });
    
//     document.querySelectorAll('ul.picture div.picture-data').forEach((picture) => {
//     addTagFormDeleteLink(picture)
//     })

//     function addFormToCollection(e) {
//         const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
        
//         const item = document.createElement('li');
        
//         item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
        
//         collectionHolder.appendChild(item);
        
//         collectionHolder.dataset.index ++;
        
//         // add a delete link to the new form
//         addTagFormDeleteLink(item);
//     };
    
//     function addTagFormDeleteLink(item) {
//         const removeFormButton = document.createElement('button');
//         removeFormButton.innerText = 'Supprimer';
    
//         item.append(removeFormButton);
    
//         removeFormButton.addEventListener('click', (e) => {
//             e.preventDefault();
//             // remove the li for the tag form
//             item.remove();
//         });
//     };


//OPTION 2

// document.querySelectorAll('.add_item_link').forEach(btn => {
//     btn.addEventListener("click", addFormToCollection);
// });

// document.querySelectorAll('.picture .picture-data, .video .picture-data').forEach((item) => {
//     addTagFormDeleteLink(item);
// });

// function addFormToCollection(e) {
//     const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    
//     const item = document.createElement('div');
//     item.classList.add('picture-data');
    
//     item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
    
//     collectionHolder.appendChild(item);
    
//     collectionHolder.dataset.index++;
    
//     // Ajouter un bouton de suppression au nouvel élément
//     addTagFormDeleteLink(item);
// }

// function addTagFormDeleteLink(item) {
//     const removeFormButton = document.createElement('button');
//     removeFormButton.innerText = 'Supprimer';
//     removeFormButton.classList.add('btn', 'delete-btn');
    
//     item.appendChild(removeFormButton);
    
//     removeFormButton.addEventListener('click', (e) => {
//         e.preventDefault();
//         item.remove();
//     });
// }

//OPTION 3


// document.querySelectorAll('.add_item_link').forEach(btn => {
//     btn.addEventListener("click", addFormToCollection);
// });

// document.querySelectorAll('.picture .picture-data, .video .picture-data').forEach((item) => {
//     addTagFormDeleteLink(item);
// });

// function addFormToCollection(e) {
//     const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    
//     const item = document.createElement('div');
//     item.classList.add('picture-data');
    
//     item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
    
//     collectionHolder.appendChild(item);
    
//     collectionHolder.dataset.index++;
    
//     // Ajouter un bouton de suppression au nouvel élément
//     addTagFormDeleteLink(item);
// }

// document.querySelectorAll('.picture .picture-data, .video .picture-data').forEach((item) => {
//     addTagFormDeleteLink(item);
// });

// function addTagFormDeleteLink(item) {
//     const removeFormButton = document.createElement('button');
//     removeFormButton.innerText = 'Supprimer';
//     removeFormButton.classList.add('btn', 'delete-btn');
    
//     item.appendChild(removeFormButton);
    
//     removeFormButton.addEventListener('click', (e) => {
//         e.preventDefault();
//         item.remove();
//     });
// }


//OPTION 4

// document.querySelectorAll('.add_item_link').forEach(btn => {
//     btn.addEventListener("click", addFormToCollection);
// });

// // S'assurer que chaque élément existant n'a qu'un seul bouton de suppression
// const processedItems = new Set();

// document.querySelectorAll('.picture .picture-data, .video .picture-data').forEach((item) => {
//     if (!processedItems.has(item)) {
//         addTagFormDeleteLink(item);
//         processedItems.add(item);
//     }
// });

// function addFormToCollection(e) {
//     const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    
//     const item = document.createElement('div');
//     item.classList.add('picture-data');
    
//     item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
    
//     collectionHolder.appendChild(item);
    
//     collectionHolder.dataset.index++;
    
//     // Ajouter un bouton de suppression au nouvel élément
//     addTagFormDeleteLink(item);
// }

// function addTagFormDeleteLink(item) {
//     // Vérifier si un bouton existe déjà pour éviter les doublons
//     if (item.querySelector('.delete-btn')) return;
    
//     const removeFormButton = document.createElement('button');
//     removeFormButton.innerText = 'Supprimer';
//     removeFormButton.classList.add('btn', 'delete-btn-edit');
    
//     item.appendChild(removeFormButton);
    
//     removeFormButton.addEventListener('click', (e) => {
//         e.preventDefault();
//         item.remove();
//     });
// }
