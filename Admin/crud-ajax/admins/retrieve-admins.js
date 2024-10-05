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

    // Function to update the displayed list of admins
    function updateAdminList(admins) {
        adminsInfo.empty();
        if (admins.length === 0) {
            adminsInfo.html('<p>No admins found.</p>');  // Show message if no admins match the search query
        } else {
            admins.forEach(function(admin) {
                const btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 admin-btn" data-id="${admin.id}">
                                ${admin.last_name}, ${admin.first_name}
                             </button>`;
                adminsInfo.append(btn);
            });
        }
    }

    // Event listener for search input
    searchInput.on('input', function() {
        const query = $(this).val().toLowerCase();
        const filteredAdmins = allAdmins.filter(admin => 
            admin.last_name.toLowerCase().includes(query) || 
            admin.first_name.toLowerCase().includes(query)
        );
        updateAdminList(filteredAdmins);  // Update the list based on the search query
    });

    // Load admins on page load
    loadAdmins();
});