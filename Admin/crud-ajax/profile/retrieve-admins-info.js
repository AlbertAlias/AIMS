document.addEventListener("DOMContentLoaded", function () {
    fetchUserInfo();
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

function maskEmail(email) {
    if (!email || email.length < 3) return email;
    
    const [localPart, domain] = email.split('@');
    if (!domain) return email;

    const firstChar = localPart.charAt(0);
    const lastChar = localPart.charAt(localPart.length - 1);
    const maskedMiddle = `<span class="password-dots">${'●'.repeat(localPart.length - 2)}</span>`;
    
    return `${firstChar}${maskedMiddle}${lastChar}@${domain}`;
}

function displayUserInfo(user) {
    const userNameEl = document.getElementById('users-name');
    const userLocationEl = document.getElementById('users-location');
    const userStatusEl = document.getElementById('users-civil-status');
    const userEmailEl = document.getElementById('users-email');
    const userAccountEmailEl = document.getElementById('users-account-email');

    if (userNameEl) userNameEl.innerText = user.first_name ? `${user.last_name} ${user.first_name} ${user.middle_name} ${user.suffix}` : "";
    if (userLocationEl) userLocationEl.innerText = user.address || '';
    if (userStatusEl) userStatusEl.innerText = user.civil_status || '';
    if (userEmailEl) userEmailEl.innerText = user.personal_email || '';
    if (userAccountEmailEl) userAccountEmailEl.innerHTML = maskEmail(user.account_email || '');
}