// DEPARTMENTS

{/* <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <!-- Left section (Page Length and Search) -->
                <div class="d-flex align-items-center">
                    <!-- Page Length Selector -->
                    <div class="d-flex align-items-center me-3 mb-2 mb-sm-0">
                        <label for="depts-pageLengthSelect" class="form-label mb-0 me-2">Show</label>
                        <select id="depts-pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Select number of entries per page">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <!-- Search Input -->
                    <div class="ms-3 flex-shrink-1">
                        <div class="input-group">
                            <input type="text" id="depts-searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                            <button class="btn btn-outline-secondary btn-sm" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Right section (Action buttons) -->
                <div class="d-flex">
                    <button class="btn btn-success btn-sm me-2" aria-label="Add Department" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                        Add Department
                    </button>
                    <button class="btn btn-success btn-sm me-2" aria-label="Assign Dean" data-bs-toggle="modal" data-bs-target="#assignDeanModal">
                        Assign Dean
                    </button>
                    <!-- Edit Dean Button -->
                    <button type="button" id="deanEditBtn" class="btn btn-success btn-sm" style="display: none;">
                        <i class="fa-solid fa-pen-to-square text-light"></i> Edit
                    </button>
                    <!-- Update Dean Button -->
                    <button type="button" id="deanUpdateBtn" class="btn btn-primary btn-sm" style="display: none;">
                        <i class="fa-solid fa-pen-to-square text-light"></i> Update
                    </button>
                    <!-- <button class="btn btn-primary btn-sm me-2" aria-label="Edit selected users">Edit</button> -->
                    <!-- <button class="btn btn-danger btn-sm" aria-label="Delete selected users">Delete</button> -->
                </div>
            </div>
        </div>
        
        <!-- Body -->
        <div class="card-body bg-white">
            <!-- Table Placeholder -->
            <div class="table-responsive">
                <table id="deptsTable" class="table table-hover text-center" style="width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th>
                                <!-- Select All Checkbox -->
                                <input type="checkbox" id="selectAllCheckbox" aria-label="Select all users">
                            </th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Department</th>
                            <th>Username</th>
                            <th>Password</th>
                        </tr>
                    </thead>
                    <tbody id="dept-tdata">
                        <!-- Data will be loaded here via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="card-footer bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <span id="depts-tableInfo"></span>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul id="depts-pagination" class="pagination mb-0">
                        <!-- Pagination buttons will be generated here via AJAX -->
                    </ul>
                </nav>
            </div>
        </div>
    </div> */}













// STUDENTS

    // <div class="card shadow-sm mt-4">
    //     <!-- Header -->
    //     <div class="card-header bg-light text-dark">
    //         <div class="d-flex justify-content-between align-items-center flex-wrap">
    //             <!-- Left section (Page Length and Search) -->
    //             <div class="d-flex align-items-center">
    //                 <!-- Page Length Selector -->
    //                 <div class="d-flex align-items-center me-3 mb-2 mb-sm-0">
    //                     <label for="pageLengthSelect" class="form-label mb-0 me-2">Show</label>
    //                     <select id="pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Select number of entries per page">
    //                         <option value="10">10</option>
    //                         <option value="25">25</option>
    //                         <option value="50">50</option>
    //                         <option value="100">100</option>
    //                     </select>
    //                 </div>
    //                 <!-- Search Input -->
    //                 <div class="ms-3 flex-shrink-1">
    //                     <div class="input-group">
    //                         <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
    //                         <button class="btn btn-outline-secondary btn-sm" type="button">
    //                             <i class="fas fa-search"></i>
    //                         </button>
    //                     </div>
    //                 </div>
    //             </div>

    //             <!-- Right section (Action buttons) -->
    //             <div class="d-flex">
    //                 <button class="btn btn-primary btn-sm me-2" aria-label="Edit selected users">Edit</button>
    //                 <button class="btn btn-danger btn-sm" aria-label="Delete selected users">Delete</button>
    //             </div>
    //         </div>
    //     </div>
        
    //     <!-- Body -->
    //     <div class="card-body bg-white">
    //         <!-- Table Placeholder -->
    //         <div class="table-responsive">
    //             <table id="usersTable" class="table table-hover text-center" style="width: 100%;">
    //                 <thead class="table-light">
    //                     <tr>
    //                         <th>
    //                             <!-- Select All Checkbox -->
    //                             <input type="checkbox" id="selectAllCheckbox" aria-label="Select all users">
    //                         </th>
    //                         <th>First Name</th>
    //                         <th>Last Name</th>
    //                         <th>Gender</th>
    //                         <th>Student ID</th>
    //                         <th>Department</th>
    //                         <th>Personal Email</th>
    //                         <th>Username</th>
    //                     </tr>
    //                 </thead>
    //                 <tbody id="tdata">
    //                     <!-- Data will be loaded here via AJAX -->
    //                 </tbody>
    //             </table>
    //         </div>
    //     </div>
        
    //     <!-- Footer -->
    //     <div class="card-footer bg-light text-dark">
    //         <div class="d-flex justify-content-between align-items-center flex-wrap">
    //             <span id="tableInfo"></span>
    //             <!-- Pagination -->
    //             <nav aria-label="Page navigation">
    //                 <ul id="pagination" class="pagination mb-0">
    //                     <!-- Pagination buttons will be generated here via AJAX -->
    //                 </ul>
    //             </nav>
    //         </div>
    //     </div>
    // </div>