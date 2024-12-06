<div class="container mt-4">
  <h3>Coordinator's Posted Requirements</h3>
  <div id="requirementList">
    <!-- Dynamically populated list of requirements here -->
  </div>
</div>

    <div class="modal fade" id="submissionModal" tabindex="-1" aria-labelledby="submissionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="submissionModalLabel">Submit Required Documents</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                    <div class="modal-body">
                        <form id="submissionForm">
                            <input type="hidden" id="requirementId" name="requirementId">
                            <label for="documents" class="form-label">Documents (comma-separated)</label>
                            <input type="text" class="form-control" id="documents" name="documents" placeholder="e.g., Document1, Document2" required>
                            <button type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
