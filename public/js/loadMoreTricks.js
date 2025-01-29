document.addEventListener('DOMContentLoaded', function () {
window.loadPage = function (page) {
const url = new URL(window.location.href);
url.searchParams.set('page', page);

fetch(url, {
method: 'GET',
headers: {
'X-Requested-With': 'XMLHttpRequest'
}
}).then(response => response.json()).then(data => { // On met à jour la partie HTML contenant les tricks
const trickContainer = document.getElementById('trick-container');
trickContainer.innerHTML = data.html;

// Optionnel: Mettre à jour la pagination
const pagination = document.querySelector('.pagination');
if (pagination) {
pagination.innerHTML = data.pagination;
}
}).catch(error => {
console.error('Erreur lors du chargement des tricks:', error);
});
}
});