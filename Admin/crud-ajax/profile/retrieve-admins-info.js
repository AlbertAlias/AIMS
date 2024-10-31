document.addEventListener("DOMContentLoaded", function () {
    // Initialize fetching user info and event listeners
    fetchUserInfo();

    // Select all edit icons
const editIcons = document.querySelectorAll('.edit-icon');

    editIcons.forEach((icon) => {
        icon.addEventListener('click', function () {
            // Toggle active class on the clicked icon
            icon.classList.toggle('active');
            
            // If this is the password edit icon, toggle visibility of password fields
            if (icon.id === 'password-edit-icon') {
                const passwordChangeFields = document.getElementById('password-change-fields');
                passwordChangeFields.style.display = passwordChangeFields.style.display === 'none' ? 'block' : 'none';
            }
        });
    });
});


function fetchUserInfo() {
    const userId = document.getElementById('camera-icon').getAttribute('data-user-id');

    fetch('controller/profile/retrieve-admins-info.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: userId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(data.user); // Check the user object in the console
            displayUserInfo(data.user);
        } else {
            console.error("Error fetching user info");
        }
    })
    .catch(error => console.error('Error:', error));
}

function displayUserInfo(user) {
    // Check and display user details if elements are present
    const userNameEl = document.getElementById('users-name');
    const userLocationEl = document.getElementById('users-location');
    const userStatusEl = document.getElementById('users-civil-status');
    const userEmailEl = document.getElementById('users-email');
    const userUsernameEl = document.getElementById('users-username');
    const userMaskedEmailEl = document.getElementById('users-masked-email');
    
    if (userNameEl) userNameEl.innerText = user.first_name ? `${user.last_name} ${user.first_name} ${user.middle_name} ${user.suffix}` : "";
    if (userLocationEl) userLocationEl.innerText = user.address || '';
    if (userStatusEl) userStatusEl.innerText = user.civil_status || '';
    if (userEmailEl) userEmailEl.innerText = user.personal_email || '';
    if (userUsernameEl) userUsernameEl.innerText = user.account_email || ''; // Display the username

    // Format and display the email for the account section if element is present
    if (userMaskedEmailEl && user.account_email) {
        const emailParts = user.account_email.split("@");
        if (emailParts[0].length > 2) {
            const maskedEmailName = emailParts[0][0] + "*".repeat(emailParts[0].length - 2) + emailParts[0].slice(-1);
            userMaskedEmailEl.innerText = `${maskedEmailName}@${emailParts[1]}`;
        } else {
            // If the email name is too short to mask, display it as is
            userMaskedEmailEl.innerText = user.account_email;
        }
    }
}
