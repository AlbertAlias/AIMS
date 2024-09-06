<!-- Begin Page Content -->
<div class="container-fluid bg-light p-0 m-0">
    <div class="page-header d-flex justify-content-between align-items-center mb-3 border-bottom border-secondary pb-2">
        <!-- Actions Section on the Left (hidden by default) -->
        <div id="actionsSection" class="d-flex align-items-center justify-content-between px-3 bg-light" style="display: none;">
            <span id="actionsText" class="me-4 text-dark fw-bold" style="display: none; margin-right: 5px;">Actions:</span>
            <button id="viewButton" class="btn btn-info me-3" style="display: none; margin-right: 5px;"><i class="fa-solid fa-eye"></i></button>
            <button id="editButton" class="btn btn-warning me-3" style="display: none; margin-right: 5px;"><i class="fa-solid fa-pen-to-square"></i></button>
            <button id="deleteButton" class="btn btn-danger" style="display: none;"><i class="fa-solid fa-trash"></i></button>
        </div>

        <!-- Right controls are aligned to the right -->
        <div class="d-flex align-items-center ms-auto">
            <!-- Page Length Select -->
            <div class="custom-select-container me-3">
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

            <!-- Filter Dropdown -->
            <div class="dropdown me-3">
                <button class="btn btn-light dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-filter"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><a class="dropdown-item" href="#">Filter 1</a></li>
                    <li><a class="dropdown-item" href="#">Filter 2</a></li>
                    <li><a class="dropdown-item" href="#">Filter 3</a></li>
                </ul>
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


<div id="editFormContainer" class="container-fluid p-3 bg-light border rounded shadow-sm mt-3" style="display: none;">
        <h4>Edit User Information</h4>
        <form id="editUserForm">
            <input type="hidden" id="userId" name="userId">
            <div class="mb-3">
                <label for="firstname" class="form-label">First Name</label>
                <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
            <div class="mb-3">
                <label for="lastname" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>
            <div class="mb-3">
                <label for="studentID" class="form-label">Student ID</label>
                <input type="text" class="form-control" id="studentID" name="studentID" required>
            </div>
            <div class="mb-3">
                <label for="company" class="form-label">Company</label>
                <input type="text" class="form-control" id="company" name="company" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="userType" class="form-label">User Type</label>
                <input type="text" class="form-control" id="userType" name="userType" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>