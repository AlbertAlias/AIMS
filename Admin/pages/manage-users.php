<!-- Begin Page Content -->
<div class="container-fluid bg-light p-0 m-0">
    <div class="page-header d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary pb-1">
        <!-- Actions Section (hidden by default) -->
        <div id="actionsSection" class="d-flex align-items-center justify-content-between px-3 bg-light" style="display: none;">
            <span id="actionsText" class="me-4 text-dark fw-bold" style="display: none;">Actions:</span>
            <!-- View link -->
            <a href="#" id="viewButton" class="action-link" style="display: none;">View</a>
            <!-- Edit link -->
            <a href="#" id="editButton" class="action-link" style="display: none;">Edit</a>
            <!-- Delete link -->
            <a href="#" id="deleteButton" class="action-link" style="display: none;">Delete</a>
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
                            <th><input class="form-check-input select-all row-checkbox" type="checkbox" id="select-all" name="rowCheckbox" data-id="<?php echo $id; ?>"></th>
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

<!-- Actions Section Modal -->
<div class="modal fade" id="actionsModal" tabindex="-1" role="dialog" aria-labelledby="actionsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="actionsModalLabel">User Details</h5>
            </div>
            <div class="modal-body">
                <!-- Form fields for editing/viewing user -->
                <form id="userForm">
                    <input type="hidden" id="userId" name="id">

                    <!-- First Name -->
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" required>
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" required>
                    </div>

                    <!-- Department -->
                    <div class="form-group" id="departmentField">
                        <label for="department">Department</label>
                        <select class="form-control" id="department" name="department" required>
                            <option value="" disabled>Select Department</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Tourism Management">Tourism Management</option>
                            <option value="Hospitality Management">Hospitality Management</option>
                            <option value="Business Administration">Business Administration</option>
                            <option value="Accountancy">Accountancy</option>
                            <option value="Education">Education</option>
                            <option value="Criminology">Criminology</option>
                        </select>
                    </div>

                    <!-- Student ID -->
                    <div class="form-group" id="studentIDField" style="display: none;">
                        <label for="studentID">Student ID</label>
                        <input type="text" class="form-control" id="studentID" name="studentID">
                    </div>

                    <!-- Company -->
                    <div class="form-group" id="companyField">
                        <label for="company">Company</label>
                        <input type="text" class="form-control" id="company" name="company">
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required readonly>
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password" readonly>
                    </div>

                    <!-- User Type -->
                    <div class="form-group">
                        <label for="user_type">User Type</label>
                        <select class="form-control" id="user_type" name="user_type" required>
                            <option value="Admin">Admin</option>
                            <option value="OJT Student">OJT Student</option>
                            <option value="OJT Coordinator">OJT Coordinator</option>
                            <option value="OJT Supervisor">OJT Supervisor</option>
                            <option value="Registrar">Registrar</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                <button type="button" class="btn btn-primary" id="saveChangesButton">Save changes</button>
            </div>
        </div>
    </div>
</div>