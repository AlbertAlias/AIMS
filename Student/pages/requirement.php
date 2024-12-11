<div class="container-fluid bg-light" id="requirement" style="display: none;">
    <div class="row">
        <!-- Left side container -->
        <div class="col-md-8">
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <!-- Example File Preview -->
                <div class="file-preview">
                    <div class="file-icon">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                    <div class="file-details">
                        <p class="file-name"></p>
                        <p class="file-date"></p>
                    </div>
                </div>

                
            </div>
        </div>

        <!-- Right side container with card -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-body mx-2">
                    <h5 class="card-title mt-2 mb-3">Your requirement</h5>
                    <!-- Container to display uploaded files -->
                    <div id="fileContainer" class="mb-3"></div>
                    
                    <!-- Add File Button -->
                    <label class="btn btn-white d-flex align-items-center justify-content-center border-secondary mb-3" style="cursor: pointer;">
                        <i class="fa-solid fa-plus me-2"></i> Add File
                        <input type="file" id="fileInput" style="display: none;" accept=".pdf">
                    </label>
                    
                    <button class="btn btn-success w-100 mb-2" disabled>Turn in</button>
                </div>
            </div>

            <!-- Hidden task card container -->
            <div id="taskCardContainer" style="display: none;"></div>
        </div>        
    </div>
</div>

<div id="pdfModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span id="closeModal" class="close">&times;</span>
        <iframe id="pdfViewer" src="" frameborder="0"></iframe>
    </div>
</div>