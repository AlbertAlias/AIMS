<div class="container-fluid p-0 m-0" id="student" style="display: none;">
    <div class="card shadow-sm mt-4">
        <!-- Header -->
        <div class="card-header bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <!-- Left section (Page Length and Search) -->
                <div class="d-flex align-items-center">
                    <!-- Page Length Selector -->
                    <div class="d-flex align-items-center me-3 mb-2 mb-sm-0">
                        <label for="pageLengthSelect" class="form-label mb-0 me-2">Show</label>
                        <select id="pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Page length selector">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <!-- Search Input -->
                    <div class="ms-3 flex-shrink-1">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                            <button class="btn btn-outline-secondary btn-sm" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                 <!-- Post Requirements Modal -->
                    <div class="modal fade" id="postRequirementsModal" tabindex="-1" aria-labelledby="postRequirementsModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="postRequirementsModalLabel">Post Requirements</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="postRequirementsForm">
                                        <div class="mb-3">
                                            <label for="requirementTitle" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="requirementTitle" placeholder="Enter requirement title" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="requirementDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="requirementDescription" rows="3" placeholder="Enter requirement description" required></textarea>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="postRequirementsForm" class="btn btn-primary">Post Requirement</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Post Weekly Report Modal -->
                    <div class="modal fade" id="postWeeklyReportModal" tabindex="-1" aria-labelledby="postWeeklyReportModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="postWeeklyReportModalLabel">Post Weekly Report</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="postWeeklyReportForm">
                                        <div class="mb-3">
                                            <label for="reportTitle" class="form-label">Title</label>
                                            <input type="text" class="form-control" id="reportTitle" placeholder="Enter weekly report title" required>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" form="postWeeklyReportForm" class="btn btn-primary">Post Report</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right section (Action buttons) -->
                    <div class="d-flex">
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#postWeeklyReportModal">Post Weekly Report</button>
                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#postRequirementsModal">Post Requirements</button>
                        <button class="btn btn-warning">Archive</button>
                    </div>

            </div>
        </div>
        
        <!-- Body -->
        <div class="card-body bg-white">
            <!-- Table Placeholder -->
            <div class="table-responsive">
                <table id="usersTable" class="table table-hover text-center" style="width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <!-- Select All Checkbox -->
                                <input type="checkbox" id="selectAllCheckbox">
                            </th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Student ID</th>
                            <th>Gender</th>
                            <th>Personal Email</th>
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
                <span id="tableInfo">Showing 1 to 10 of 50 entries</span>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul id="pagination" class="pagination mb-0">
                        <!-- Pagination buttons will be generated here via AJAX -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>

</div>