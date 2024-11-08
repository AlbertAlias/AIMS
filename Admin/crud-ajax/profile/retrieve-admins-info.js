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
});

document.addEventListener("DOMContentLoaded", function () {
    // References to new and confirm password fields in the modal
    const newPasswordInput = document.getElementById("modalNewPassword");
    const confirmPasswordInput = document.getElementById("modalConfirmPassword");
    const passwordFeedback = document.getElementById("passwordFeedback");

    // Add event listeners for input in new and confirm password fields
    if (newPasswordInput && confirmPasswordInput) {
        newPasswordInput.addEventListener("input", checkPasswordMatch);
        confirmPasswordInput.addEventListener("input", checkPasswordMatch);

        // Clear feedback when focus is lost from the confirmPasswordInput field
        confirmPasswordInput.addEventListener("blur", function () {
            passwordFeedback.innerText = '';  // Clear feedback
            passwordFeedback.style.color = '';  // Reset color
        });
    }

    // Function to verify if new password and confirm password match
    function checkPasswordMatch() {
        const newPassword = newPasswordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (newPassword && confirmPassword) {
            if (newPassword === confirmPassword) {
                passwordFeedback.innerText = "Password Match";
                passwordFeedback.style.color = "green";  // Success message in green
            } else {
                passwordFeedback.innerText = "Passwords doesn't match";
                passwordFeedback.style.color = "red";  // Error message in red
            }
        } else {
            passwordFeedback.innerText = '';  // Clear feedback if one or both fields are empty
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
    const userId = document.getElementById('user-profile').getAttribute('data-user-id');

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

function displayUserInfo(user) {
    // Existing code for displaying user info on the page
    document.getElementById('users-name').innerText = `${user.last_name} ${user.first_name} ${user.middle_name} ${user.suffix}`;
    document.getElementById('users-location').innerText = user.address;
    document.getElementById('users-civil-status').innerText = user.civil_status;
    document.getElementById('users-email').innerText = user.personal_email;
    document.getElementById('users-account-email').innerText = maskEmail(user.account_email);

    // Set the user info into the input fields in the modal
    document.getElementById('lastName').value = user.last_name;
    document.getElementById('firstName').value = user.first_name;
    document.getElementById('middleName').value = user.middle_name;
}

document.addEventListener("DOMContentLoaded", function () {
    const nameEditBtn = document.getElementById("nameEditBtn");
    
    // Add event listener to the "Edit" button
    if (nameEditBtn) {
        nameEditBtn.addEventListener("click", fetchUserInfo);
    }
});

function fetchUserInfo() {
    const userId = document.getElementById('user-profile').getAttribute('data-user-id');
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

document.addEventListener("DOMContentLoaded", function () {
    fetchUserInfo();

    const locEditBtn = document.getElementById("locEditBtn");
    if (locEditBtn) {
        locEditBtn.addEventListener("click", function () {
            // Fetch current location and display it in the modal input
            const userLocation = document.getElementById("users-location").textContent;
            document.getElementById("locationInput").value = userLocation;

            // Show the location modal
            const locationModal = new bootstrap.Modal(document.getElementById("locationModal"));
            locationModal.show();
        });
    }

    // Handle location update when "Save" button is clicked in the modal
    const locUpdateBtn = document.getElementById("locUpdateBtn");
    if (locUpdateBtn) {
        locUpdateBtn.addEventListener("click", function () {
            const updatedLocation = document.getElementById("locationInput").value;
            const userId = document.getElementById("user-profile").getAttribute("data-user-id");

            fetch('controller/profile/retrieve-admins-info.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user_id: userId, new_location: updatedLocation })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the location on the page
                    document.getElementById("users-location").textContent = updatedLocation;
                    console.log("Location updated successfully");
                } else {
                    console.error("Failed to update location");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const civilEditBtn = document.getElementById("civilEditBtn");

    // Event listener to show the modal and populate the input with current civil status
    if (civilEditBtn) {
        civilEditBtn.addEventListener("click", function () {
            const civilStatus = document.getElementById("users-civil-status").textContent;
            document.getElementById("civilStatusInput").value = civilStatus;

            // Show the modal
            const civilStatusModal = new bootstrap.Modal(document.getElementById("editCivilStatusModal"));
            civilStatusModal.show();
        });
    }

    // Event listener for saving updated civil status
    const saveCivilStatusBtn = document.getElementById("saveCivilStatusBtn");
    if (saveCivilStatusBtn) {
        saveCivilStatusBtn.addEventListener("click", function () {
            const updatedCivilStatus = document.getElementById("civilStatusInput").value;
            const userId = document.getElementById("user-profile").getAttribute("data-user-id");

            fetch('controller/profile/retrieve-admins-info.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user_id: userId, new_civil_status: updatedCivilStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the civil status on the page
                    document.getElementById("users-civil-status").textContent = updatedCivilStatus;
                    console.log("Civil status updated successfully");

                    // Close the modal
                    const civilStatusModal = bootstrap.Modal.getInstance(document.getElementById("editCivilStatusModal"));
                    civilStatusModal.hide();
                } else {
                    console.error("Failed to update civil status");
                }
            })
            .catch(error => console.error("Error:", error));
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    fetchUserInfo();

    const emailEditBtn = document.getElementById("emailEditBtn");

    if (emailEditBtn) {
        emailEditBtn.addEventListener("click", function () {
            // Get the user's email from the displayed element
            const userEmail = document.getElementById("users-email").textContent;

            // Set the email in the modal input field
            document.getElementById("newEmail").value = userEmail;

            // Show the modal
            const emailEditModal = new bootstrap.Modal(document.getElementById("emailEditModal"));
            emailEditModal.show();
        });
    }

    function fetchUserInfo() {
        const userId = document.getElementById('user-profile').getAttribute('data-user-id');
        
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
        // Display user's email in the <span id="users-email">
        document.getElementById('users-email').textContent = user.personal_email;
    }
});