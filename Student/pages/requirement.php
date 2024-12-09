<div class="container-fluid bg-light p-4" id="requirement">
  <div class="row g-4">
    <!-- Left container for general info -->
    <div class="col-12 col-md-6">
      <div class="bg-white rounded shadow-sm p-4 d-flex flex-column" style="min-height: 220px;">
        <h5 class="text-dark fw-bold border-bottom pb-2 mb-3">Department Information</h5>
        <div class="mb-3 position-relative">
          <p>No department information available at the moment.</p>
        </div>
      </div>
    </div>

    <!-- Right container for Coordinator's posted requirements -->
    <div class="col-12 col-md-6">
      <div class="bg-white rounded shadow-sm p-4 d-flex flex-column" style="min-height: 220px;">
        <h5 class="text-dark fw-bold border-bottom pb-2 mb-3">Coordinator's Posted Requirements</h5>
        <div id="requirementsContainer" class="text-muted">
          <!-- Dynamically populated requirements will be inserted here -->
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Submission Modal -->
<div class="modal fade" id="submissionModal" tabindex="-1" aria-labelledby="submissionModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="submissionModalLabel">Submit Required Documents</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="submissionForm" action="submit_documents.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="requirementId" name="requirement_id" value="">
          <div class="mb-3">
            <label for="documents" class="form-label">Upload Documents</label>
            <input type="file" class="form-control" id="documents" name="file" required>
            <small class="text-muted">You can upload multiple files (e.g., PDFs, Word Documents).</small>
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
