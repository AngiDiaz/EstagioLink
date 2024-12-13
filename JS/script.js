const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");

togglePassword.addEventListener("click", function () {
    // Alterna o tipo do campo de "password" para "text" e vice-versa
    const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
    passwordInput.setAttribute("type", type);
    
    // Alterna o ícone entre "fa-eye" e "fa-eye-slash"
    this.classList.toggle("fa-eye-slash");
})