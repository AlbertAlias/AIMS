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

    // Automatically append @aims.edu.ph when user types @
    const emailInput = document.getElementById('editAccountEmailInput');
    emailInput.addEventListener('input', function(e) {
        const value = e.target.value;
        if (value.includes('@') && !value.includes('@aims.edu.ph')) {
            e.target.value = value.split('@')[0] + '@aims.edu.ph';
        }
    });
});
