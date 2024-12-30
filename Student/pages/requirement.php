<div class="container-fluid bg-light" id="requirement" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-4 m-0 p-0">
            <div class="card shadow-sm mb-3 me-4">
                <div class="card-body">
                    <h5 class="card-title mb-3">Upload requirement</h5>
                    <input type="hidden" class="requirement-id" value="${req.requirement_id}">
                    <input type="hidden" class="student-id" value="${user.student_id}">

                    <p id="chosenRequirement" class="mb-3" style="font-size: 1.1rem; color: #333;"></p>
                    <div id="fileContainer" class="mb-3"></div>
                    
                    <label class="btn btn-white d-flex align-items-center justify-content-center border-secondary mb-3" style="cursor: pointer;">
                        <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                            <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                        </svg> Add File
                        <input type="file" id="fileInput" style="display: none;" accept=".pdf" disabled>
                    </label>
                    
                    <button id="turnInButton" class="btn btn-success w-100 mb-2" disabled>Turn in</button>
                </div>
            </div>
            <div id="taskCardContainer" style="display: none;"></div>
        </div>

        <div class="col-12 col-md-12 col-lg-8 m-0 p-0">
            <h4 class="border-bottom border-secondary pb-2 mb-2">Requirements</h4>
            <div id="postedRequirementsContainer" class="row"></div>
        </div>
    </div>
</div>

<!-- Modal for preview -->
<div id="pdfModal" class="modal" style="display: none;">
    <div class="pdf-modal-content">
    <span id="closeModal" class="close">&times;</span>
        <iframe id="pdfViewer" src="" frameborder="0"></iframe>
    </div>
</div>