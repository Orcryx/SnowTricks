document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        let flashMessages = document.getElementById("flash");
        if (flashMessages) {
            flashMessages.style.transition = "opacity 1s";
            flashMessages.style.opacity = "0";
            setTimeout(() => flashMessages.style.display = "none", 1000);
        }
    }, 10000); // 10 secondes
});