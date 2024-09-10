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

// .login-box {
//     width: 100%;
//     max-width: 400px; /* Maximum width */
//     padding: 2rem;
//     background-color: #f8f9fa; /* Light gray background for login box */
//     border-radius: 7px; /* Rounded corners */
//     box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); /* Box shadow for depth */
//     min-height: 450px; /* Increased height for the login box */
//     justify-content: center;
//     align-items: center;
// }

// .logo {
//     display: block;
//     margin: 0 auto 1.5rem auto; /* Center the logo */
//     max-width: 100px; /* Set logo size to 100px */
//     height: auto;
// }

// .form-control-wrapper {
//     position: relative;
//     margin-bottom: 1.5rem;
// }

// .form-control-wrapper label {
//     position: absolute;
//     top: 0.45rem;
//     left: 0.75rem;
//     font-size: 1rem;
//     color: #6c757d; /* Default label color */
//     background-color: #f8f9fa; /* Match background color with input */
//     padding: 0 0.25rem; /* Padding to prevent overlapping */
//     transition: 0.2s ease all;
//     pointer-events: none;
//     z-index: 1; /* Ensure label is above input */
// }

// .form-control-wrapper input {
//     height: calc(2.5rem + 2px);
//     padding: 0.75rem;
//     font-size: 1rem;
//     border: 1px solid #ced4da; /* Default border color */
//     border-radius: 0.375rem; /* Border radius */
//     outline: none; /* Remove default outline */
//     background-color: #f8f9fa; /* Match background color */
// }

// .form-control-wrapper input:focus {
//     box-shadow: none; /* Remove default blue shadow */
//     border-color: #28a745; /* Green border on focus */
// }

// .form-control-wrapper input:focus + label,
// .form-control-wrapper input:not(:placeholder-shown) + label {
//     top: -0.55rem;
//     left: 0.75rem;
//     font-size: 0.85rem;
//     color: #28a745; /* Green label text color on focus */
// }

// .form-check-input:checked {
//     background-color: #28a745; /* Green background when checked */
//     border-color: #28a745; /* Green border when checked */
// }

// .form-check-input:focus {
//     box-shadow: none; /* Remove blue outline on focus */
// }

// /* Custom styles for the "Forgot Password" link */
// .text-decoration-none {
//     color: #404345; /* Default color for the link */
// }

// .text-decoration-none:hover,
// .text-decoration-none:focus {
//     color: #28a745; /* Green color on hover and focus */
//     text-decoration: none; /* Ensure no underline on hover and focus */
// }

// /* Custom styles for the "Remember Me" label */
// .form-check-label {
//     color: #404345; /* Text color for the "Remember Me" label */
// }

// /* Custom styles for the "No account" text */
// .no-account-text {
//     text-align: center;
//     margin-top: 1.5rem; /* Margin above the text */
//     color: #404345; /* Text color */
//     font-size: 0.875rem; /* Smaller font size */
// }

// .password-wrapper {
//     position: relative;
// }

// .password-wrapper svg {
//     position: absolute;
//     right: 10px;
//     top: 50%;
//     transform: translateY(-50%);
//     cursor: pointer;
//     fill: black; /* Black color for the SVG icons */
// }

// .password-wrapper .show-password {
//     display: none;
// }