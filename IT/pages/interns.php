<div class="container-fluid bg-light p-0 m-0" id="interns" style="display: none;">
    <div class="row g-4">
        <!-- Left square container -->
        <div class="col-md-4 col-lg-4">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="min-height: 120px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Upload Intern Lists</h5>

                <!-- Rectangle container with dashed green border -->
                <div id="dropZone" class="d-flex flex-column justify-content-center align-items-center" 
                    style="border: 2px dashed green; min-height: 90px; padding: 20px; border-radius: 10px;">
                    <i class="fa-solid fa-cloud-arrow-up mt-3" style="font-size: 30px; color: green;"></i>
                    <p class="text-gray-800 mt-2">Drag files to upload</p>
                    <!-- Hidden file input -->
                    <input type="file" id="fileInput" accept=".xlsx, .xls .csv" style="display: none;"/>
                </div>

                <!-- Upload button -->
                <button type="button" id="uploadButton" class="btn btn-success mt-3">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload Files
                </button>
            </div>
        </div>

        <!-- Middle square container -->
        <!-- <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Interns</h5>
                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" id="searchInterns" placeholder="Search Intern...">
                    <i class="fa-solid fa-magnifying-glass position-absolute search-icon"></i>
                </div>
                <div id="internsInfo" class="text-gray-800"> -->
                    <!-- Intern information will be displayed here -->
                <!-- </div> -->
                <!-- See Intern Lists button -->
                <!-- <a type="button" id="uploadButton" class="btn btn-success mt-3 text-light" href="#" onclick="showSection(event, 'internlist');">
                    <i class="fa-solid fa-eye"></i> Intern Lists
                </a>
            </div>
        </div> -->

        <!-- Right rectangle container -->
        <div class="col-md-4 col-lg-8">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Account Information</h5>
                <form id="internsForm">
                    <div class="row mb-3">
                        <!-- Intern ID -->
                        <div class="col-md-3">
                            <input type="hidden" id="internID" name="id">
                            <label for="intern_intern_id" class="form-label">Intern ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="intern_intern_id" name="intern_intern_id" required disabled>
                        </div>
                        <!-- Last Name -->
                        <div class="col-md-3">
                            <label for="intern_last_name" class="form-label required-asterisk">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="intern_last_name" name="intern_last_name" required disabled>
                        </div>
                        <!-- First Name -->
                        <div class="col-md-3">
                            <label for="intern_first_name" class="form-label required-asterisk">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="intern_first_name" name="intern_first_name" required disabled>
                        </div>
                        <!-- Gender -->
                        <div class="col-md-3">
                            <label for="intern_gender" class="form-label required-asterisk">Gender <span class="text-danger">*</span></label>
                            <select class="form-select" id="intern_gender" name="intern_gender" required disabled>
                                <option selected disabled>Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        
                        <!-- Student ID -->
                        <div class="col-md-3">
                            <label for="studentID" class="form-label">Student ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="studentID" name="studentID" required disabled>
                        </div>
                        <!-- Department -->
                        <div class="col-md-3">
                            <label for="intern_department" class="form-label required-asterisk">Department <span class="text-danger">*</span></label>
                            <select class="form-select" id="intern_department" name="intern_department" required disabled>
                                <option selected>Choose Department</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="intern_username" class="form-label required-asterisk">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="intern_username" name="intern_username" required disabled>
                        </div>
                        <div class="col-md-3">
                            <label for="intern_password" class="form-label required-asterisk">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="intern_password" name="intern_password" required disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" id="internCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                            <button type="button" id="internUpdateBtn" class="btn btn-primary" disabled><i class="fa-solid fa-pen-to-square"></i> Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
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
                            <th>Employee No</th>
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