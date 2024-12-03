<div class="container-fluid p-0 m-0" id="post-requirements" style="display: none;">
    <!-- Cards Section -->
    <div class="row">
        <div class="card shadow-sm">
            <!-- Header -->
            <div class="card-header bg-light text-dark">
                <h5>Post Requirements</h5>
            </div>

            <!-- Body -->
            <div class="card-body bg-white">
                <!-- Form to Post Requirements -->
                <form id="postRequirementsForm" method="POST">
                    <div class="mb-3">
                        <label for="requirementTitle" class="form-label">Title</label>
                        <select id="requirementTitle" name="title" class="form-select" required>
                            <option value="Medical Certificate">Medical Certificate</option>
                            <option value="Application Letter">Application Letter</option>
                            <option value="Recommendation Letter">Recommendation Letter</option>
                            <option value="Acceptance Form">Acceptance Form</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="requirementDescription" class="form-label">Description</label>
                        <textarea id="requirementDescription" name="description" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Post Requirement</button>
                    <button type="button" id="cancelPost" class="btn btn-secondary">Cancel</button>
                </form>
                <div id="responseMessage"></div> <!-- For displaying success/error messages -->
            </div>
        </div>
    </div>
</div>