<!-- Begin Page Content -->
<div class="container-fluid bg-light p-0 m-0">
    <div class="page-header d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary pb-1">
        <!-- Actions Section (hidden by default) -->
        <div id="actionsSection" class="d-flex align-items-center justify-content-between px-3 bg-light" style="display: none;">
            <span id="actionsText" class="me-4 text-dark fw-bold" style="display: none;">Actions:</span>
            <button id="viewButton" class="btn btn-info" style="display: none;">
                <i class="fa-solid fa-eye"></i>
            </button>
            <button id="editButton" class="btn btn-warning" style="display: none;">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <button id="deleteButton" class="btn btn-danger" style="display: none;">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>


        <!-- Right controls aligned to the right -->
        <div class="d-flex align-items-center mt-md-0">
            <!-- Page Length Select -->
            <div class="custom-select-container me-2">
                <select id="pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Page length selector">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <div class="custom-icon-container">
                    <i class="fa-solid fa-list"></i>
                </div>
            </div>

            <!-- Filter Checkboxes -->
            <div class="filter-container mx-1">
                <button class="btn btn-light dropdown-toggle" type="button" id="filterCheckboxButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-filter"></i>
                </button>
                <div class="dropdown-menu px-1 pt-1" aria-labelledby="filterCheckboxButton">
                    <div class="dropdown-header">
                        <strong class="text-center">Filter by</strong>
                    </div>
                    <div class="form-check mb-2 mt-1">
                        <input class="form-check-input filter-checkbox" type="checkbox" id="filterDepartment">
                        <label class="form-check-label" for="filterDepartment">Department</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" id="filterCompany">
                        <label class="form-check-label" for="filterCompany">Company</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox" type="checkbox" id="filterUserType">
                        <label class="form-check-label" for="filterUserType">User Type</label>
                    </div>
                    <div class="dropdown-footer mt-2 text-center">
                        <button class="btn btn-primary" id="applyFiltersButton">Apply Filters</button>
                    </div>
                </div>
            </div>

            <div class="dropdown-menu px-1 pt-1" aria-labelledby="filterCheckboxButton">
                <h6 class="dropdown-header">Filter by</h6>
                <div class="form-check mb-2 mt-1">
                    <input class="form-check-input filter-checkbox" type="checkbox" id="filterDepartment">
                    <label class="form-check-label" for="filterDepartment">Department</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" id="filterCompany">
                    <label class="form-check-label" for="filterCompany">Company</label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input filter-checkbox" type="checkbox" id="filterUserType">
                    <label class="form-check-label" for="filterUserType">User Type</label>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-primary" id="dropdownProceedButton">Apply Filters</button>
                </div>
            </div>

            <!-- Bootstrap 5 Modal -->
            <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"> <!-- Centering modal -->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="filterModalLabel">Apply Filters</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="filterInputContainer">
                            <!-- Dynamic content will be inserted here -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="applyFilterButton">Apply Filters</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Search Input -->
            <div class="input-group">
                <input type="text" id="searchInput" class="form-control form-control-md rounded-start" placeholder="Search..." aria-label="Search">
                <span class="input-group-text rounded-end">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
            </div>
        </div>
    </div>

    <!-- Table content, etc. -->
    <div class="container-fluid p-0 m-0">
        <div class="table-responsive">
            <div class="bg-light pt-1 pb-0 px-2 mx-0 mb-1 border shadow-sm table-header">
                <table id="usersTable" class="table table-hover text-center p-0 m-0">
                    <thead class="table-light">
                        <tr>
                            <th><input class="form-check-input select-all" type="checkbox" id="select-all"></th>
                            <th class="table-header-cell">First Name</th>
                            <th class="table-header-cell">Last Name</th>
                            <th class="table-header-cell">Department</th>
                            <th class="table-header-cell">Student ID</th>
                            <th class="table-header-cell">Company</th>
                            <th class="table-header-cell">Email</th>
                            <th class="table-header-cell">Password</th>
                            <th class="table-header-cell">User Type</th>
                        </tr>
                    </thead>
                    <tbody id="tdata"></tbody>
                </table>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2 px-2">
                <span id="tableInfo"></span>
                <nav aria-label="Page navigation">
                    <ul id="pagination" class="pagination mb-0"></ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- End Page Content -->