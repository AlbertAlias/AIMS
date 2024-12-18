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
                                    <i class="fa-solid fa-ellipsis-vertical" data-bs-toggle="dropdown"></i>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <a class="dropdown-item text-success edit-requirement" href="#">
                                            <i class="fa-solid fa-pen-to-square"></i> Edit
                                        </a>
                                        <a class="dropdown-item text-danger delete-requirement" href="#" data-id="${requirement.requirement_id}">
                                            <i class="fa-solid fa-trash"></i> Delete
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

        $("#requirementTitle").val(title);
        $("#requirementDescription").val(description);
        $("#deadline").val(formatDateForInput(deadline));

        $("#postRequirementBtn").hide();
        $("#updatePostRequirementBtn").show().data("id", requirementId);
    });

    // Helper: Format date for input field
    function formatDateForInput(dateString) {
        const date = new Date(dateString);
        return date.toISOString().split("T")[0];
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

    // Load requirements on page load
    loadPostedRequirements();
});