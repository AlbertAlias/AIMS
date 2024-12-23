<!-- <div class="container-fluid bg-light" id="weeklyreport" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-8">
            <h4 class="border-bottom border-secondary pb-2 mb-2">Weekly Reports</h4>
            <div id="weeklypostedRequirementsContainer" class="row"></div>
        </div>

        <div class="col-12 col-md-12 col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h class="mt-2 mb-3">Upload Weekly Report</h>
                    <input type="hidden" class="requirement-id" value="${req.requirement_id}">
                    <input type="hidden" class="student-id">
                    <form id="weeklyReportForm" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="week_start" class="form-label">Week Start</label>
                            <input type="date" class="form-control" name="week_start" id="week_start" required>
                        </div>
                        <div class="mb-3">
                            <label for="week_end" class="form-label">Week End</label>
                            <input type="date" class="form-control" name="week_end" id="week_end" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Attach File/Picture (PDF, JPG, PNG)</label>
                            <input type="file" class="form-control" name="file" id="file" accept=".png, .jpg, .jpeg, .pdf">
                            <div id="filePreview" style="margin-top: 15px;"></div>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Submit Report</button>
                    </form>
                    End of Weekly Report Submission Form
                </div>
            </div>
            <div id="taskCardContainer" style="display: none;"></div>
        </div>
    </div>
</div> -->

<div class="container-fluid bg-light" id="weeklyreport" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-8">
            <h4 class="border-bottom border-secondary pb-2 mb-2">Weekly Reports</h4>
            <div id="weeklypostedRequirementsContainer" class="row"></div>
        </div>

        <div class="col-12 col-md-12 col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h class="mt-2 mb-3">Upload Weekly Report</h>
                    <input type="hidden" class="student-id">
                    <form id="weeklyReportForm" method="POST" enctype="multipart/form-data">
                        <!-- New Title Field -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Report Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="week_start" class="form-label">Week Start</label>
                            <input type="date" class="form-control" name="week_start" id="week_start" required>
                        </div>
                        <div class="mb-3">
                            <label for="week_end" class="form-label">Week End</label>
                            <input type="date" class="form-control" name="week_end" id="week_end" required>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Attach File/Picture (PDF, JPG, PNG)</label>
                            <input type="file" class="form-control" name="file" id="file" accept=".png, .jpg, .jpeg, .pdf">
                            <div id="filePreview" style="margin-top: 15px;"></div>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Submit Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for preview -->
<!-- <div id="pdfModal" class="modal" style="display: none;">
    <div class="modal-content">
    <span id="closeModal" class="close">&times;</span>
        <iframe id="pdfViewer" src="" frameborder="0"></iframe>
    </div>
</div> -->

<!-- Modal for PDF Viewer -->
<!-- <div id="pdfModal" class="modal">
    <div class="modal-content">
        <iframe id="pdfViewer" width="100%" height="500px" style="border: none;"></iframe>
        <button id="closeModal" class="btn btn-danger mt-3">Close</button>
    </div>
</div> -->

<!-- Modal for preview -->
<div id="filePreviewModal" class="reportsModal" style="display: none;">
    <div class="reports-modal-content">
        <span id="closeModal" class="close">&times;</span>
        <div id="modalContentContainer"></div>
    </div>
</div>