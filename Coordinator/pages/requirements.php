<div class="container-fluid p-0 m-0" id="requirements" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-4 mb-3">
            <div class="post-container">
                <div class="post-header">
                    <h5 class="border-bottom border-black pb-2 mb-2">Post a Requirement</h5>
                    <!-- Requirement Title -->
                    <input type="text" class="form-control title" id="requirementTitle" placeholder="What's on your mind, Coordinator?">
                </div>
                <div class="post-body mb-2">
                    <!-- Requirement Description -->
                    <textarea rows="3" class="form-control" id="requirementDescription" placeholder="Write something..."></textarea>
                </div>
                <div class="post-footer d-flex justify-content-between align-items-center">
                    <div class="deadline-container">
                        <!-- Deadline Input -->
                        <input type="date" class="form-control deadline-input" id="deadline" placeholder="Set a deadline">
                    </div>
                    <div>
                        <!-- Post Button -->
                        <button class="btn btn-success" id="postRequirementBtn">Post</button>
                        <button class="btn btn-primary" id="updatePostRequirementBtn" style="display: none;">Update</button>
                        <button class="btn btn-secondary" id="cancelEditRequirementsBtn">Cancel</button>
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-lg-12">
                    <div class="counts-container d-flex justify-content-around">
                        <button class="btn count-btn text-start" id="pendingCount" data-bs-toggle="modal" data-bs-target="#pendingModal">Pending: 0</button>
                    </div>
                </div>
                <div class="col-lg-12 mt-3 mb-3">
                    <div class="counts-container d-flex justify-content-around">
                        <button class="btn count-btn text-start" id="rejectedCount" data-bs-toggle="modal" data-bs-target="#rejectedModal">Rejected: 0</button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="counts-container d-flex justify-content-around">
                        <button class="btn count-btn text-start" id="completedCount" data-bs-toggle="modal" data-bs-target="#completedModal">Completed: 0</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-8" id="posted-requirements">
            <!-- Dynamically populated requirement posts will appear here -->
        </div>
    </div>
</div>

<!-- Pending Modal -->
<div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center w-100">
                <h5 class="text-center mb-0">Pending Requirements</h5>
                <div class="input-group flex-shrink-1" style="max-width: 350px;">
                    <!-- Select Dropdown -->
                    <select class="form-select form-select-sm" aria-label="Select filter" id="pendingSelectOption">
                        <option selected></option>
                    </select>
                    <!-- Search Input -->
                    <input type="text" id="pendingSearchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary btn-sm" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <!-- Pending requirements content here -->
                <div id="pendingContent">
                    <!-- This is where the pending requirements will be inserted dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Rejected Modal -->
<div class="modal fade" id="rejectedModal" tabindex="-1" aria-labelledby="rejectedModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center w-100">
                <h5 class="text-center mb-0">Rejected Requirements</h5>
                <div class="input-group flex-shrink-1" style="max-width: 350px;">
                    <!-- Select Dropdown -->
                    <select class="form-select form-select-sm" aria-label="Select filter" id="rejectedSelectOption">
                        <option selected>Filter</option>
                    </select>
                    <!-- Search Input -->
                    <input type="text" id="master-lists-searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary btn-sm" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <!-- Rejected requirements content here -->
                <div id="rejectedContent">
                    <!-- This is where the rejected requirements will be inserted dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- Completed Modal -->
<div class="modal fade" id="completedModal" tabindex="-1" aria-labelledby="completedModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center w-100">
                <h5 class="text-center mb-0">Completed Requirements</h5>
                <div class="input-group flex-shrink-1" style="max-width: 350px;">
                    <!-- Select Dropdown -->
                    <select class="form-select form-select-sm" aria-label="Select filter" id="completedSelectOption">
                        <option selected>Filter</option>
                    </select>
                    <!-- Search Input -->
                    <input type="text" id="master-lists-searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary btn-sm" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <!-- Completed requirements content here -->
                <div id="completedContent">
                    <!-- This is where the completed requirements will be inserted dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>


<!-- Remarks Modal -->
<div class="modal fade" id="remarksModal" tabindex="-1" aria-labelledby="remarksModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remarksModalLabel">Provide Remarks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea id="remarksTextarea" class="form-control" rows="5" placeholder="Enter remarks here..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="submitRemarksBtn" class="btn btn-danger">Reject</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal for PDF viewing -->
<div id="pdfModal" class="pdf-modal" style="display: none;">
    <div class="pdf-modal-content">
        <span id="closeModal" class="close">&times;</span>
        <!-- PDF viewer embedded in the modal -->
        <embed id="pdfViewer" width="100%" height="100%" type="application/pdf">
    </div>
</div>