<div class="container-fluid p-0 m-0" id="dashboard" style="display: none;">
    <!-- <div class="row">
        <div class="col-12 col-md-6 col-lg-3 mb-3">
            <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <div>
                    <div class="card-title fs-6">Departments</div>
                    <div id="num-depts" class="h2">0</div>
                </div>
                <div>
                    <i class="fa-solid fa-scroll fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-3">
            <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <div>
                    <div class="card-title fs-6">Coordinators</div>
                    <div id="num-coor" class="h2">0</div>
                </div>
                <div>
                    <i class="fa-solid fa-user-group fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-3">
            <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <div>
                    <div class="card-title fs-6">Interns</div>
                    <div id="num-interns" class="h2">0</div>
                </div>
                <div>
                    <i class="fa-solid fa-graduation-cap fa-2x"></i>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-3">
            <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <div>
                    <div class="card-title fs-6">Admins</div>
                    <div id="num-admins" class="h2">0</div>
                </div>
                <div>
                    <i class="fa-solid fa-user-gear fa-2x"></i>
                </div>
            </div>
        </div> -->
        <!-- <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <div>
                    <div class="card-title fs-6">Container 4</div>
                    <div id="num-departments" class="h2">0</div>
                </div>
                <div>
                    <i class="fa-solid fa-user-shield fa-2x"></i>
                </div>
            </div>
        </div> -->
    <!-- </div> -->

    <!-- <div class="row">
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <div class="card-chart" style="padding: 0; display: flex; justify-content: center; align-items: center;">
                    <div id="users-chart" style="width: 100%; height: 100%; min-height: 300px;"></div>
                </div>
            </div>
        </div>
    </div> -->

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

                <!-- Right section (Action buttons) -->
                <div class="d-flex">
                    <button class="btn btn-primary btn-sm me-2">Edit</button>
                    <button class="btn btn-danger btn-sm">Delete</button>
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
                            <th>Username</th>
                            <th>User Type</th>
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