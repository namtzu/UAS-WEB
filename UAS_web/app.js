document.addEventListener("DOMContentLoaded", function() {
    // Header scroll effect for all pages
    window.addEventListener("scroll", function() {
        const header = document.querySelector(".header");
        if (window.scrollY > 50) {
            header.classList.add("scrolled");
        } else {
            header.classList.remove("scrolled");
        }
    });

    // Canvas functionality
    initializeCanvas();
});