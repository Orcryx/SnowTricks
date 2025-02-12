document.addEventListener("DOMContentLoaded", function () {
    const btnCarrousel = document.querySelector(".btn-carrousel .btn");
    const carrousel = document.getElementById("carrousel");

    function toggleCarrouselOnResize() {
        if (window.innerWidth >= 801) {
            carrousel.style.display = "block";
        } else {
            carrousel.style.display = "none";
        }
    }

    toggleCarrouselOnResize(); // Vérifier au chargement
    window.addEventListener("resize", toggleCarrouselOnResize);

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