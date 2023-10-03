const passwordInput = document.querySelector("#password")
const eye = document.querySelector("#eye")

eye.addEventListener("click", function () {
    const isPasswordVisible = passwordInput.getAttribute("type") === "text";

    if (isPasswordVisible) {
        passwordInput.setAttribute("type", "password");
        eye.classList.remove("fa-eye-slash");
        eye.classList.add("fa-eye");
    } else {
        passwordInput.setAttribute("type", "text");
        eye.classList.remove("fa-eye");
        eye.classList.add("fa-eye-slash");
    }
});