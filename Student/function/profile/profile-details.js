document.addEventListener('DOMContentLoaded', function() {
    const profileInfo = document.getElementById('profile-info');
    const passwordInfo = document.getElementById('account-info');
    const companyInfo = document.getElementById('company-info');
    const personalDetailsLink = document.querySelector('a[href="#profile-info"]');
    const passwordLink = document.querySelector('a[href="#account-info"]');
    const companyLink = document.querySelector('a[href="#company-info"]');

    personalDetailsLink.classList.add('active');

    personalDetailsLink.addEventListener('click', function(e) {
        e.preventDefault();
        profileInfo.style.display = 'block';
        companyInfo.style.display = 'none';
        passwordInfo.style.display = 'none';
        personalDetailsLink.classList.add('active');
        companyLink.classList.remove('active');
        passwordLink.classList.remove('active');
    });

    companyLink.addEventListener('click', function(e) {
        e.preventDefault();
        profileInfo.style.display = 'none';
        companyInfo.style.display = 'block';
        passwordInfo.style.display = 'none';
        passwordLink.classList.remove('active');
        companyLink.classList.add('active');
        personalDetailsLink.classList.remove('active');
    });

    passwordLink.addEventListener('click', function(e) {
        e.preventDefault();
        profileInfo.style.display = 'none';
        companyInfo.style.display = 'none';
        passwordInfo.style.display = 'block';
        personalDetailsLink.classList.remove('active');
        companyLink.classList.remove('active');
        passwordLink.classList.add('active');
    });
});
