document.addEventListener("DOMContentLoaded", async function () {
  
    // Fetch and display coordinator's posted requirements
    async function fetchRequirements() {
      const response = await fetch('controller/fetch_requirements.php');
      const requirements = await response.json();
  
      const requirementListDiv = document.getElementById("requirementList");
      requirementListDiv.innerHTML = '';
  
      if (requirements.length) {
        requirements.forEach(req => {
          const div = document.createElement('div');
          div.classList.add('card', 'mb-2');
          div.innerHTML = `
            <div class="card-body">
              <h5 class="card-title">${req.title}</h5>
              <p class="card-text">${req.description}</p>
              <button class="btn btn-success" onclick="showSubmissionModal(${req.id})">Submit Documents</button>
            </div>
          `;
          requirementListDiv.appendChild(div);
        });
      } else {
        requirementListDiv.innerHTML = `<p>No requirements found.</p>`;
      }
    }
  
    fetchRequirements();
  
    // Show submission modal
    window.showSubmissionModal = function (requirementId) {
      document.getElementById('requirementId').value = requirementId;
      const modal = new bootstrap.Modal(document.getElementById("submissionModal"));
      modal.show();
    };
  
    // Handle submission
    const submissionForm = document.getElementById("submissionForm");
    submissionForm.addEventListener('submit', async function (e) {
      e.preventDefault();
      const requirementId = document.getElementById('requirementId').value;
      const documents = document.getElementById('documents').value;
  
      const response = await fetch('controller/submit_documents.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `requirementId=${requirementId}&documents=${encodeURIComponent(documents)}`
      });
  
      const result = await response.json();
      if (result.success) {
        Swal.fire({
          icon: "success",
          title: "Documents Submitted!",
          text: "Your submission has been received.",
        });
        submissionForm.reset();
        const modal = bootstrap.Modal.getInstance(document.getElementById("submissionModal"));
        modal.hide();
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: result.error,
        });
      }
    });
  });
  