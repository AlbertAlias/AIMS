$(document).ready(function() {
    window.loadCoor = function() {
        $.ajax({
            url: 'controller/coordinators/retrieve-coor.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Store the fetched coordinators for filtering
                    window.coordinators = response.coordinators;
                    updateCoordinatorList(window.coordinators);
                } else {
                    console.error('Failed to load coordinator:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load coordinator:', error);
            }
        });
    };

    // Function to update the coordinator list
    function updateCoordinatorList(coordinators, message = null) {
        let coordinatorInfo = $('#coordinatorInfo');
        coordinatorInfo.empty();

        // If a message is provided, display it
        if (message) {
            coordinatorInfo.append(`<div class="text-danger">${message}</div>`);
            return;
        }

        // Limit the number of coordinators displayed to 10
        const limitedCoordinators = coordinators.slice(0, 10);

        // If no coordinators found, display a message
        if (limitedCoordinators.length === 0) {
            updateCoordinatorList([], 'No coordinators found');
            return;
        }

        limitedCoordinators.forEach(function(coordinator) {
            let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 coor-btn" data-id="${coordinator.id}">
                        ${coordinator.last_name}, ${coordinator.first_name}<br>${coordinator.department_name}
                        </button>`;
            coordinatorInfo.append(btn);
        });
    }

    // Add search functionality
    $('#searchCoordinators').on('input', function() {
        const query = $(this).val().toLowerCase().trim();
        const queryParts = query.split(' ').filter(part => part); // Split query by spaces and remove empty parts
    
        // Filter coordinators based on the first name and last name
        const filteredCoordinators = window.coordinators.filter(coordinator => {
            return queryParts.every(part =>
                coordinator.first_name.toLowerCase().includes(part) ||
                coordinator.last_name.toLowerCase().includes(part)
            );
        });
    
        // Check if any departments match the query
        const departmentExists = window.coordinators.some(coordinator =>
            coordinator.department_name.toLowerCase().includes(query)
        );
    
        // Logic to show messages based on what was searched
        if (filteredCoordinators.length > 0) {
            // If there are matching coordinators, display them
            updateCoordinatorList(filteredCoordinators);
        } else if (query.length > 0 && !departmentExists) {
            // If no matching coordinators and no departments exist
            updateCoordinatorList([], 'No department coordinator found');
        } else {
            // If the search is empty, just clear the list
            updateCoordinatorList([]);
        }
    });

    loadCoor();

    // Expose the function for updating the coordinator list
    window.refreshCoorList = loadCoor;
});