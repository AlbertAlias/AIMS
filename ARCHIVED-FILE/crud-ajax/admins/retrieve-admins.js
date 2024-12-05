$(document).ready(function() {
    let allAdmins = [];  // Store all admins for filtering later
    const searchInput = $('#searchAdmins');
    const adminsInfo = $('#adminsInfo');

    // Function to fetch admins from the server
    window.loadAdmins = function() {
        $.ajax({
            url: 'controller/admins/retrieve-admins.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    allAdmins = response.admins;  // Save the retrieved admins for later use
                    updateAdminList(allAdmins);   // Display all admins initially
                } else {
                    console.error('Failed to load admins:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load admins:', error);
            }
        });
    };

    // Function to update the displayed list of admins with optional message
    function updateAdminList(admins, message = null) {
        adminsInfo.empty();

        // If a message is provided, display it in red
        if (message) {
            adminsInfo.append(`<p class="text-danger">${message}</p>`);
            return;
        }

        // If no admins found, display a default message
        if (admins.length === 0) {
            updateAdminList([], 'Admin does not exist.');
            return;
        }

        // Display the list of admins
        admins.forEach(function(admin) {
            const btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 admin-btn" data-id="${admin.id}">
                            ${admin.last_name}, ${admin.first_name}
                         </button>`;
            adminsInfo.append(btn);
        });
    }

    // Event listener for search input
    searchInput.on('input', function() {
        const query = $(this).val().toLowerCase().trim();
        const queryParts = query.split(' ').filter(part => part);  // Split query by spaces and remove empty parts

        // Filter admins based on first name or last name
        const filteredAdmins = allAdmins.filter(admin => {
            return queryParts.every(part =>
                admin.first_name.toLowerCase().includes(part) ||
                admin.last_name.toLowerCase().includes(part)
            );
        });

        // If there are matching admins, display them
        if (filteredAdmins.length > 0) {
            updateAdminList(filteredAdmins);
        } else if (query.length > 0) {
            // If no matching admins, show error message
            updateAdminList([], 'Admin does not exist.');
        } else {
            // If the search is empty, just clear the list
            updateAdminList([]);
        }
    });

    // Load admins on page load
    loadAdmins();
});
