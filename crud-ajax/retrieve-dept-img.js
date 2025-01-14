$(document).ready(function () {
    function loadDepartments() {
        $.ajax({
            url: 'controller/retrieve-dept-img.php',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                console.log(response); // Debug response
                if (response.success) {
                    let cardsHtml = '';
                    response.data.forEach(function (department) {
                        // Create the card using the department image and name
                        cardsHtml += `
                            <div class="card">
                                <div class="card-inner">
                                    <div class="card-front" style="background-image: url('${department.department_image}');">
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#department-cards').html(cardsHtml);
                    console.log($('#department-cards'));

                    // Now update the cards since they are dynamically added
                    cards = document.querySelectorAll('.card');  // Reinitialize the cards after they are loaded
                    updateCards();  // Call the updateCards function to display the initial card state
                } else {
                    alert('Failed to load departments');
                }
            },
            error: function (xhr, status, error) {
                console.error("Error: " + error); // Log AJAX errors
            }
        });
    }

    loadDepartments();
});
