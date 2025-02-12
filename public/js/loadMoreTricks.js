document.addEventListener('DOMContentLoaded', function () {
    let currentPage = 1;
    const zoneArrow = document.getElementById('arrowUp');
    zoneArrow.style.display = "none" ;
    zoneArrow.addEventListener('click', function (event) {
        event.preventDefault(); // Empêche le rechargement ou retour en arrière
        window.scrollTo({ top: 0, behavior: 'smooth' }); // Remonte en douceur
    });
    

    window.loadPage = function (page) {
        if (page === currentPage) return;
        
        const url = new URL(window.location.href);
        url.searchParams.set('page', page);

        fetch(url, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        }).then(response => response.json()).then(data => {
            const trickContainer = document.getElementById('trick-container');
            
            if (page > currentPage) {
                // Création d'un nouvel élément pour la nouvelle page
                const newPage = document.createElement('div');
                newPage.classList.add('tricks-page');
                newPage.dataset.page = page;
                newPage.innerHTML = data.html;
                trickContainer.appendChild(newPage);
            } else if (page < currentPage && page >= 1) {
                // Supprime uniquement la dernière page ajoutée si elle existe
                const pages = trickContainer.querySelectorAll('.tricks-page');
                if (pages.length > 1) {
                    pages[pages.length - 1].remove();
                }
            }
            
            // Mise à jour de la pagination
            const pagination = document.querySelector('.pagination');
            if (pagination) {
                pagination.innerHTML = data.pagination;
            }

            currentPage = page; e
            if (currentPage >= 3)
            {
                zoneArrow.style.display = "block" ;
            }
            else
            {
                zoneArrow.style.display = "none" ;
            }
            
        }).catch(error => {
            console.error('Erreur lors du chargement des tricks:', error);
        });

    }
});

function loadPage(page) {
    if (page === currentPage) return;

    const url = new URL(window.location.href);
    url.searchParams.set('page', page);

    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(response => response.json()).then(data => {
        const trickContainer = document.getElementById('trick-container');

        if (page > currentPage) {
            const newPage = document.createElement('div');
            newPage.classList.add('tricks-page');
            newPage.dataset.page = page;
            newPage.innerHTML = data.html;
            trickContainer.appendChild(newPage);
        } else if (page < currentPage && page >= 1) {
            const pages = trickContainer.querySelectorAll('.tricks-page');
            if (pages.length > 1) {
                pages[pages.length - 1].remove();
            }
        }

        const pagination = document.querySelector('.pagination');
        if (pagination) {
            pagination.innerHTML = data.pagination;
        }

        currentPage = page;
        zoneArrow.style.display = currentPage >= 3 ? "block" : "none";
        
    }).catch(error => {
        console.error('Erreur lors du chargement des tricks:', error);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    let currentPage = 1;
    const zoneArrow = document.getElementById('arrowUp');
    zoneArrow.style.display = "none";
    zoneArrow.addEventListener('click', function (event) {
        event.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});

window.addEventListener("popstate", function () {
    location.reload(); // Recharge uniquement si nécessaire
});
