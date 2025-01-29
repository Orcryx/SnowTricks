document.addEventListener('DOMContentLoaded', function () {
    let currentPage = 1; // Suivi de la page actuelle

    window.loadPage = function (page) {
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
                // AJOUTE les nouveaux tricks à la fin (voir plus)
                trickContainer.insertAdjacentHTML('beforeend', data.html);
            } else if (page < currentPage) {
                // SUPPRIME les derniers tricks chargés (réduire)
                const allTricks = trickContainer.querySelectorAll('.trick');
                const numToRemove = allTricks.length - data.html.split('<div class="trick"').length;

                for (let i = 0; i < numToRemove; i++) {
                    if (allTricks[allTricks.length - 1]) {
                        allTricks[allTricks.length - 1].remove();
                    }
                }
            }

            // Mise à jour de la pagination
            const pagination = document.querySelector('.pagination');
            if (pagination) {
                pagination.innerHTML = data.pagination;
            }

            currentPage = page; // Mettre à jour la page actuelle
        }).catch(error => {
            console.error('Erreur lors du chargement des tricks:', error);
        });
    }
});