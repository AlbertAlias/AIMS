$(document).ready(function () {
    // Function to fetch and display posted requirements
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
                                        <a class="dropdown-item text-success edit-requirement" href="#">
                                            <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                                            </svg> Edit
                                        </a>
                                        <a class="dropdown-item text-danger delete-requirement" href="#" data-id="${requirement.requirement_id}">
                                            <svg class="dropdown-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z"/>
                                            </svg> Delete
                                        </a>
                                    </ul>
                                </div>
                            </div>
                            <p>${requirement.description}</p>
                            <div class="deadline text-muted">Deadline: ${formattedDeadline}</div>
                            <div class="toggle-switch">
                                <input type="checkbox" id="toggleSwitch${requirement.requirement_id}" class="toggle-input" ${requirement.status === 'closed' ? 'checked' : ''}>
                                <label for="toggleSwitch${requirement.requirement_id}" class="toggle-label">
                                    <i class="fa-solid ${requirement.status === 'closed' ? 'fa-lock' : 'fa-lock-open'} open-icon"></i>
                                    <i class="fa-solid ${requirement.status === 'closed' ? 'fa-lock' : 'fa-lock-open'} close-icon"></i>
                                </label>
                            </div>

                            <div class="toggle-switch">
                                <input type="checkbox" id="toggleSwitch${requirement.requirement_id}" class="toggle-input" ${requirement.status === 'closed' ? 'checked' : ''}>
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

    // Helper: Format deadline for display (Month and Day only)
    function formatDeadline(deadline) {
        const date = new Date(deadline);
        return date.toLocaleDateString("en-US", { month: 'short', day: 'numeric' });
    }

    $(document).on("change", ".toggle-input", function () {
        const requirementId = $(this).closest(".requirement-post").data("id");
        const isChecked = $(this).is(":checked");
        const newStatus = isChecked ? "closed" : "open";
    
        $.ajax({
            url: "controller/requirement/close-open-post-requirements.php",
            type: "POST",
            data: { requirement_id: requirementId, status: newStatus },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire("Success!", response.message, "success");
                    loadPostedRequirements();
                } else {
                    Swal.fire("Error!", response.error, "error");
                }
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