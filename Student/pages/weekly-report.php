<div class="container-fluid bg-light p-0 m-0" id="weeklyreport" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-4">
            <div class="card mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <div class="card-body">
                    <h5 class="mb-2">Upload Weekly Report</h5>
                    <input type="hidden" class="student-id">
                    <form id="weeklyReportForm" method="POST" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="title" class="form-label">Report Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="mb-2">
                            <label for="week_start" class="form-label">Week Start</label>
                            <input type="date" class="form-control" name="week_start" id="week_start" required>
                        </div>
                        <div class="mb-2">
                            <label for="week_end" class="form-label">Week End</label>
                            <input type="date" class="form-control" name="week_end" id="week_end" required>
                        </div>
                        <div class="mb-2">
                            <label for="file" class="form-label">Attach File/Picture (PDF, JPG, PNG)</label>
                            <input type="file" class="form-control" name="file" id="file" accept=".png, .jpg, .jpeg, .pdf">
                            <div id="filePreview" style="margin-top: 15px;"></div>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Submit Report</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-8">
            <h4 class="border-bottom border-secondary pb-2 mb-2">Weekly Reports</h4>
            <div id="weeklypostedRequirementsContainer" class="row"></div>
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
<div id="weekly-reports-modal" class="reportsModal" style="display: none;">
    <div class="weekly-reports-content">
        <span id="closeModal" class="close">&times;</span>
        <div id="modalContentContainer"></div>
    </div>
</div>