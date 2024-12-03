<div class="container-fluid bg-light p-0 m-0" id="internlist" style="display: none;">
    <!-- Custom Container -->
    <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <!-- Left Section: Page Length Selector & Filter -->
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

                    <!-- Filter Sorting -->
                    <div class="filter-container ms-2">
                        <button class="btn btn-light dropdown-toggle" type="button" id="filterCheckboxButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                        <div class="dropdown-menu px-1 pt-1" aria-labelledby="filterCheckboxButton">
                            <div class="dropdown-header"><strong class="text-center">Filter by</strong></div>
                            <div class="form-check mb-2 mt-1">
                                <label class="form-check-label" for="filterDepartment">Department</label>
                                <select id="filterDepartment" class="form-select form-select-sm me-5">
                                    <option value="">All Departments</option>
                                    <!-- Dynamic options loaded here -->
                                </select>
                            </div>
                            <div class="dropdown-footer mt-2 text-center">
                                <button class="btn btn-sm btn-primary me-2" id="applyFiltersButton">Apply Filters</button>
                                <button class="btn btn-sm btn-warning" id="archiveButton">Archive</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Section: Search Input -->
                <div class="ms-auto">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-outline-secondary btn-sm" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Body -->
        <div class="card-body bg-white">
            <!-- Table Placeholder -->
            <div class="table-responsive">
                <table id="intern-lists" class="table table-hover text-center" style="width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Student ID</th>
                            <th>Username</th>
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
    <!-- End Custom Container -->
</div>
