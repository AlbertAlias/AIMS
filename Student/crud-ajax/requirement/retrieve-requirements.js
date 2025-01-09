const normalizeDate = (date) => {
    const newDate = new Date(date);
    newDate.setHours(0, 0, 0, 0);
    return newDate;
};

$(document).ready(function () {
    const requirementsContainer = $("#requirementsContainer");
    const postedRequirementsContainer = $("#postedRequirementsContainer");
    const hiddenRequirementIdInput = $(".requirement-id");
    let activeRequirement = null;

    function loadCoordinatorRequirements() {
        $.ajax({
            url: "controller/requirement/retrieve-requirements.php",
            method: "GET",
            dataType: "json",
            success: function (result) {
                if (result.success) {
                    const requirements = result.requirements;
                    const studentId = result.studentId;
                    const hiddenStudentIdInput = $('<input>', {
                        type: 'hidden',
                        class: 'student-id',
                        value: studentId
                    });
                    $('body').append(hiddenStudentIdInput);

                    if (requirements.length > 0) {
                        const requirementsHtml = requirements.map(req => {
                            const statusBadge = req.submission_status === 'not_submitted'
                                ? `<div class="badge bg-warning text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">Not Submitted</div>`
                                : `<div class="badge bg-danger text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">Rejected</div>`;
    
                            return ` 
                                <div class="card task-card task-card-hover px-3 py-2 mb-2" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px, rgba(0, 0, 0, 0.05) 0px 1px 3px; transition: transform 0.3s ease;">
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

                        const postedRequirementsHtml = requirements.map(req => {
                            const deadline = normalizeDate(req.deadline);
                            const currentDate = normalizeDate(new Date());
                            const currentYear = new Date().getFullYear();
                        
                            const formattedDeadline = deadline.getFullYear() === currentYear
                                ? deadline.toLocaleString('default', { month: 'short', day: 'numeric' })
                                : deadline.toLocaleString('default', { month: 'short', day: 'numeric', year: 'numeric' });

                                const deadlineColor = deadline < currentDate
                                ? 'red'
                                : (deadline - currentDate < 7 * 24 * 60 * 60 * 1000)
                                ? 'orange'
                                : 'green';
                        
                            return `
                            <div class="col-12 mb-3">
                                <div class="card task-card posted-requirement px-2 py-2" data-title="${req.title}" data-requirement-id="${req.requirement_id}"
                                    style="cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); border-left: 4px solid #198754; transition: background-color 0.3s ease;">
                                    <div class="d-flex flex-column">
                                        <p class="mb-1" style="font-weight: 500; color: #333; font-size: 1.1rem;">
                                            ${req.first_name} ${req.last_name} posted a <span style="color: #198754;">${req.title}</span>
                                        </p>
                                        <div class="card-text mb-2" style="font-size: 1rem; color: #555;">
                                            ${req.description}
                                        </div>
                                        <div class="card-text fs-6 text-muted">
                                            <span style="color: ${deadlineColor}; font-weight: bold;">Deadline:</span> ${formattedDeadline}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `;
                        }).join("");

                        requirementsContainer.html(requirementsHtml);
                        postedRequirementsContainer.html(postedRequirementsHtml);

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

                        $(".posted-requirement").on("click", function() {
                            const title = $(this).data("title");
                            const requirementId = $(this).data("requirement-id");
                            const isFileAttached = $('#fileContainer').children().length > 0;

                            if (activeRequirement && activeRequirement !== requirementId && isFileAttached) {
                                alert('You cannot switch to another task while a file is attached.');
                                return;
                            }

                            if ($(this).hasClass('active')) {
                                if (!isFileAttached) {
                                    $('#fileInput').prop('disabled', true);
                                    $('#fileInput').closest('label').css('pointer-events', 'none');
                                    $('#chosenRequirement').text('');
                                    hiddenRequirementIdInput.val('');
                                    $(this).removeClass('active');
                                    $(this).css('box-shadow', 'none');
                                    activeRequirement = null;
                                }
                            } else {
                                $(".posted-requirement.active").removeClass('active').css('box-shadow', 'none');
                                $('#chosenRequirement').text('Requirement: ' + title);
                                hiddenRequirementIdInput.val(requirementId);

                                const fileInput = $('#fileInput');
                                fileInput.prop('disabled', false);
                                fileInput.closest('label').css('pointer-events', 'auto');
                                $(this).addClass('active');
                                $(this).css('box-shadow', 'rgba(25, 135, 84, 0.7) 0px 1px 2px 0px, rgba(25, 135, 84, 0.16) 0px 2px 6px 2px');
                                
                                activeRequirement = requirementId;
                            }

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

    window.loadCoordinatorRequirements = loadCoordinatorRequirements;

    $(document).ready(function () {
        loadCoordinatorRequirements();
    });
});