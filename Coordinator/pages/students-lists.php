<div class="container-fluid p-0 m-0" id="students" style="display: none;">
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
                    <!-- Search Input -->
                    <div class="flex-shrink-1">
                        <div class="input-group">
                            <input type="text" id="stud-lists-searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                            <button class="btn btn-sm btn-outline-secondary" type="button">
                                <svg class="table-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <button class="btn btn-sm btn-primary " type="button" data-bs-toggle="modal" data-bs-target="#setHoursModal">
                    Set OJT Hours
                </button>
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
                <span class="mb-2" id="stud-lists-tableInfo">Showing 1 to 10 of 50 entries</span>
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

<!-- Modal for setting hours -->
<div class="modal fade" id="setHoursModal" tabindex="-1" aria-labelledby="setHoursModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="setHoursModalLabel">Set Hours for Students</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form to set hours -->
                <form id="setHoursForm">
                    <div class="mb-3">
                        <label for="hoursNeeded" class="form-label">Hours Needed</label>
                        <input type="number" class="form-control" id="hoursNeeded" name="hoursNeeded" required>
                    </div>
                    <input type="hidden" id="coordinatorId" name="coordinatorId" value="1"> <!-- Set the coordinator ID here -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveHoursButton">Set Hours</button>
            </div>
        </div>
    </div>
</div>

<!-- OJT Hours Modal -->
<div class="modal fade" id="ojthoursModal" tabindex="-1" aria-labelledby="ojthoursModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center w-100">
                <h5 class="text-center mb-0">OJT Hours</h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>