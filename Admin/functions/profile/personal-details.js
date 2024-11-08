document.addEventListener('DOMContentLoaded', function() {
    // Set the active links
    const profileInfo = document.getElementById('profile-info');
    const passwordInfo = document.getElementById('account-info');
    const personalDetailsLink = document.querySelector('a[href="#profile-info"]');
    const passwordLink = document.querySelector('a[href="#account-info"]');

    personalDetailsLink.classList.add('active');

    // Add click event listeners to the links
    personalDetailsLink.addEventListener('click', function(e) {
        e.preventDefault();
        profileInfo.style.display = 'block';
        passwordInfo.style.display = 'none';
        personalDetailsLink.classList.add('active');
        passwordLink.classList.remove('active');
    });

    passwordLink.addEventListener('click', function(e) {
        e.preventDefault();
        profileInfo.style.display = 'none';
        passwordInfo.style.display = 'block';
        passwordLink.classList.add('active');
        personalDetailsLink.classList.remove('active');
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const nameEditBtn = document.getElementById("nameEditBtn");
    
    // Add event listener to the "Edit" button
    if (nameEditBtn) {
        nameEditBtn.addEventListener("click", fetchUserInfo);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const emailEditBtn = document.getElementById("emailEditBtn");
    const emailEditModal = new bootstrap.Modal(document.getElementById("emailEditModal"));
    const updateEmailBtn = document.getElementById("updateEmailBtn");

    // Show modal when edit button is clicked
    emailEditBtn.addEventListener("click", function () {
        emailEditModal.show();
    });

    // Handle update button click inside the modal
    updateEmailBtn.addEventListener("click", function () {
        const newEmail = document.getElementById("newEmail").value;

        if (newEmail) {
            // Update email display (you may also want to send this to the server for updating in the backend)
            document.getElementById("users-email").textContent = newEmail;

            // Close the modal after updating
            emailEditModal.hide();
        }
    });
});
