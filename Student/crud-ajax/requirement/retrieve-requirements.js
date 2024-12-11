$(document).ready(function () {
    const requirementsContainer = $("#requirementsContainer");

    $.ajax({
        url: "controller/requirement/retrieve-requirements.php",
        method: "GET",
        dataType: "json",
        success: function (result) {
            if (result.success) {
                const requirements = result.requirements;

                if (requirements.length > 0) {
                    // Improved and more visually appealing HTML for each requirement
                    const requirementsHtml = requirements.map(req => `
                        <div class="card task-card px-3 py-3 mb-4" style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px, rgba(0, 0, 0, 0.05) 0px 1px 3px; transition: transform 0.3s ease;">
                            <div class="d-flex justify-content-between align-items-center" style="height: 100%;">
                                <div class="d-flex flex-column justify-content-center">
                                    <div class="card-title fs-5 text-primary fw-bold mb-2">${req.title}</div>
                                    <div class="card-text fs-7 mb-2 text-muted">${req.description}</div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="badge bg-warning text-white py-2 px-3" style="font-size: 0.875rem; border-radius: 15px;">Pending</div>
                                </div>
                            </div>
                        </div>
                    `).join("");
                    // Append the generated HTML to the requirements container
                    requirementsContainer.html(requirementsHtml);
                } else {
                    requirementsContainer.html("<p class='text-muted'>No requirements posted by your coordinator.</p>");
                }
            } else {
                requirementsContainer.html(`<p class='text-danger'>Error: ${result.error}</p>`);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error fetching requirements:", error);
            requirementsContainer.html("<p class='text-danger'>Failed to load requirements. Please try again later.</p>");
        }
    });
});
