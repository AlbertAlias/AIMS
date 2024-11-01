document.addEventListener("DOMContentLoaded", function () {
    fetchUserInfo();

    // Select the email edit and save buttons
    const editEmailBtn = document.getElementById('editEmailBtn');
    const saveEmailBtn = document.getElementById('saveEmailBtn');
    const emailDisplay = document.getElementById('users-email');
    const emailInput = document.getElementById('email-input');

    if (editEmailBtn && saveEmailBtn && emailDisplay && emailInput) {
        // Show input field to edit email
        editEmailBtn.addEventListener('click', function () {
            emailDisplay.style.display = 'none';
            emailInput.style.display = 'inline';
            saveEmailBtn.style.display = 'inline';
            editEmailBtn.style.display = 'none';
            emailInput.value = emailDisplay.innerText;
        });

        // Save email when Save button is clicked
        saveEmailBtn.addEventListener('click', function () {
            emailDisplay.innerText = emailInput.value;
            emailDisplay.style.display = 'inline';
            emailInput.style.display = 'none';
            saveEmailBtn.style.display = 'none';
            editEmailBtn.style.display = 'inline';
            updateEmailInDatabase(emailInput.value); // Function to save the updated email
        });
    }
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
            displayUserInfo(data.user);
        } else {
            console.error("Error fetching user info");
        }
    })
    .catch(error => console.error('Error:', error));
}

function displayUserInfo(user) {
    const userNameEl = document.getElementById('users-name');
    const userLocationEl = document.getElementById('users-location');
    const userStatusEl = document.getElementById('users-civil-status');
    const userEmailEl = document.getElementById('users-email');

    if (userNameEl) userNameEl.innerText = user.first_name ? `${user.last_name} ${user.first_name} ${user.middle_name} ${user.suffix}` : "";
    if (userLocationEl) userLocationEl.innerText = user.address || '';
    if (userStatusEl) userStatusEl.innerText = user.civil_status || '';
    if (userEmailEl) userEmailEl.innerText = user.personal_email || '';
}
