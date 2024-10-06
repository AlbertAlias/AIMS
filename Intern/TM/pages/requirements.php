<div class="container-fluid bg-light p-0 m-0" id="requirements" style="display: none;">
    <h3>Submit Requirements</h3>
    <form id="requirements-form" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="intern-id" class="form-label">Intern ID</label>
            <input type="text" class="form-control" id="intern-id" name="intern_id" placeholder="Enter Intern ID" required>
        </div>
        <div class="mb-3">
            <label for="resume" class="form-label">Resume</label>
            <input type="file" class="form-control" id="resume" name="resume" required>
        </div>
        <div class="mb-3">
            <label for="application-letter" class="form-label">Application Letter</label>
            <input type="file" class="form-control" id="application-letter" name="application_letter" required>
        </div>
        <div class="mb-3">
            <label for="medical-certification" class="form-label">Medical Certification</label>
            <input type="file" class="form-control" id="medical-certification" name="medical_certification" required>
        </div>
        <div class="mb-3">
            <label for="certification-of-completion" class="form-label">Certification of Completion</label>
            <input type="file" class="form-control" id="certification-of-completion" name="certification_of_completion" required>
        </div>
        <div class="mb-3">
            <label for="memorandum-of-agreement" class="form-label">Memorandum of Agreement</label>
            <input type="file" class="form-control" id="memorandum-of-agreement" name="memorandum_of_agreement" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit Requirements</button>
    </form>
    <div id="response-message" class="mt-3"></div>
</div>