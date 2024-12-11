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
























    <div class="col-md-4">
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title fs-5 text-primary">Pass the MOA until the first week of internship</div>
                            <div class="card-text fs-6">Please accomplish this as soon as possible</div>
                        </div>

                        <div class="card p-2 text-center bg-danger" style="color: white; cursor: pointer; border: none; border-radius: 5px;">
                            <div class="card-text fs-6">Pending</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title fs-5 text-primary">Pass the Medical Certificate</div>
                            <div class="card-text fs-6">Deadline: Dec 09, 2024</div>
                        </div>

                        <div class="card p-2 text-center bg-warning" style="color: white; cursor: pointer; border: none; border-radius: 5px;">
                            <div class="card-text fs-6">Submitted</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title fs-5 text-primary">Pass the Birth Certificate or PSA</div>
                            <div class="card-text fs-6">Deadline: Dec 09, 2024</div>
                        </div>

                        <div class="card p-2 text-center bg-success" style="color: white; cursor: pointer; border: none; border-radius: 5px;">
                            <div class="card-text fs-6">Completed</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title fs-5 text-primary">Pass the Resume</div>
                            <div class="card-text fs-6">Deadline: Nov 27, 2024</div>
                        </div>

                        <div class="card p-2 text-center bg-success" style="color: white; cursor: pointer; border: none; border-radius: 5px;">
                            <div class="card-text fs-6">Completed</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



{/* <div class="card task-card px-3 py-2 mb-4" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px; transition: transform 0.3s ease;">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <div class="card-title text-primary fw-bold mb-1 mt-2">${req.title}</div>
                                        <div class="card-text mb-2 text-muted">${req.description}</div>
                                    </div>
                                    <div class="text-end">
                                        <div class="badge bg-warning text-white py-2 px-3 mt-3" style="font-size: 0.875rem; border-radius: 20px;">Pending</div>
                                    </div>
                                </div>
                            </div> */}