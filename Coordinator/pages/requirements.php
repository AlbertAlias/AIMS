<div class="container-fluid p-0 m-0" id="requirements" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-4 mb-2">
            <div class="post-container">
                <div class="post-header">
                    <h5 class="border-bottom border-black pb-2 mb-2">Post a Requirement</h5>
                    <input type="text" class="form-control title" id="requirementTitle" placeholder="What's on your mind, Coordinator?">
                </div>
                <div class="post-body mb-2">
                    <textarea rows="3" class="form-control" id="requirementDescription" placeholder="Write something..."></textarea>
                </div>
                <div class="post-footer d-flex justify-content-between align-items-center">
                    <div class="deadline-container">
                        <input type="text" class="form-control deadline-input" id="deadline" placeholder="Set a deadline" onfocus="(this.type='date')" onblur="(this.type='text')">
                    </div>
                    <div>
                        <button class="btn btn-md btn-success" id="postRequirementBtn">Post</button>
                        <button class="btn btn-md btn-primary" id="updatePostRequirementBtn" style="display: none;">Update</button>
                        <button class="btn btn-md btn-secondary" id="cancelEditRequirementsBtn">Cancel</button>
                    </div>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-lg-12">
                    <a class="requirements-container" id="pendingContainer" data-bs-toggle="modal" data-bs-target="#pendingModal">
                        Pending: 0
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon" style="fill: #ffc107dd;">
                            <path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120l0 136c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2 280 120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/>
                        </svg>
                    </a>
                </div>
                <div class="col-lg-12 mt-2 mb-2">
                    <a class="requirements-container" id="rejectedContainer" data-bs-toggle="modal" data-bs-target="#rejectedModal">
                        Rejected: 0
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon" style="fill: #ff2a00cf;">
                            <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c-9.4 9.4-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0z"/>
                        </svg>
                    </a>
                </div>
                <div class="col-lg-12 mb-2">
                    <a class="requirements-container" id="completedContainer" data-bs-toggle="modal" data-bs-target="#completedModal">
                        Completed: 0
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="icon" style="fill: #28a745;">
                            <path d="M256 48a208 208 0 1 1 0 416 208 208 0 1 1 0-416zm0 464A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L369 209z"/>
                        </svg>
                    </a>
                </div>
                <div class="col-lg-12">
                    <a class="requirements-container" id="weeklyreportContainer" data-bs-toggle="modal" data-bs-target="#weeklyreportModal">
                        Weekly Report
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="icon" style="fill: #6f42c1;">
                            <path d="M64 0C28.7 0 0 28.7 0 64L0 448c0 35.3 28.7 64 64 64l256 0c35.3 0 64-28.7 64-64l0-288-128 0c-17.7 0-32-14.3-32-32L224 0 64 0zM256 0l0 128 128 0L256 0zM112 256l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64l160 0c8.8 0 16 7.2 16 16s-7.2 16-16 16l-160 0c-8.8 0-16-7.2-16-16s7.2-16 16-16z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-8" id="posted-requirements">
            <!-- Dynamically populated requirement posts will appear here -->
        </div>
    </div>
</div>

<div class="modal fade" id="pendingModal" tabindex="-1" aria-labelledby="pendingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center w-100">
                <h5 class="text-center mb-0 text-warning">Pending Requirements</h5>
                <div class="input-group flex-shrink-1" style="max-width: 350px;">
                    <select class="form-select form-select-sm" aria-label="Select filter" id="pendingSelectOption">
                        <option selected></option>
                    </select>
                    <input type="text" id="pendingSearchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary btn-sm" type="button">
                        <svg class="table-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="modal-body">
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


<div class="modal fade" id="rejectedModal" tabindex="-1" aria-labelledby="rejectedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center w-100">
                <h5 class="text-center mb-0 text-danger">Rejected Requirements</h5>
                <div class="input-group flex-shrink-1" style="max-width: 350px;">
                    <select class="form-select form-select-sm" aria-label="Select filter" id="rejectedSelectOption">
                        <option selected>Filter</option>
                    </select>
                    <input type="text" id="rejectedSearchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary btn-sm" type="button">
                        <svg class="table-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="modal-body">
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

<div class="modal fade" id="completedModal" tabindex="-1" aria-labelledby="completedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center w-100">
                <h5 class="text-center mb-0 text-success">Completed Requirements</h5>
                <div class="input-group flex-shrink-1" style="max-width: 350px;">
                    <select class="form-select form-select-sm" aria-label="Select filter" id="completedSelectOption">
                        <option selected>Filter</option>
                    </select>
                    <input type="text" id="completedSearchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary btn-sm" type="button">
                        <svg class="table-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="modal-body">
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

<div class="modal fade" id="weeklyreportModal" tabindex="-1" aria-labelledby="weeklyreportModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center w-100">
                <h5 class="text-center mb-0" style="color: #6f42c1;">Weekly Reports</h5>
                <div class="input-group flex-shrink-1" style="max-width: 350px;">
                    <input type="text" id="weeklyreportSearchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                    <button class="btn btn-outline-secondary btn-sm" type="button">
                        <svg class="table-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <div id="weeklyreportContent">
                    <!-- This is where the completed requirements will be inserted dynamically -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="remarksModal" tabindex="-1" aria-labelledby="remarksModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="remarksModalLabel">Provide Remarks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <textarea id="remarksTextarea" class="form-control" rows="5" placeholder="Enter remarks here..."></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" id="submitRemarksBtn" class="btn btn-danger">Reject</button>
            </div>
        </div>
    </div>
</div>


<div id="pdfModal" class="pdf-modal" style="display: none;">
    <div class="pdf-modal-content">
        <span id="closeModal" class="close">&times;</span>
        <embed id="pdfViewer" width="100%" height="100%" type="application/pdf">
        <img id="weeklyreportimageViewer" src="" alt="Preview" style="width: 100%; height: 100%; display: none;" />
    </div>
</div>