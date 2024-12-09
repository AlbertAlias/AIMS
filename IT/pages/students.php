<div class="container-fluid bg-light p-0 m-0" id="students" style="display: none;">
    <div class="row g-4">
        <!-- Left square container -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Upload Student Lists</h5>

                <!-- Rectangle container with dashed green border -->
                <div id="dropZone" class="d-flex flex-column justify-content-center align-items-center" 
                    style="border: 2px dashed green; min-height: 90px; padding: 20px; border-radius: 10px;">
                    <i class="fa-solid fa-cloud-arrow-up mt-3" style="font-size: 44px; color: green;"></i>
                    <p class="text-gray-800 mt-2">Drag files to upload</p>
                    <!-- Hidden file input -->
                    <input type="file" id="fileInput" accept=".csv" style="display: none;"/>
                </div>

                <!-- Upload button -->
                <button type="button" id="uploadButton" class="btn btn-success mt-3">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Upload Files
                </button>

                <!-- Progress Container -->
                <!-- <div id="uploadProgress" class="mt-4" style="display: none;">
                    <div class="d-flex align-items-center justify-content-between" style="width: 100%;">
                        <div class="d-flex align-items-center flex-grow-1">
                            <i class="fa-solid fa-file-csv" style="font-size: 30px; color: green;"></i>
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
                        <button id="cancelUploadBtn" style="display: none;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div> -->
            </div>
        </div>

        <!-- Middle square container -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Students</h5>
                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" id="searchsStudents" placeholder="Search student...">
                    <i class="fa-solid fa-magnifying-glass position-absolute search-icon"></i>
                </div>
                <div id="studentsInfo" class="text-gray-800">
                    <!-- Student information will be displayed here -->
                </div>
                <!-- See Student Lists button -->
                <!-- <a type="button" id="uploadButton" class="btn btn-success mt-3 text-light" href="#" onclick="showSection(event, 'internlist');">
                    <i class="fa-solid fa-eye"></i> Intern Lists
                </a> -->
            </div>
        </div>

        <!-- Right rectangle container -->
        <div class="col-md-4 col-lg-6">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Account Information</h5>
                <form id="studentsForm">
                    <div class="row mb-3">
                        <!-- First Name -->
                        <div class="col-md-4">
                            <label for="student_first_name" class="form-label required-asterisk">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="student_first_name" name="student_first_name" required>
                        </div>
                        <!-- Last Name -->
                        <div class="col-md-4">
                            <input type="hidden" id="studentID" name="id">
                            <label for="student_last_name" class="form-label required-asterisk">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="student_last_name" name="student_last_name" required>
                        </div>
                        <!-- Gender -->
                        <div class="col-md-4">
                            <label for="student_gender" class="form-label required-asterisk">Gender <span class="text-danger">*</span></label>
                            <select class="form-select" id="student_gender" name="student_gender" required>
                                <option selected>Choose Gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Student ID -->
                        <div class="col-md-4">
                            <label for="studentID" class="form-label">Student ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="studentID" name="studentID" required>
                        </div>
                        <!-- Department -->
                        <div class="col-md-8">
                            <label for="student_department" class="form-label required-asterisk">Department <span class="text-danger">*</span></label>
                            <select class="form-select" id="student_department" name="student_department" required>
                                <option selected>Choose Department</option>
                                <!-- Options will be dynamically populated here -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Student Email -->
                        <div class="col-md-4">
                            <label for="student_email" class="form-label required-asterisk">Student email<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="student_email" name="student_email" required>
                        </div>
                        <div class="col-md-4">
                            <label for="student_username" class="form-label required-asterisk">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="student_username" name="student_username" required>
                        </div>
                        <div class="col-md-4">
                            <label for="student_password" class="form-label required-asterisk">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="student_password" name="student_password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" id="studentCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                            <button type="button" id="studentUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                            <button type="submit" id="studentSubmittn" class="btn btn-success"><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
</div>

