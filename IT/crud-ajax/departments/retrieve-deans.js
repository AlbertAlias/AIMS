$(document).ready(function() {
    window.loadDeans = function() {
        $.ajax({
            url: 'controller/departments/retrieve-deans.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Store the fetched deans for filtering
                    window.deans = response.deans;
                    updateDeanList(window.deans);
                } else {
                    console.error('Failed to load deans:', response.message);
                    alert('Error: ' + response.message);  // Show an alert with the error message
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load deans:', error);
                alert('Error: Failed to load deans data. Please try again later.');
            }
        });
    };

    // Function to update the dean list
    function updateDeanList(deans, message = null) {
        let deanInfo = $('#deanInfo');
        deanInfo.empty();

        if (message) {
            deanInfo.append(`<div class="text-danger">${message}</div>`);
            return;
        }

        // Limit the number of deans displayed to 10
        const limitedDeans = deans.slice(0, 10);

        // If no deans found, display a message
        if (limitedDeans.length === 0) {
            updateDeanList([], 'No deans found');
            return;
        }

        limitedDeans.forEach(function(dean) {
            // Split department names and stack them
            let deptList = dean.departments.split(', ').map(function(department) {
                return `<div class="text-gray-800">${department}</div>`;
            }).join('');

            // Create the button with dean's details
            let deanButton = `
                <button class="btn btn-outline-secondary d-block mb-2 w-100 coor-btn" data-id="${dean.user_id}">
                    ${dean.last_name}, ${dean.first_name}<br>
                    <div class="department-list">
                        ${deptList}
                    </div>
                </button>
            `;
            deanInfo.append(deanButton);
            console.log("Generated button:", deanButton);
        });
    }

    // Add search functionality
    $('#searchDeans').on('input', function() {
        const query = $(this).val().toLowerCase().trim();
        const filteredDeans = window.deans.filter(dean =>
            (dean.first_name.toLowerCase() + ' ' + dean.last_name.toLowerCase()).includes(query)
        );

        // Logic to show messages based on what was searched
        if (filteredDeans.length > 0) {
            updateDeanList(filteredDeans);
        } else if (query.length > 0) {
            updateDeanList([], 'No matching deans found');
        } else {
            updateDeanList([]);  // Clear the list if search is empty
        }
    });

    loadDeans(); // Call to load deans

    // Expose the function for updating the dean list
    window.refreshDeanList = loadDeans;
});