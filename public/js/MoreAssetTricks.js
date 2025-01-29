
document.querySelectorAll('.add_item_link').forEach(btn => {
    btn.addEventListener("click", addFormToCollection)
    });
    
    document.querySelectorAll('ul.picture div.picture-data').forEach((picture) => {
    addTagFormDeleteLink(picture)
    })
    function addFormToCollection(e) {
    const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);
    
    const item = document.createElement('li');
    
    item.innerHTML = collectionHolder.dataset.prototype.replace(/__name__/g, collectionHolder.dataset.index);
    
    collectionHolder.appendChild(item);
    
    collectionHolder.dataset.index ++;
    
    // add a delete link to the new form
    addTagFormDeleteLink(item);
    };
    
    function addTagFormDeleteLink(item) {
    const removeFormButton = document.createElement('button');
    removeFormButton.innerText = 'Supprimer';
    
    item.append(removeFormButton);
    
    removeFormButton.addEventListener('click', (e) => {
    e.preventDefault();
    // remove the li for the tag form
    item.remove();
    });
    };