function toggleForm() {
    const loginForm = document.querySelector('.login-form');
    const registerForm = document.querySelector('.register-form');

    loginForm.classList.toggle('hidden');
    registerForm.classList.toggle('hidden');
}