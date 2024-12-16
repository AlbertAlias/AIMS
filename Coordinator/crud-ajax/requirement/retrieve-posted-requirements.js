$(document).ready(function () {
    // Function to fetch and display posted requirements
    function loadPostedRequirements() {
        $.ajax({
            url: "controller/requirement/retrieve-posted-requirements.php", // PHP file to fetch the requirements
            type: "GET",
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    const requirementsContainer = $(".col-md-8"); // Container for displaying posts
                    requirementsContainer.empty(); // Clear any previous content

                    data.requirements.forEach(function (requirement) {
                        // Format the deadline date
                        const formattedDeadline = formatDeadline(requirement.deadline);

                        // Create the HTML content for each requirement
                        const requirementHTML = `
                        <div class="requirement-post">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-success">${requirement.title}</h6>
                            <div class="dropdown">
                                <i class="fa-solid fa-ellipsis-vertical" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-pen-to-square"></i> Edit</a></li>
                                    <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash"></i> Delete</a></li>
                                </ul>
                            </div>
                        </div>
                        <p>${requirement.description}</p>
                        <div class="deadline text-muted">Deadline: ${formattedDeadline}</div>
                        <div class="toggle-switch">
                            <input type="checkbox" id="toggleSwitch${requirement.id}" class="toggle-input">
                            <label for="toggleSwitch${requirement.id}" class="toggle-label">
                                <i class="fa-solid fa-lock-open open-icon"></i>
                                <i class="fa-solid fa-lock close-icon"></i>
                            </label>
                        </div>
                    </div>
                    
                        `;
                        // Append the requirement HTML to the container
                        requirementsContainer.append(requirementHTML);
                    });
                } else {
                    console.error('Failed to load requirements:', data.error);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching requirements: ", error);
            }
        });
    }

    // Function to format the deadline date
    function formatDeadline(deadline) {
        const date = new Date(deadline); // Create a Date object
        const options = { month: 'short', day: 'numeric' }; // Format to short month and numeric day
        return date.toLocaleDateString('en-US', options);
    }

    // Call the function to load the posted requirements when the page loads
    loadPostedRequirements();
});