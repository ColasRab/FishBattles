document.addEventListener("DOMContentLoaded", function () {
    const modal = document.querySelector(".modal");
    const modalLi = document.querySelector(".modal-content");
    const closeButton = document.querySelector(".close-button");

    setTimeout(function () {
        if (modal) {
            modal.style.display = "block";
            modalLi.style.display = "block";
        }
    }, 12000);

    if (closeButton) {
        closeButton.addEventListener("click", function () {
            closeModal();
        });
    }
});

function closeModal() {
    const modal = document.getElementById("resultModal");
    if (modal) {
        modal.style.display = "none";
        window.location.href = "gacha.php";
    }
}