document.addEventListener("DOMContentLoaded", function () {
    fetchUserInfo();

    // Add click event to show modal with masked email for account-info section
    const editAccountEmailBtn = document.getElementById("editAccountEmailBtn");
    if (editAccountEmailBtn) {
        editAccountEmailBtn.addEventListener("click", function () {
            const userAccountEmail = document.getElementById("users-account-email").textContent;
            const maskedEmail = maskEmail(userAccountEmail);

            // Set the input value in the modal to the masked email
            document.getElementById("editInput").value = maskedEmail;
            document.getElementById("editModalLabel").textContent = "Edit Account Email";

            // Show the modal
            const editModal = new bootstrap.Modal(document.getElementById("editModal"));
            editModal.show();
        });
    }

    const changePasswordBtn = document.getElementById("changePasswordBtn");
    if (changePasswordBtn) {
        changePasswordBtn.addEventListener("click", function () {
            const changePasswordModal = new bootstrap.Modal(document.getElementById("changePasswordModal"));
            changePasswordModal.show();
        });
    }

    // Event listener for old password verification
    const oldPasswordInput = document.getElementById("modalOldPassword");
    if (oldPasswordInput) {
        oldPasswordInput.addEventListener("input", function () {
            verifyOldPassword(oldPasswordInput.value);
        });

        // Hide feedback on blur (when focus is lost)
        oldPasswordInput.addEventListener("blur", function () {
            const feedbackEl = document.getElementById("oldPasswordFeedback");
            feedbackEl.innerText = '';  // Clear feedback
            feedbackEl.style.color = '';  // Reset color
        });
    }

    // Event listener for new password confirmation
    const newPasswordInput = document.getElementById("newPassword");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const passwordFeedback = document.getElementById("passwordFeedback");

    if (newPasswordInput && confirmPasswordInput) {
        confirmPasswordInput.addEventListener("input", function () {
            verifyPasswordMatch(newPasswordInput.value, confirmPasswordInput.value);
        });

        // Hide feedback on blur (when focus is lost)
        confirmPasswordInput.addEventListener("blur", function () {
            passwordFeedback.innerText = '';  // Clear feedback
            passwordFeedback.style.color = '';  // Reset color
        });
    }

    // Password matching function
    function verifyPasswordMatch(newPassword, confirmPassword) {
        if (newPassword === confirmPassword && newPassword !== '') {
            passwordFeedback.innerText = "Password Match";
            passwordFeedback.style.color = "green";  // Show success (green)
        } else if (newPassword !== confirmPassword && confirmPassword !== '') {
            passwordFeedback.innerText = "Passwords do not match";
            passwordFeedback.style.color = "red";  // Show error (red)
        } else {
            passwordFeedback.innerText = '';  // Clear feedback when both fields are empty
        }
    }
});

function maskEmail(email) {
    if (!email || email.length < 3) return email;

    const [localPart, domain] = email.split('@');
    if (!domain) return email;

    // Reveal the first 3 characters, mask the rest with asterisks, and keep the domain visible
    const visiblePart = localPart.slice(0, 3);
    const maskedPart = '*'.repeat(localPart.length - 3);

    return `${visiblePart}${maskedPart}@${domain}`;
}

function verifyOldPassword(password) {
    const userId = document.getElementById('camera-icon').getAttribute('data-user-id');

    console.log("Verifying password for user ID:", userId);
    console.log("Entered password:", password);

    fetch('controller/profile/retrieve-admins-info.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: userId, password: password })
    })
    .then(response => response.json())
    .then(data => {
        const feedbackEl = document.getElementById("oldPasswordFeedback");
        if (data.success) {
            console.log("Password matched");
            feedbackEl.innerText = "Password Match";
            feedbackEl.style.color = "green";
        } else {
            console.log("Password does not match");
            feedbackEl.innerText = "Incorrect Password";
            feedbackEl.style.color = "red";
        }
    })
    .catch(error => console.error('Error:', error));
}

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
    document.getElementById('users-name').innerText = `${user.last_name} ${user.first_name} ${user.middle_name} ${user.suffix}`;
    document.getElementById('users-location').innerText = user.address;
    document.getElementById('users-civil-status').innerText = user.civil_status;
    document.getElementById('users-email').innerText = user.personal_email;
    document.getElementById('users-account-email').innerText = maskEmail(user.account_email);
}