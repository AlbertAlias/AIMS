document.addEventListener('DOMContentLoaded', () => {
    const passwordInput = document.getElementById('password');
    const showPasswordSvg = document.getElementById('showPassword');
    const hidePasswordSvg = document.getElementById('hidePassword');

    // Initially, hide the 'hide password' SVG and show the 'show password' SVG
    hidePasswordSvg.style.display = 'none';

    showPasswordSvg.addEventListener('click', () => {
        passwordInput.type = 'text';
        showPasswordSvg.style.display = 'none';
        hidePasswordSvg.style.display = 'block';
    });

    hidePasswordSvg.addEventListener('click', () => {
        passwordInput.type = 'password';
        showPasswordSvg.style.display = 'block';
        hidePasswordSvg.style.display = 'none';
    });
});