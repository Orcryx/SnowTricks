document.addEventListener("DOMContentLoaded", function () {
    let comments = document.querySelectorAll(".comment-bloc");
    let loadMoreBtn = document.getElementById("load-more");
    let visibleComments = 5;
    
    loadMoreBtn ?. addEventListener("click", function () {
    let hiddenComments = Array.from(comments).slice(visibleComments, visibleComments + 5);
    
    hiddenComments.forEach(comment => {
    comment.style.display = "flex"; // Afficher les commentaires
    });
    
    visibleComments += 5;
    
    if (visibleComments >= comments.length) {
    loadMoreBtn.style.display = "none"; // Cacher le bouton si tous les commentaires sont affichés
    }
    });
    });