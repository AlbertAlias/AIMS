$(document).ready(function () {
    const requirementsContainer = $("#requirementsContainer");
    const postedRequirementsContainer = $("#postedRequirementsContainer");

    // Function to check if the user has already posted a requirement
    function checkUserPostedRequirement() {
        return $.ajax({
            url: "controller/requirement/check-student-posted.php", // PHP script to check if the user has posted a requirement
            method: "GET",
            dataType: "json"
        });
    }

    // Function to load the coordinator's requirements
    function loadCoordinatorRequirements() {
        $.ajax({
            url: "controller/requirement/retrieve-requirements.php",
            method: "GET",
            dataType: "json",
            success: function (result) {
                if (result.success) {
                    const requirements = result.requirements;

                    if (requirements.length > 0) {
                        // HTML for requirementsContainer (only title)
                        const requirementsHtml = requirements.map(req => {
                            const statusBadge = req.submission_status
                                ? `<div class="badge bg-success text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">${req.submission_status}</div>`
                                : `<div class="badge bg-warning text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">Pending</div>`;
    
                            return `
                                <div class="card task-card task-card-hover px-3 py-2 mb-4" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px, rgba(0, 0, 0, 0.05) 0px 1px 3px; transition: transform 0.3s ease;">
                                    <div class="d-flex justify-content-between align-items-center" style="height: 100%;">
                                        <div class="d-flex flex-column justify-content-center">
                                            <div class="card-title fs-5 text-primary fw-bold mt-2">${req.title}</div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            ${statusBadge}
                                        </div>
                                    </div>
                                </div>
                            `;
                        }).join("");

                        // HTML for postedRequirementsContainer (full details)
                        const postedRequirementsHtml = requirements.map(req => {
                            // Format the created_at date to show only the month and date
                            const createdAt = new Date(req.created_at);
                            const formattedDate = createdAt.toLocaleString('default', { month: 'short', day: 'numeric' });
                        
                            return `
                                <div class="card task-card px-3 py-2 mb-4" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                                    <div class="d-flex align-items-center" style="height: 100%;">
                                        <i class="fa-solid fa-clipboard-list me-3" style="font-size: 2rem;"></i>
                                        <div class="d-flex flex-column justify-content-center">
                                            <div class="card-title fs-6 text-primary mb-2 pt-2">
                                                ${req.first_name} ${req.last_name} posted a new requirement: ${req.title}
                                            </div>
                                            <div class="card-text fs-7 mb-2 text-muted">Posted ${formattedDate}</div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }).join("");
                        
                        // Append the generated HTML to the respective containers
                        requirementsContainer.html(requirementsHtml);
                        postedRequirementsContainer.html(postedRequirementsHtml);
                    } else {
                        requirementsContainer.html("<p class='text-muted'>No requirements posted by your coordinator.</p>");
                        postedRequirementsContainer.html("<p class='text-muted'>No requirements posted by your coordinator.</p>");
                    }
                } else {
                    requirementsContainer.html(`<p class='text-danger'>Error: ${result.error}</p>`);
                    postedRequirementsContainer.html(`<p class='text-danger'>Error: ${result.error}</p>`);
                }
            },
            error: function (xhr, status, error) {
                console.error("Error fetching requirements:", error);
                requirementsContainer.html("<p class='text-danger'>Failed to load requirements. Please try again later.</p>");
                postedRequirementsContainer.html("<p class='text-danger'>Failed to load requirements. Please try again later.</p>");
            }
        });
    }

    // Check if the user has already posted a requirement
    checkUserPostedRequirement().done(function (response) {
        if (response.posted) {
            // Hide the coordinator's requirements if the user has already posted a requirement
            requirementsContainer.html("<p class='text-muted'>You have already posted a requirement.</p>");
            postedRequirementsContainer.html("<p class='text-muted'>You have already posted a requirement.</p>");
        } else {
            // Load the coordinator's requirements if the user has not posted a requirement
            loadCoordinatorRequirements();
        }
    }).fail(function (xhr, status, error) {
        console.error("Error checking user posted requirement:", error);
        requirementsContainer.html("<p class='text-danger'>Failed to check user posted requirement. Please try again later.</p>");
        postedRequirementsContainer.html("<p class='text-danger'>Failed to check user posted requirement. Please try again later.</p>");
    });
});