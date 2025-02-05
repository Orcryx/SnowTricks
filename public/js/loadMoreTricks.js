
//     let currentPage = 1; // Suivi de la page actuelle

//     window.loadPage = function (page) {
//         if (page === currentPage) return;
        
//         const url = new URL(window.location.href);
//         url.searchParams.set('page', page);

//         fetch(url, {
//             method: 'GET',
//             headers: {
//                 'X-Requested-With': 'XMLHttpRequest'
//             }
//         }).then(response => response.json()).then(data => {
//             const trickContainer = document.getElementById('trick-container');
            
//             if (page > currentPage) {
//                 // Ajoute les nouveaux tricks à la fin
//                 trickContainer.insertAdjacentHTML('beforeend', data.html);
//             } else if (page < currentPage && page >= 1) {
//                 // Supprime tout sauf la première page
//                 trickContainer.innerHTML = data.html;
//             }
            
//             // Mise à jour de la pagination
//             const pagination = document.querySelector('.pagination');
//             if (pagination) {
//                 pagination.innerHTML = data.pagination;
//             }

//             currentPage = page; // Mettre à jour la page actuelle
//         }).catch(error => {
//             console.error('Erreur lors du chargement des tricks:', error);
//         });
//     }
// });
document.addEventListener('DOMContentLoaded', function () {
    let currentPage = 1; // Suivi de la page actuelle

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

            currentPage = page; // Mettre à jour la page actuelle
        }).catch(error => {
            console.error('Erreur lors du chargement des tricks:', error);
        });
    }
});

