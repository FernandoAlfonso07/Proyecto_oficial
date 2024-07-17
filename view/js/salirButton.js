document.addEventListener("DOMContentLoaded", function () {
    const salirButton = document.getElementById("salirButton");

    salirButton.addEventListener("mouseenter", function () {
        salirButton.classList.add("shake");

        setTimeout(function () {
            salirButton.classList.remove("shake");
        }, 500);
    });
});

