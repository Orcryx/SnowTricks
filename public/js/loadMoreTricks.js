function initTricksPagination() {
    let currentPage = 1;
    const zoneArrow = document.getElementById('arrowUp');
    zoneArrow.style.display = "none"; 

    if (!zoneArrow) return;

    zoneArrow.style.display = "none";
    zoneArrow.addEventListener('click', function (event) {
        event.preventDefault();
        window.scrollTo({ top: 0, behavior: 'smooth' });
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
            if (!trickContainer) return;

            if (page > currentPage) {
                const newPage = document.createElement('div');
                newPage.classList.add('tricks-page');
                newPage.dataset.page = page;
                newPage.innerHTML = data.html;
                trickContainer.appendChild(newPage);
            } else if (page < currentPage && page >= 1) {
                const lastPage = trickContainer.querySelector('[data-page="' + currentPage + '"]');
                if (lastPage) {
                    lastPage.remove();
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
    };
}

// Exécuter au chargement de la page
document.addEventListener('DOMContentLoaded', initTricksPagination);

// Gestion du retour en arrière
window.addEventListener("pageshow", function (event) {
    if (event.persisted) {
        initTricksPagination();
    }
});

//Gestion des changements de page via liens
document.addEventListener("click", function (event) {
    const link = event.target.closest("a");
    if (link && link.href && !link.target) {
        setTimeout(initTricksPagination, 100);
    }
});



