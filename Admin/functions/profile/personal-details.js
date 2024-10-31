document.addEventListener('DOMContentLoaded', function() {
    // Set the active links
    const profileInfo = document.getElementById('profile-info');
    const passwordInfo = document.getElementById('account-info');
    const personalDetailsLink = document.querySelector('a[href="#profile-info"]');
    const passwordLink = document.querySelector('a[href="#account-info"]');

    // Show personal details by default (HTML handles it now, so this is no longer needed)
    // profileInfo.style.display = 'block'; // Remove this line
    // passwordInfo.style.display = 'none'; // Remove this line
    personalDetailsLink.classList.add('active'); // Add 'active' class to the personal details link

    // Add click event listeners to the links
    personalDetailsLink.addEventListener('click', function(e) {
        e.preventDefault();
        profileInfo.style.display = 'block';
        passwordInfo.style.display = 'none';
        personalDetailsLink.classList.add('active'); // Mark this link as active
        passwordLink.classList.remove('active'); // Remove active class from the password link
    });

    passwordLink.addEventListener('click', function(e) {
        e.preventDefault();
        profileInfo.style.display = 'none';
        passwordInfo.style.display = 'block';
        passwordLink.classList.add('active'); // Mark this link as active
        personalDetailsLink.classList.remove('active'); // Remove active class from the personal details link
    });
});
