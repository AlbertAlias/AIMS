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
                        const formattedDeadline = formatDate(requirement.deadline);
                        const formattedCreatedAt = formatDate(requirement.created_at);
                        const isDeadlinePassed = new Date(requirement.deadline) < new Date();

                        const requirementHTML = `
                        <div class="requirement-post mb-3" data-id="${requirement.requirement_id}">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6>${requirement.title}</h6>
                                <div class="dropdown">
                                    <button class="post-dropdown" type="button" data-bs-toggle="dropdown">
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
                            <div class="d-flex">
                                <div class="created-at text-muted">Posted: ${formattedCreatedAt}</div>
                                <div class="ms-1 deadline text-muted">/ Deadline: ${formattedDeadline}</div>
                            </div>
                            <div class="toggle-switch">
                                <input type="checkbox" id="toggleSwitch${requirement.requirement_id}" class="toggle-input" 
                                    ${requirement.status === 'closed' ? 'checked' : ''} 
                                    ${isDeadlinePassed ? 'disabled' : ''} 
                                    data-deadline="${requirement.deadline}">
                                <label for="toggleSwitch${requirement.requirement_id}" class="toggle-label">
                                    <svg class="open-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M144 144l0 48 160 0 0-48c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192l0-48C80 64.5 144.5 0 224 0s144 64.5 144 144l0 48 16 0c35.3 0 64 28.7 64 64l0 192c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 256c0-35.3 28.7-64 64-64l16 0z"/>
                                    </svg>
                                    <svg class="close-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path d="M352 144c0-44.2 35.8-80 80-80s80 35.8 80 80l0 48c0 17.7 14.3 32 32 32s32-14.3 32-32l0-48C576 64.5 511.5 0 432 0S288 64.5 288 144l0 48L64 192c-35.3 0-64 28.7-64 64L0 448c0 35.3-28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-192c0-35.3-28.7-64-64-64l-32 0 0-48z"/>
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

    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString("en-US", { month: 'short', day: 'numeric', year: 'numeric' });
    }

    $(document).on("click", ".toggle-switch", function (e) {
        const checkbox = $(this).find(".toggle-input");
        const deadline = new Date(checkbox.data("deadline"));
        const now = new Date();
    
        if (deadline < now) {
            e.preventDefault();
            Swal.fire({
                toast: true,
                position: 'top-right',
                icon: 'warning',
                title: 'Deadline has passed. You can edit it instead.',
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
        const newStatus = $(this).is(":checked") ? "closed" : "open";

        $.ajax({
            url: "controller/requirement/close-open-post-requirements.php",
            type: "POST",
            data: { requirement_id: requirementId, status: newStatus },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: `Requirement is now ${newStatus}.`,
                        showConfirmButton: false,
                        timer: 3000,
                        background: newStatus === 'closed' ? '#ffcccb' : '#b9f6ca',
                        iconColor: newStatus === 'closed' ? '#d32f2f' : '#2e7d32',
                        color: newStatus === 'closed' ? '#721c24' : '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    loadPostedRequirements();
                } else {
                    Swal.fire("Error!", response.error, "error");
                }
            },
            error: function () {
                Swal.fire("Error!", "Something went wrong.", "error");
            }
        });
    });

    $(document).on("click", ".edit-requirement", function (e) {
        e.preventDefault();
        const requirement = $(this).closest(".requirement-post");
        $("#requirementTitle").val(requirement.find("h6").text().trim());
        $("#requirementDescription").val(requirement.find("p").text().trim());
        $("#deadline").val(new Date(requirement.find(".deadline").text().split(":")[1].trim()).toISOString().split("T")[0]);
        $("#postRequirementBtn").hide();
        $("#updatePostRequirementBtn").show().data("id", requirement.data("id"));
    });

    $("#updatePostRequirementBtn").on("click", function () {
        const requirementId = $(this).data("id");
        const data = {
            requirement_id: requirementId,
            title: $("#requirementTitle").val(),
            description: $("#requirementDescription").val(),
            deadline: $("#deadline").val()
        };

        $.ajax({
            url: "controller/requirement/update-posted-requirements.php",
            type: "POST",
            data,
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    Swal.fire({
                        toast: true,
                        position: 'top-right',
                        icon: 'success',
                        title: 'Requirement updated successfully!',
                        showConfirmButton: false,
                        timer: 3000,
                        background: '#b9f6ca',
                        iconColor: '#2e7d32',
                        color: '#155724',
                        customClass: {
                            popup: 'mt-5'
                        }
                    });
                    resetForm();
                    loadPostedRequirements();
                } else {
                    Swal.fire("Error!", response.error, "error");
                }
            },
            error: function () {
                Swal.fire("Error!", "Something went wrong.", "error");
            }
        });
    });

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
                            Swal.fire({
                                toast: true,
                                position: 'top-right',
                                icon: 'success',
                                title: 'Requirement deleted successfully!',
                                showConfirmButton: false,
                                timer: 3000,
                                background: '#b9f6ca',
                                iconColor: '#2e7d32',
                                color: '#155724',
                                customClass: {
                                    popup: 'mt-5'
                                }
                            });
                            loadPostedRequirements();
                        } else {
                            Swal.fire("Error!", response.error, "error");
                        }
                    },
                    error: function () {
                        Swal.fire("Error!", "Something went wrong.", "error");
                    }
                });
            }
        });
    });

    $("#cancelEditRequirementsBtn").on("click", resetForm);

    function resetForm() {
        $("#requirementTitle, #requirementDescription, #deadline").val("");
        $("#postRequirementBtn").show();
        $("#updatePostRequirementBtn").hide();
    }
    
    window.loadPostedRequirements = loadPostedRequirements;

    loadPostedRequirements();
});
