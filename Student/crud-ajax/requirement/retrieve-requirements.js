$(document).ready(function () {
    const requirementsContainer = $("#requirementsContainer");
    const postedRequirementsContainer = $("#postedRequirementsContainer");
    const requirementTitleElement = $(".card-title");
    const hiddenRequirementIdInput = $(".requirement-id");
    let activeRequirement = null;

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
                                <div class="col-12 col-md-6 col-lg-4 mb-4">
                                    <div class="card task-card px-3 py-2 h-100" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px, rgba(0, 0, 0, 0.05) 0px 1px 3px; transition: transform 0.3s ease;">
                                        <div class="d-flex flex-column justify-content-between h-100">
                                            <div>
                                                <div class="card-title fs-5 text-success">${req.title}</div>
                                                <div class="card-text text-muted">${req.description}</div>
                                            </div>
                                            <div class="d-flex justify-content-end align-items-center mt-3">
                                                ${statusBadge}
                                            </div>
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
                                <div class="col-12 mb-3">
                                    <div class="card task-card posted-requirement p-3 h-100" data-title="${req.title}" data-requirement-id="${req.requirement_id}"
                                        style="cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); border-left: 4px solid #198754; transition: background-color 0.3s ease;">
                                        <div class="d-flex flex-column">
                                            <p class="mb-1" style="font-weight: 500; color: #333; font-size: 1.2rem;">
                                                ${req.first_name} ${req.last_name} posted a <span style="color: #198754;">${req.title}</span>
                                            </p>
                                            <div class="card-text mb-2" style="font-size: 1rem; color: #555;">
                                                ${req.description}
                                            </div>
                                            <div class="card-text fs-6 text-muted">
                                                ${formattedDate}
                                            </div>
                                        </div>
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

                            // Check if a file is attached to the requirement
                            const isFileAttached = $('#fileContainer').children().length > 0;

                            // If a requirement is already active and there's a file attached, don't allow switching
                            if (activeRequirement && activeRequirement !== requirementId && isFileAttached) {
                                alert('You cannot switch to another task while a file is attached.');
                                return; // Exit without changing the active card
                            }

                            // Proceed to toggle the active state of the card
                            if ($(this).hasClass('active')) {
                                // If active, reset everything (unless a file is attached)
                                if (!isFileAttached) {
                                    // Reset the file input to be disabled again
                                    $('#fileInput').prop('disabled', true);
                                    $('#fileInput').closest('label').css('pointer-events', 'none');

                                    // Reset the chosen requirement text
                                    $('#chosenRequirement').text(''); // Reset text
                                    hiddenRequirementIdInput.val('');
                                    $(this).removeClass('active');
                                    $(this).css('box-shadow', 'none');
                                    activeRequirement = null; // Reset active requirement
                                }
                            } else {
                                // If not active, deactivate the previous active card
                                $(".posted-requirement.active").removeClass('active').css('box-shadow', 'none');
                                
                                // Activate the new clicked card
                                $('#chosenRequirement').text('Requirement: ' + title); // Update chosen requirement text
                                hiddenRequirementIdInput.val(requirementId);

                                const fileInput = $('#fileInput');
                                fileInput.prop('disabled', false); // Enable file input for this task
                                fileInput.closest('label').css('pointer-events', 'auto'); // Enable the label button

                                $(this).addClass('active');
                                $(this).css('box-shadow', 'rgba(25, 135, 84, 0.7) 0px 1px 2px 0px, rgba(25, 135, 84, 0.16) 0px 2px 6px 2px');
                                
                                activeRequirement = requirementId; // Mark this requirement as active
                            }

                            // Disable other task cards when one is active
                            if (activeRequirement) {
                                $(".posted-requirement").each(function() {
                                    const requirementId = $(this).data("requirement-id");
                                    if (requirementId !== activeRequirement) {
                                        $(this).css('pointer-events', 'none').css('opacity', '0.7');
                                    }
                                });
                            } else {
                                $(".posted-requirement").css('pointer-events', 'auto').css('opacity', '1');
                            }
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