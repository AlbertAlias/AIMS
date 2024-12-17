<div class="container-fluid p-0 m-0" id="requirements" style="display: none;">
    <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <!-- Page Length Selector -->
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <select id="stud-lists-pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Page length selector">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <!-- Search Input -->
                <div class="flex-shrink-1">
                    <div class="input-group">
                        <input type="text" id="stud-lists-searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-outline-secondary btn-sm" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Body -->
        <div class="card-body bg-white p-0">
            <!-- Table Placeholder -->
            <div class="table-responsive">
                <table id="stud-lists" class="table table-hover text-center m-0" style="width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Email</th>
                            <th>Supervisor</th>
                            <th>Company</th>
                            <th>Company Address</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tdata">
                        <!-- Data will be loaded here via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="card-footer bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <span id="stud-lists-tableInfo">Showing 1 to 10 of 50 entries</span>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul id="stud-lists-pagination" class="pagination mb-0">
                        <!-- Pagination buttons will be generated here via AJAX -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Custom Container -->
</div>
<!-- End Page Content -->

<div class="modal fade" id="assignSupervisorModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionModalLabel">Assign Student</h5>
            </div>
            <div class="modal-body">
                <!-- Company Dropdown -->
                <div class="mb-3">
                    <label for="companySelect" class="form-label">Company</label>
                    <select class="form-select" id="companySelect" aria-label="Select Company">
                        <option selected>Assign Company</option>
                        <!-- Dynamically populate options -->
                    </select>
                </div>

                <!-- Supervisor Dropdown -->
                <div class="mb-3">
                    <label for="supervisorSelect" class="form-label">Supervisor</label>
                    <select class="form-select" id="supervisorSelect" aria-label="Select Supervisor">
                        <option selected>Assign Supervisor</option>
                        <!-- Dynamically populate options based on selected company -->
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="assignSupervisorBtn">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- 
<div class="modal fade" id="viewRequirementsModal" tabindex="-1" aria-labelledby="actionModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-size modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="text-center">Student Requirements</h5>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs nav-justified" id="requirementsTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active pending-tab" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">
                            Pending
                        </button>
                    </li>

                    <li class="nav-item" role="presentation">
                        <button class="nav-link rejected-tab" id="rejected-tab" data-bs-toggle="tab" data-bs-target="#rejected" type="button" role="tab" aria-controls="rejected" aria-selected="false">
                            Rejected
                        </button>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <button class="nav-link approved-tab" id="approved-tab" data-bs-toggle="tab" data-bs-target="#approved" type="button" role="tab" aria-controls="approved" aria-selected="false">
                            Approved
                        </button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="requirementsTabsContent">
                    <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="requirements-list" id="pendingRequirements">
                        </div>
                    </div>

                    <div class="tab-pane fade" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">
                        <div class="requirements-list" id="rejectedRequirements">
                        </div>
                    </div>

                    <div class="tab-pane fade" id="approved" role="tabpanel" aria-labelledby="approved-tab">
                        <div class="requirements-list" id="approvedRequirements">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
 -->
