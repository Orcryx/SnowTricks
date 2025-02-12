document.addEventListener("DOMContentLoaded", function () {
    const btnCarrousel = document.querySelector(".btn-carrousel .btn");
    const carrousel = document.getElementById("carrousel");

    // Masquer le carrousel par défaut
    carrousel.style.display = "none";

    btnCarrousel.addEventListener("click", function () {
        if (carrousel.style.display === "none") {
            carrousel.style.display = "block";
            btnCarrousel.textContent = "Masquer les images";
        } else {
            carrousel.style.display = "none";
            btnCarrousel.textContent = "Voir les images";
        }
    });
});
