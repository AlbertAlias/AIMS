document.addEventListener("DOMContentLoaded", async function () {
    const requirementsContainer = document.getElementById("requirementsContainer");
  
    try {
      const response = await fetch("controller/fetch_requirements.php");
      const result = await response.json();
  
      if (result.success) {
        const requirements = result.requirements;
  
        if (requirements.length > 0) {
          requirementsContainer.innerHTML = requirements.map(req => `
            <div class="requirement-item mb-3">
              <h6 class="fw-bold">${req.title}</h6>
              <p>${req.description}</p>
              <small class="text-muted">Posted on: ${new Date(req.created_at).toLocaleDateString()}</small>
              <button class="btn btn-success mt-2 btn-sm" onclick="openSubmissionModal(${req.requirement_id})">Submit Document</button>
            </div>
          `).join("");
        } else {
          requirementsContainer.innerHTML = "<p class='text-muted'>No requirements posted by your coordinator.</p>";
        }
      } else {
        requirementsContainer.innerHTML = `<p class='text-danger'>Error: ${result.error}</p>`;
      }
    } catch (error) {
      console.error("Error fetching requirements:", error);
      requirementsContainer.innerHTML = "<p class='text-danger'>Failed to load requirements. Please try again later.</p>";
    }
  });
  
  // Open the modal and pass the clicked requirement_id
  function openSubmissionModal(requirementId) {
    document.getElementById("requirementId").value = requirementId; // Pass ID to the modal's hidden field
    const submissionModal = new bootstrap.Modal(document.getElementById("submissionModal"));
    submissionModal.show();
  }
  