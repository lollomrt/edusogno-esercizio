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