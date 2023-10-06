const passwordInputs = document.querySelectorAll(".password-input");
const toggleButtons = document.querySelectorAll(".toggle-password-visibility");

toggleButtons.forEach((button, index) => {
    button.addEventListener("click", () => {
        togglePasswordVisibility(index);
    });
});

function togglePasswordVisibility(index) {
    const passwordInput = passwordInputs[index];
    const isPasswordVisible = passwordInput.getAttribute("type") === "text";

    if (isPasswordVisible) {
        passwordInput.setAttribute("type", "password");
        toggleButtons[index].classList.remove("fa-eye-slash");
        toggleButtons[index].classList.add("fa-eye");
    } else {
        passwordInput.setAttribute("type", "text");
        toggleButtons[index].classList.remove("fa-eye");
        toggleButtons[index].classList.add("fa-eye-slash");
    }
}

// Script per la gestione dell'apertura7chiusura popup dasboard

// Funzione per aprire il popup
function openPopup() {
    document.getElementById("popup-crea-evento").style.display = "flex";
}

// Funzione per chiudere il popup
function closePopup() {
    document.getElementById("popup-crea-evento").style.display = "none";
}

// Ascolta il clic sul pulsante "Crea evento" e apri il popup
document.getElementById("crea-evento-button").addEventListener("click", function (event) {
    event.preventDefault(); // Impedisce il comportamento predefinito del link
    openPopup();
});

// Ascolta il clic sul pulsante di chiusura del popup
document.getElementById("popup-close-button").addEventListener("click", function (event) {
    event.preventDefault();
    closePopup();
});
