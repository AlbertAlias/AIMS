document.addEventListener('DOMContentLoaded', function() {
    const profileInfo = document.getElementById('profile-info');
    const passwordInfo = document.getElementById('account-info');
    const personalDetailsLink = document.querySelector('a[href="#profile-info"]');
    const passwordLink = document.querySelector('a[href="#account-info"]');

    personalDetailsLink.classList.add('active');

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
