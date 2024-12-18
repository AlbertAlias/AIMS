<div class="container-fluid bg-light" id="requirement" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-8">
            <h4 class="border-bottom border-secondary pb-2 mb-2">Requirements</h4>
            <div id="postedRequirementsContainer" class="row"></div>
        </div>

        <div class="col-12 col-md-12 col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title mt-2 mb-3">Upload requirement</h5>
                    <input type="hidden" class="requirement-id" value="${req.requirement_id}">
                    <input type="hidden" class="student-id" value="${user.student_id}">

                    <div id="fileContainer" class="mb-3"></div>
                    
                    <label class="btn btn-white d-flex align-items-center justify-content-center border-secondary mb-3" style="cursor: pointer;">
                        <i class="fa-solid fa-plus me-2"></i> Add File
                        <input type="file" id="fileInput" style="display: none;" accept=".pdf" disabled>
                    </label>
                    
                    <button id="turnInButton" class="btn btn-success w-100 mb-2" disabled>Turn in</button>
                </div>
            </div>
            <div id="taskCardContainer" style="display: none;"></div>
        </div>
    </div>
</div>
<!-- Albert -->
<!-- <div id="pdfModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <iframe id="pdfViewer" src="" frameborder="0"></iframe>
    </div>
</div> -->

<!-- Bryan -->

<!-- Modal for preview -->
<div id="pdfModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); align-items: center; justify-content: center;">
    <div style="width: 80%; height: 80%; background: #fff; padding: 10px; position: relative;">
        <button id="closeModal" style="position: absolute; top: 10px; right: 10px; background: #f44336; color: white; border: none; padding: 5px 10px; cursor: pointer;">Close</button>
        <iframe id="pdfViewer" style="width: 100%; height: 100%; border: none;"></iframe>
    </div>
</div>

<!-- Bryan -->
<!-- Modal for PDF Viewer -->
<!-- <div id="pdfModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); justify-content: center; align-items: center;">
    <div style="position: relative; background: #fff; padding: 20px; border-radius: 8px; max-width: 80%; height: 80%;">
        <button id="closeModal" style="position: absolute; top: 10px; right: 10px; font-size: 1.2rem; background: none; border: none; cursor: pointer;">✖</button>
        <iframe id="pdfViewer" style="width: 100%; height: 100%;" frameborder="0"></iframe>
    </div>
</div> -->

<!-- Bryan -->


<!-- Modal for previewing the PDF -->
<!-- <div id="pdfModal" class="modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5); align-items: center; justify-content: center;">
    <div class="modal-content" style="width: 80%; height: 80%; background-color: #fff; position: relative; padding: 10px; border-radius: 8px;">
        <iframe id="pdfViewer" style="width: 100%; height: 90%;" frameborder="0"></iframe>
        <button id="closeModal" style="position: absolute; top: 10px; right: 10px; font-size: 1.2rem; background-color: transparent; border: none; cursor: pointer;">✖</button>
    </div>
</div> -->