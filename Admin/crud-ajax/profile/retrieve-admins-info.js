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
            console.log(data.user); // Check the user object in the console
            displayUserInfo(data.user);
        } else {
            console.error("Error fetching user info");
        }
    })
    .catch(error => console.error('Error:', error));
}

function displayUserInfo(user) {
    document.getElementById('users-name').innerText = user.first_name ? `${user.last_name} ${user.first_name} ${user.middle_name} ${user.suffix}` : "";
    document.getElementById('users-location').innerText = user.address || '';
    document.getElementById('users-civil-status').innerText = user.civil_status || '';
    document.getElementById('users-email').innerText = user.personal_email || '';
}
