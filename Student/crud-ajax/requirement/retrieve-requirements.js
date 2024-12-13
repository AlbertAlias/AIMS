// $(document).ready(function () {
//     const requirementsContainer = $("#requirementsContainer");
//     const postedRequirementsContainer = $("#postedRequirementsContainer");
//     const requirementTitleElement = $(".card-title.mt-2.mb-3");
//     const hiddenRequirementIdInput = $(".requirement-id");

//     // Function to load the coordinator's requirements
//     function loadCoordinatorRequirements() {
//         $.ajax({
//             url: "controller/requirement/retrieve-requirements.php",
//             method: "GET",
//             dataType: "json",
//             success: function (result) {
//                 if (result.success) {
//                     const requirements = result.requirements;

//                     // Add studentId as hidden input field
//                     const studentId = result.studentId;
//                     const hiddenStudentIdInput = $('<input>', {
//                         type: 'hidden',
//                         class: 'student-id',
//                         value: studentId
//                     });
//                     $('body').append(hiddenStudentIdInput); // Append it to the body or any other container

//                     if (requirements.length > 0) {
//                         // HTML for requirementsContainer (only title)
//                         const requirementsHtml = requirements.map(req => {
//                             const statusBadge = req.submission_status
//                                 ? `<div class="badge bg-success text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">${req.submission_status}</div>`
//                                 : `<div class="badge bg-warning text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">Pending</div>`;
    
//                             return ` 
//                                 <div class="card task-card task-card-hover px-3 py-2 mb-4" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px, rgba(0, 0, 0, 0.05) 0px 1px 3px; transition: transform 0.3s ease;">
//                                     <div class="d-flex justify-content-between align-items-center" style="height: 100%;">
//                                         <div class="d-flex flex-column justify-content-center">
//                                             <div class="card-title fs-5 text-primary mt-2">${req.title}</div>
//                                         </div>
//                                         <div class="d-flex align-items-center">
//                                             ${statusBadge}
//                                         </div>
//                                     </div>
//                                 </div>
//                             `;
//                         }).join("");


//                         // HTML for postedRequirementsContainer (full details with hidden requirement_id)
//                         const postedRequirementsHtml = requirements.map(req => {
//                             // Format the created_at date to show only the month and date
//                             const createdAt = new Date(req.created_at);
//                             const formattedDate = createdAt.toLocaleString('default', { month: 'short', day: 'numeric' });
                        
//                             return `
//                                 <div 
//                                     class="card task-card px-3 py-2 mb-4 posted-requirement" data-title="${req.title}" data-requirement-id="${req.requirement_id}" 
//                                     style="cursor: pointer;">
//                                     <div class="d-flex align-items-center" style="height: 100%;">
//                                         <i class="fa-solid fa-clipboard-list me-3" style="font-size: 2rem;"></i>
//                                         <div class="d-flex flex-column justify-content-center mt-2">
//                                             <h5 class="card-title mb-1">${req.first_name} ${req.last_name} posted a new requirement: ${req.title}</h5>
//                                             <div class="card-text fs-7 mb-2 text-muted">${formattedDate}</div>
//                                         </div>
//                                     </div>
//                                 </div>
//                             `;
//                         }).join("");


//                         // Append the generated HTML to the respective containers
//                         requirementsContainer.html(requirementsHtml);
//                         postedRequirementsContainer.html(postedRequirementsHtml);

//                         // Add hover effect for all the posted-requirements
//                         $(".posted-requirement").hover(
//                             function() {
//                                 // On hover, apply box-shadow effect, but only if it's not active
//                                 if (!$(this).hasClass('active')) {
//                                     $(this).css('box-shadow', 'rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px');
//                                 }
//                             },
//                             function() {
//                                 // On mouse out, remove the box-shadow effect, but keep it if active
//                                 if (!$(this).hasClass('active')) {
//                                     $(this).css('box-shadow', 'none');
//                                 }
//                             }
//                         );

//                         // Add click event listener to update the title and hidden requirement ID
//                         $(".posted-requirement").on("click", function () {
//                             // Reset all previously clicked items
//                             $(".posted-requirement").css('box-shadow', 'none'); // Remove shadow from all
//                             $('#fileInput').prop('disabled', true).css('box-shadow', 'none'); // Disable the file input
                            
//                             // Get the title and requirement ID of the clicked requirement
//                             const title = $(this).data("title");
//                             const requirementId = $(this).data("requirement-id");

//                             // Update the card title
//                             requirementTitleElement.text(title);

//                             // Update the hidden requirement ID input
//                             hiddenRequirementIdInput.val(requirementId);

//                             // Enable the file input and apply the box-shadow only to this clicked requirement
//                             const fileInput = $('#fileInput');
//                             fileInput.prop('disabled', false); // Enable file input
//                             fileInput.css('box-shadow', 'rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px'); // Apply shadow to file input

//                             // Add box-shadow to the clicked requirement and mark it as active
//                             $(".posted-requirement").removeClass('active'); // Remove active class from all
//                             $(this).addClass('active'); // Mark this requirement as active
//                             $(this).css('box-shadow', 'rgba(25, 135, 84, 0.7) 0px 1px 2px 0px, rgba(25, 135, 84, 0.16) 0px 2px 6px 2px');
//                         });
//                     } else {
//                         requirementsContainer.html("<p class='text-muted'>No requirements posted by your coordinator.</p>");
//                         postedRequirementsContainer.html("<p class='text-muted'>No requirements posted by your coordinator.</p>");
//                     }
//                 } else {
//                     requirementsContainer.html(`<p class='text-danger'>Error: ${result.error}</p>`);
//                     postedRequirementsContainer.html(`<p class='text-danger'>Error: ${result.error}</p>`);
//                 }
//             },
//             error: function (xhr, status, error) {
//                 console.error("Error fetching requirements:", error);
//                 requirementsContainer.html("<p class='text-danger'>Failed to load requirements. Please try again later.</p>");
//                 postedRequirementsContainer.html("<p class='text-danger'>Failed to load requirements. Please try again later.</p>");
//             }
//         });
//     }

//     // Load the coordinator's requirements
//     loadCoordinatorRequirements();
// });












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
                                            <div class="card-title fs-5 text-primary mt-2">${req.title}</div>
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
                                <div 
                                    class="card task-card px-3 py-2 mb-4 posted-requirement" data-title="${req.title}" data-requirement-id="${req.requirement_id}" 
                                    style="cursor: pointer;">
                                    <div class="d-flex align-items-center" style="height: 100%;">
                                        <i class="fa-solid fa-clipboard-list me-3" style="font-size: 2rem;"></i>
                                        <div class="d-flex flex-column justify-content-center mt-2">
                                            <h5 class="card-title mb-1">${req.first_name} ${req.last_name} posted a new requirement: ${req.title}</h5>
                                            <div class="card-text fs-7 mb-2 text-muted">${formattedDate}</div>
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
    loadCoordinatorRequirements();
});
