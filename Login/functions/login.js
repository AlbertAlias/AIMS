document.getElementById('togglePassword').addEventListener('click', function () {
    const passwordField = document.getElementById('password');
    const showPasswordIcon = this.querySelector('.show-password');
    const hidePasswordIcon = this.querySelector('.hide-password');

    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        showPasswordIcon.style.display = 'none';
        hidePasswordIcon.style.display = 'inline-block';
    } else {
        passwordField.type = 'password';
        showPasswordIcon.style.display = 'inline-block';
        hidePasswordIcon.style.display = 'none';
    }
});