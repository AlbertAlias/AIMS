document.addEventListener('DOMContentLoaded', function() {
    const adminsInfo = document.getElementById('adminsInfo');

    function fetchAdmins() {
        if (adminsInfo) {
            fetch('controller/admins/retrieve-admins.php')
                .then(response => response.text())
                .then(text => {
                    try {
                        const data = JSON.parse(text);
                        if (data.success && Array.isArray(data.admins)) {
                            adminsInfo.innerHTML = data.admins.map(admin => 
                                `<button class="btn btn-outline-secondary d-block mb-2 w-100 admin-btn" data-id="${admin.id}">
                                    ${admin.last_name}, ${admin.first_name}
                                </button>`
                            ).join('');
                        } else {
                            alert('Error retrieving admins: ' + data.message);
                        }
                    } catch (e) {
                        console.error('Error parsing JSON:', e);
                        console.error('Response text:', text);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    }

    // Fetch admins on page load
    fetchAdmins();

    // Expose the function for updating the admin list
    window.refreshAdminList = fetchAdmins;
});
