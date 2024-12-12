<div class="container-fluid bg-light" id="requirement" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-8">
            <div id="postedRequirementsContainer" class="row"></div>
        </div>

        <div class="col-12 col-md-12 col-lg-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title mt-2 mb-3">Your requirement</h5>

                    <div id="fileContainer" class="mb-3"></div>
                    
                    <label class="btn btn-white d-flex align-items-center justify-content-center border-secondary mb-3" style="cursor: pointer;">
                        <i class="fa-solid fa-plus me-2"></i> Add File
                        <input type="file" id="fileInput" style="display: none;" accept=".pdf">
                    </label>
                    
                    <button id="turnInButton" class="btn btn-success w-100 mb-2" disabled>Turn in</button>
                </div>
            </div>
            <div id="taskCardContainer" style="display: none;"></div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-8">
            <div class="approved-file-container"></div>
        </div>
    </div>
</div>

<div id="pdfModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <iframe id="pdfViewer" src="" frameborder="0"></iframe>
    </div>
</div>