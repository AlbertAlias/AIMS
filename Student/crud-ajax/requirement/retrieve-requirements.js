$(document).ready(function () {
    const requirementsContainer = $("#requirementsContainer");
    const postedRequirementsContainer = $("#postedRequirementsContainer");
    const requirementTitleElement = $(".card-title.mt-2.mb-3");
    const hiddenRequirementIdInput = $(".requirement-id");

    // Function to load the coordinator's requirements
    function loadCoordinatorRequirements() {
        $.ajax({
            url: "controller/requirement/retrieve-requirements.php",
            method: "GET",
            dataType: "json",
            success: function (result) {
                if (result.success) {
                    const requirements = result.requirements;

                    // Add studentId as hidden input field
                    const studentId = result.studentId;
                    const hiddenStudentIdInput = $('<input>', {
                        type: 'hidden',
                        class: 'student-id',
                        value: studentId
                    });
                    $('body').append(hiddenStudentIdInput); // Append it to the body or any other container

                    if (requirements.length > 0) {
                        // HTML for requirementsContainer (only title)
                        const requirementsHtml = requirements.map(req => {
                            const statusBadge = req.submission_status === 'not_submitted'
                                ? `<div class="badge bg-warning text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">Not Submitted</div>`
                                : `<div class="badge bg-danger text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">Rejected</div>`;
    
                            return ` 
                                <div class="card task-card task-card-hover px-3 py-2 mb-4" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px, rgba(0, 0, 0, 0.05) 0px 1px 3px; transition: transform 0.3s ease;">
                                    <div class="d-flex justify-content-between align-items-center" style="height: 100%;">
                                        <div class="d-flex flex-column justify-content-center">
                                            <div class="card-title fs-5 text-success">${req.title}</div>
                                            <div class="card-text text-muted">${req.description}</div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            ${statusBadge}
                                        </div>
                                    </div>
                                </div>
                            `;
                        }).join("");


                        // HTML for postedRequirementsContainer (full details with hidden requirement_id)
                        const postedRequirementsHtml = requirements.map(req => {
                            // Format the created_at date to show only the month and date
                            const createdAt = new Date(req.created_at);
                            const formattedDate = createdAt.toLocaleString('default', { month: 'short', day: 'numeric' });
                        
                            return `
                            <div class="card task-card mb-3 posted-requirement" data-title="${req.title}" data-requirement-id="${req.requirement_id}" 
                                style="cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); border-left: 4px solid #198754; transition: background-color 0.3s ease; padding: 8px;">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p style="margin: 0; font-weight: 400; color: #333; font-size: 1.2rem;">
                                        ${req.first_name} ${req.last_name} posted a <span style="color: #198754;">${req.title}</span>
                                    </p>
                                </div>
                                <div class="card-text" style="font-size: 1.1rem; color: #555;">
                                    ${req.description}
                                </div>
                                <div class="card-text fs-6 text-muted"">
                                    ${formattedDate}
                                </div>
                            </div>
                            `;
                        }).join("");


                        // Append the generated HTML to the respective containers
                        requirementsContainer.html(requirementsHtml);
                        postedRequirementsContainer.html(postedRequirementsHtml);

                        // Add hover effect for all the posted-requirements
                        $(".posted-requirement").hover(
                            function() {
                                if (!$(this).hasClass('active')) {
                                    $(this).css('box-shadow', 'rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px');
                                }
                            },
                            function() {
                                if (!$(this).hasClass('active')) {
                                    $(this).css('box-shadow', 'none');
                                }
                            }
                        );

                        // Add click event listener to update the title and hidden requirement ID
                        $(".posted-requirement").on("click", function() {
                            const title = $(this).data("title");
                            const requirementId = $(this).data("requirement-id");

                            requirementTitleElement.text(title);
                            hiddenRequirementIdInput.val(requirementId);

                            const fileInput = $('#fileInput');
                            fileInput.prop('disabled', false);
                            fileInput.css('box-shadow', 'rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px');

                            $(".posted-requirement").removeClass('active');
                            $(this).addClass('active');
                            $(this).css('box-shadow', 'rgba(25, 135, 84, 0.7) 0px 1px 2px 0px, rgba(25, 135, 84, 0.16) 0px 2px 6px 2px');
                        });
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

    // Load the coordinator's requirements
    window.loadCoordinatorRequirements = loadCoordinatorRequirements;

    // Call the function on document ready
    $(document).ready(function () {
        loadCoordinatorRequirements();
    });
});
