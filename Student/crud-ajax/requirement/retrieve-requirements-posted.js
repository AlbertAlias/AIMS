$(document).ready(function() {
    // Fetch requirements when the page is loaded
    $.ajax({
        url: 'controller/requirement/retrieve-requirements-posted.php',
        method: 'GET',
        success: function(response) {
            const requirements = JSON.parse(response);
            
            if (requirements.length > 0) {
                // Empty the container before adding new requirements
                $('#postedRequirementsContainer').empty();
                
                // Loop through the requirements and display them in the container
                requirements.forEach(function(req) {
                    const formattedDate = new Date(req.deadline).toLocaleDateString(); // Format the deadline date
                    
                    const requirementHTML = `
                        <div class="card task-card ms-2 mb-3 posted-requirement" data-title="${req.title}" data-requirement-id="${req.requirement_id}"
                            style="cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); width: 98%; border-left: 4px solid #198754; transition: background-color 0.3s ease; padding: 8px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <p style="margin: 0; font-weight: 400; color: #333; font-size: 1.2rem;">
                                    ${req.full_name} posted a <span style="color: #198754;">${req.title}</span>
                                </p>
                            </div>
                            <div class="card-text" style="font-size: 1.1rem; color: #555;">
                                ${req.description}
                            </div>
                            <div class="card-text fs-6 text-muted">
                                Deadline: ${formattedDate}
                            </div>
                        </div>
                    `;
                    $('#postedRequirementsContainer').append(requirementHTML);
                });
            } else {
                // If no requirements found, display a message
                $('#postedRequirementsContainer').html('<p>No requirements available.</p>');
            }
        },
        error: function() {
            alert('Error fetching data.');
        }
    });

    // When a requirement card is clicked, populate the title in the input field and display the chosen title
    $(document).on('click', '.posted-requirement', function() {
        const title = $(this).data('title');  // Get the title of the clicked requirement
        const requirementId = $(this).data('requirement-id');  // Get the requirement ID if needed
        
        // Display the "Requirement Chosen: " followed by the title
        $('#chosenRequirement').text('Chosen Requirement: ' + title);
    });
});
