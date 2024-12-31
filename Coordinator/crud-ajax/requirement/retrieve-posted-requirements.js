$(document).ready(function () {
    function loadPostedRequirements() {
        $.ajax({
            url: "controller/requirement/retrieve-posted-requirements.php",
            type: "GET",
            dataType: "json",
            success: function (data) {
                if (data.success) {
                    const requirementsContainer = $("#posted-requirements");
                    requirementsContainer.empty();

                    data.requirements.forEach(function (requirement) {
                        const formattedDeadline = formatDeadline(requirement.deadline);

                        // Check if the current date is past the deadline
                        const currentDate = new Date();
                        const deadlineDate = new Date(requirement.deadline);
                        let status = requirement.status;

                        // Automatically close the requirement if the deadline has passed
                        if (currentDate > deadlineDate && status === 'open') {
                            status = 'closed'; // Auto-close if deadline is passed
                        }

                        const requirementHTML = `
                        <div class="requirement-post mb-3" data-id="${requirement.requirement_id}">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="text-success">${requirement.title}</h6>
                                <div class="dropdown">
                                    <button class="post-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 512">
                                            <path d="M64 360a56 56 0 1 0 0 112 56 56 0 1 0 0-112zm0-160a56 56 0 1 0 0 112 56 56 0 1 0 0-112zM120 96A56 56 0 1 0 8 96a56 56 0 1 0 112 0z"/>
                                        </svg>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item text-success edit-requirement" href="#">Edit</a>
                                        <a class="dropdown-item text-danger delete-requirement" href="#" data-id="${requirement.requirement_id}">Delete</a>
                                    </ul>
                                </div>
                            </div>
                            <p>${requirement.description}</p>
                            <div class="deadline text-muted">Deadline: ${formattedDeadline}</div>

                            <!-- SVGs for open/closed lock icons -->
                            <div class="toggle-switch">
                                <input type="checkbox" 
                                    id="toggleSwitch${requirement.requirement_id}" 
                                    class="toggle-input" 
                                    ${status === 'closed' ? 'checked' : ''} 
                                    ${(status === 'closed' && currentDate > deadlineDate) ? 'disabled' : ''}>
                                <label for="toggleSwitch${requirement.requirement_id}" class="toggle-label">
                                    <svg class="open-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M144 144l0 48 160 0 0-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192l0-48C80 64.5 144.5 0 224 0s144 64.5 144 144l0 48 16 0c35.3 0 64 28.7 64 64l0 192c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 256c0-35.3 28.7-64 64-64l16 0z"/>
                                    </svg>
                                    <svg class="close-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path d="M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80l0 48c0 17.7 14.3 32 32 32s32-14.3 32-32l0-48C576 64.5 511.5 0 432 0S288 64.5 288 144l0 48L64 192c-35.3 0-64 28.7-64 64L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-192c0-35.3-28.7-64-64-64l-32 0 0-48z"/>
                                    </svg>
                                </label>
                            </div>
                        </div>`;
                        requirementsContainer.append(requirementHTML);
                    });
                }
            }
        });
    }

    // Helper: Format deadline for display
    function formatDeadline(deadline) {
        const date = new Date(deadline);
        const currentYear = new Date().getFullYear();

        const deadlineYear = date.getFullYear();
        const formattedDate = date.toLocaleDateString("en-US", { month: 'short', day: 'numeric' });

        if (currentYear !== deadlineYear) {
            return `${formattedDate}, ${deadlineYear}`;
        } else {
            return formattedDate;
        }
    }

    $(document).on("click", ".toggle-switch", function (e) {
        const checkbox = $(this).find(".toggle-input");
        
        if (checkbox.is(":disabled")) {
            // Prevent any default behavior
            e.preventDefault();
            e.stopPropagation();
    
            // Show SweetAlert notification
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'warning',
                title: 'Deadline is reached, Edit it instead.',
                showConfirmButton: false,
                timer: 3000,
                background: '#ffcccb',
                iconColor: '#d32f2f',
                color: '#721c24',
                customClass: {
                    popup: 'mt-5'
                }
            });
        }
    });
    
    $(document).on("change", ".toggle-input:not(:disabled)", function () {
        const requirementId = $(this).closest(".requirement-post").data("id");
        const isChecked = $(this).is(":checked");
        const newStatus = isChecked ? "closed" : "open";
    
        // Proceed with AJAX for status update
        $.ajax({
            url: "controller/requirement/close-open-post-requirements.php",
            type: "POST",
            data: { requirement_id: requirementId, status: newStatus },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    const successMessage = isChecked
                        ? "Requirement is now closed"
                        : "Requirement is now open";
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: successMessage,
                        showConfirmButton: false,
                        timer: 3000,
                        background: isChecked ? '#ffcccb' : '#b9f6ca', // Red for closed, green for open
                        iconColor: isChecked ? '#d32f2f' : '#2e7d32', // Adjust icon color accordingly
                        color: isChecked ? '#721c24' : '#155724', // Adjust text color accordingly
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    loadPostedRequirements();
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error!",
                        text: response.error,
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function () {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Something went wrong.",
                    confirmButtonText: "OK"
                });
            }
        });
    });
    
    // Edit functionality
    $(document).on("click", ".edit-requirement", function (e) {
        e.preventDefault();
        const requirementPost = $(this).closest(".requirement-post");
        const requirementId = requirementPost.data("id");
        const title = requirementPost.find("h6").text().trim();
        const description = requirementPost.find("p").text().trim();
        const deadline = requirementPost.find(".deadline").text().split(":")[1].trim();
    
        // Set the values in the form for editing
        $("#requirementTitle").val(title);
        $("#requirementDescription").val(description);
    
        // Correctly format the date for input[type="date"]
        $("#deadline").val(formatDateForInput(deadline));
    
        // Show the update button, hide the post button
        $("#postRequirementBtn").hide();
        $("#updatePostRequirementBtn").show().data("id", requirementId);
    });
    

    function formatDateForInput(deadline) {
        const dateParts = deadline.split(' ');  // Split the deadline into month and day, e.g., ["Dec", "27"]
        const month = dateParts[0];  // "Dec"
        const day = dateParts[1];  // "27"
        const currentYear = new Date().getFullYear();  // Get the current year, e.g., 2024
    
        // Map the month abbreviation to its numeric value
        const monthMap = {
            "Jan": "01", "Feb": "02", "Mar": "03", "Apr": "04", "May": "05", "Jun": "06",
            "Jul": "07", "Aug": "08", "Sep": "09", "Oct": "10", "Nov": "11", "Dec": "12"
        };
    
        // Check if the month abbreviation is valid
        const monthNumber = monthMap[month];
        if (!monthNumber) {
            console.error("Invalid month:", month);
            return "";  // Return empty if the month is invalid
        }
    
        // Construct the full date in YYYY-MM-DD format
        const formattedDate = `${currentYear}-${monthNumber}-${day.padStart(2, '0')}`;
        return formattedDate;
    }

    // Update functionality
    $("#updatePostRequirementBtn").on("click", function () {
        const requirementId = $(this).data("id");
        const updatedTitle = $("#requirementTitle").val();
        const updatedDescription = $("#requirementDescription").val();
        const updatedDeadline = $("#deadline").val();

        $.ajax({
            url: "controller/requirement/update-posted-requirements.php",
            type: "POST",
            data: {
                requirement_id: requirementId,
                title: updatedTitle,
                description: updatedDescription,
                deadline: updatedDeadline
            },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire("Updated!", response.message, "success");
                    resetForm();
                    loadPostedRequirements();
                } else {
                    Swal.fire("Error!", response.error, "error");
                }
            }
        });
    });

    // Delete functionality
    $(document).on("click", ".delete-requirement", function (e) {
        e.preventDefault();
        const requirementId = $(this).data("id");

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to recover this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "controller/requirement/delete-posted-requirements.php",
                    type: "POST",
                    data: { requirement_id: requirementId },
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            Swal.fire("Deleted!", response.message, "success");
                            loadPostedRequirements();
                        } else {
                            Swal.fire("Error!", response.error, "error");
                        }
                    }
                });
            }
        });
    });

    $("#cancelEditRequirementsBtn").on("click", function () {
        resetForm(); // Reset form fields and button visibility
    });

    // Reset form
    function resetForm() {
        // Clear the form fields
        $("#requirementTitle").val("");
        $("#requirementDescription").val("");
        $("#deadline").val("");

        // Show the Post button, hide the Update button
        $("#postRequirementBtn").show();
        $("#updatePostRequirementBtn").hide();
    }

    window.loadPostedRequirements = loadPostedRequirements;
    
    // Load requirements on page load
    loadPostedRequirements();
});