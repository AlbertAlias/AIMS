$(document).ready(function() {
    // AJAX request to fetch the requirements
    $.ajax({
        url: 'controller/requirement/retrieve-requirements.php',
        type: 'GET',
        success: function(response) {
            console.log('Response from server:', response);  // Log the entire response for debugging

            // Check if there was an error in the response
            if (response.error) {
                alert(response.error);
            } else {
                // Clear the requirements container before appending new items
                $('#requirementsContainer').empty();

                // Ensure response.requirements is an array before calling forEach
                if (Array.isArray(response.requirements)) {
                    response.requirements.forEach(function(requirement) {
                        let requirementItem = `
                            <div class="requirement-item">
                                <h5>${requirement.title}</h5>
                                <p>${requirement.description}</p>
                            </div>
                        `;
                        $('#requirementsContainer').append(requirementItem);
                    });
                } else {
                    alert("Invalid response format, 'requirements' is not an array.");
                }
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error: " + error);
            alert("An error occurred while retrieving the requirements.");
        }
    });
});