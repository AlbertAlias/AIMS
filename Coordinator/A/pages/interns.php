<div class="container-fluid bg-light p-0 m-0" id="interns" style="display: none;">
    <div class="row g-4">
        <!-- Left square container -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Upload Intern Lists</h5>

                <!-- Rectangle container with dashed green border -->
                <div id="dropZone" class="d-flex flex-column justify-content-center align-items-center" 
                    style="border: 2px dashed green; min-height: 150px; padding: 20px; border-radius: 10px;">
                    <i class="fa-solid fa-cloud-arrow-up mt-3" style="font-size: 50px; color: green;"></i>
                    <p class="text-gray-800 mt-2">Drag files to upload</p>
                    <!-- Hidden file input -->
                    <input type="file" id="fileInput" accept=".xlsx, .xls .csv" style="display: none;"/>
                </div>

                <!-- Upload button -->
                <button type="button" id="uploadButton" class="btn btn-success mt-3">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload Files
                </button>

                <!-- CSV Export Button -->
                <button id="exportCSVBtn" class="btn btn-primary mt-2">
                    <i class="fa-solid fa-file-excel"></i> Download Excel File
                </button>

                <!-- Download Progress -->
                <div id="downloadProgress" class="mt-4" style="display: none; padding: 10px; border-radius: 5px;">
                    <div class="d-flex align-items-center justify-content-between" style="width: 100%;">
                        <div class="d-flex align-items-center flex-grow-1">
                            <i class="fa-solid fa-file-excel" style="font-size: 30px; color: green;"></i>
                            <div class="ms-2">
                                <span id="downloadFileName">intern-lists_template.xlsx</span>
                                <div class="progress mb-1" style="width: 180px; height: 15px;">
                                    <div id="downloadProgressBar" class="progress-bar progress-bar-striped progress-bar-animated" 
                                        role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        <span id="downloadProgressPercent" class="text-end d-block me-1">0%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span id="downloadCompleteIcon" style="display: none;">
                            <i class="fa-solid fa-check" style="font-size: 15px; color: green;"></i>
                        </span>
                    </div>
                </div>

                <!-- Progress Container -->
                <div id="uploadProgress" class="mt-4" style="display: none;">
                    <div class="d-flex align-items-center justify-content-between" style="width: 100%;">
                        <div class="d-flex align-items-center flex-grow-1">
                            <i class="fa-solid fa-file-excel" style="font-size: 30px; color: green;"></i>
                            <div class="ms-2">
                                <span id="uploadfileName" class="text-gray-800"></span>
                                <div class="progress mb-1" style="width: 180px; height: 15px;">
                                    <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" 
                                        role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        <span id="progressPercent" class="text-end d-block me-1">0%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span id="uploadCompleteIcon" style="display: none;">
                            <i class="fa-solid fa-check" style="font-size: 15px; color: green;"></i>
                        </span>
                        <button id="cancelUploadBtn" class="btn btn-danger btn-sm" style="display: none;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Middle square container -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Interns</h5>
                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" id="searchInterns" placeholder="Search Intern...">
                    <i class="fa-solid fa-magnifying-glass position-absolute search-icon"></i>
                </div>
                <div id="internsInfo" class="text-gray-800">
                    <!-- Intern information will be displayed here -->
                </div>
                
            </div>
        </div>

        <!-- Right rectangle container -->
        <div class="col-md-4 col-lg-6">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Update Intern</h5>
                <p class="text-gray-800 fs-5 mb-3">Personal Information</p>
                <form id="internsForm">
                    <div class="row mb-3">
                        <!-- Last Name -->
                        <div class="col-md-5">
                            <input type="hidden" id="internID" name="id">
                            <label for="intern_last_name" class="form-label required-asterisk">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="intern_last_name" name="intern_last_name" required disabled>
                        </div>

                        <!-- First Name -->
                        <div class="col-md-7">
                            <label for="intern_first_name" class="form-label required-asterisk">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="intern_first_name" name="intern_first_name" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Middle Name -->
                        <div class="col-md-5">
                            <label for="intern_middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="intern_middle_name" name="intern_middle_name" disabled>
                        </div>
                        <!-- Suffix -->
                        <div class="col-md-3">
                            <label for="intern_suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="intern_suffix" name="intern_suffix" disabled>
                        </div>
                        <!-- Gender -->
                        <div class="col-md-4">
                            <label for="intern_gender" class="form-label required-asterisk">Gender <span class="text-danger">*</span></label>
                            <select class="form-select" id="intern_gender" name="intern_gender" required disabled>
                                <option selected disabled>Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Address -->
                        <div class="col-md-8">
                            <label for="intern_address" class="form-label required-asterisk">Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="intern_address" name="intern_address" required disabled>
                        </div>
                        <!-- Birthdate -->
                        <div class="col-md-4">
                            <label for="intern_birthdate" class="form-label required-asterisk">Birthdate <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="intern_birthdate" name="intern_birthdate" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Civil Status -->
                        <div class="col-md-4">
                            <label for="intern_civil_status" class="form-label required-asterisk">Civil Status <span class="text-danger">*</span></label>
                            <select class="form-select" id="intern_civil_status" name="intern_civil_status" required disabled>
                                <option selected disabled>Choose Status</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                        <!-- Email -->
                        <div class="col-md-8">
                            <label for="intern_personal_email" class="form-label required-asterisk">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="intern_personal_email" name="intern_personal_email" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Contact Number -->
                        <div class="col-md-4">
                            <label for="intern_contact_number" class="form-label">Contact Number <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text m-0 px-2">+63</span>
                                <input type="tel" class="form-control" id="intern_contact_number" name="intern_contact_number" placeholder="" pattern="[1-9]{10}" maxlength="10" title="Please enter a valid 10-digit phone number" required disabled>
                            </div>
                        </div>
                        <!-- Student ID -->
                        <div class="col-md-3">
                            <label for="studentID" class="form-label">Student ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="studentID" name="studentID" required disabled>
                        </div>
                        <!-- Department -->
                        <div class="col-md-5">
                            <label for="intern_department" class="form-label required-asterisk">Department <span class="text-danger">*</span></label>
                            <select class="form-select" id="intern_department" name="intern_department" required disabled>
                                <option selected>Choose Department</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <h5 class="text-gray-800 fs-5 mb-3">Account Information</h5>
                        <div class="col-md-6">
                            <label for="intern_account_email" class="form-label required-asterisk">Account Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="intern_account_email" name="intern_account_email" required disabled>
                        </div>
                        <div class="col-md-6">
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
</div>