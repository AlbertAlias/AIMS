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
          const requirementsHtml = requirements.map(req => `
            <div class="requirement-item mb-3">
              <h6 class="fw-bold">${req.title}</h6>
              <p>${req.description}</p>
              <small class="text-muted">Posted on: ${new Date(req.created_at).toLocaleDateString()}</small>
              <button class="btn btn-success mt-2 btn-sm" onclick="openSubmissionModal(${req.requirement_id})">Submit Document</button>
            </div>
          `).join("");
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

// Open the modal and pass the clicked requirement_id
function openSubmissionModal(requirementId) {
  $("#requirementId").val(requirementId); // Pass ID to the modal's hidden field
  const submissionModal = new bootstrap.Modal($("#submissionModal"));
  submissionModal.show();
}