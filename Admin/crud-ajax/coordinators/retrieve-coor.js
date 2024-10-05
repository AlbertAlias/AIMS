$(document).ready(function() {
    window.loadCoor = function() {
        $.ajax({
            url: 'controller/coordinators/retrieve-coor.php',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    let coordinatorInfo = $('#coordinatorInfo');
                    coordinatorInfo.empty();

                    // Limit the number of coordinators displayed to 5
                    const limitedCoordinators = response.coordinators.slice(0, 10);

                    limitedCoordinators.forEach(function(coordinator) {
                        let btn = `<button class="btn btn-outline-secondary d-block mb-2 w-100 coor-btn" data-id="${coordinator.id}">
                                    ${coordinator.last_name}, ${coordinator.first_name}<br>${coordinator.department_name}
                                    </button>`;
                        coordinatorInfo.append(btn);
                    });

                } else {
                    console.error('Failed to load coordinator:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Failed to load coordinator:', error);
            }
        });
    };

    loadCoor();

    // Expose the function for updating the coordinator list
    window.refreshCoorList = loadCoor;
});