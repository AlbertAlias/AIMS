<div class="container-fluid bg-light p-0 m-0" id="students" style="display: none;">
    <div class="row g-4">
        <!-- Left square container -->
        <div class="col-md-4 col-lg-3">
            <div class="bg-light rounded-3 px-4 py-4 d-flex flex-column" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Upload Student Lists</h5>

                <div id="dropZone" class="d-flex flex-column justify-content-center align-items-center" 
                    style="border: 2px dashed green; min-height: 90px; padding: 20px; border-radius: 10px;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" style="width: 64px; height: 44px; color: green;">
                        <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z" style="fill: green;"/>
                    </svg>
                    <p class="text-gray-800 mt-2">Drag files to upload</p>
                    <!-- Hidden file input -->
                    <input type="file" id="fileInput" accept=".csv" style="display: none;"/>
                </div>

                <!-- Upload button -->
                <button type="button" id="uploadButton" class="btn btn-success mt-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                        <path d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z"/>
                    </svg> Upload Files
                </button>
            </div>
        </div>

        <!-- Left square container (smaller width) -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="bg-light rounded-3 p-4 d-flex flex-column position-relative" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Departments</h5>
                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" id="searchStudents" placeholder="Search Department...">
                    <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                    </svg>
                </div>
                <div id="studentsInfo" class="text-gray-800">
                    <!-- Student information will be displayed here -->
                </div>
                <button id="addDepartmentsBtn" class="btn btn-success mt-3">See table lists</button>
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
                            <input type="hidden" id="student_id" name="id">
                            <label for="student_first_name" class="form-label required-asterisk">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="student_first_name" name="student_first_name" required>
                        </div>
                        <!-- Last Name -->
                        <div class="col-md-4">
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
                                <!-- Options populated dynamically -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <!-- Student Email -->
                        <div class="col-md-4">
                            <label for="student_email" class="form-label required-asterisk">Student Email </label>
                            <input type="text" class="form-control" id="student_email" name="student_email" required>
                        </div>
                        <!-- Username -->
                        <div class="col-md-4">
                            <label for="student_username" class="form-label required-asterisk">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="student_username" name="student_username" required>
                        </div>
                        <!-- Password -->
                        <div class="col-md-4">
                            <label for="student_password" class="form-label required-asterisk">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="student_password" name="student_password" required>
                        </div>
                    </div>
                    <button type="button" id="studentUpdateBtn" class="btn btn-primary" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160L0 416c0 53 43 96 96 96l256 0c53 0 96-43 96-96l0-96c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 96c0 17.7-14.3 32-32 32L96 448c-17.7 0-32-14.3-32-32l0-256c0-17.7 14.3-32 32-32l96 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L96 64z"/>
                        </svg> Update
                    </button>
                    <button type="button" id="studentCancelBtn" class="btn btn-secondary" style="display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <path d="M48.5 224L40 224c-13.3 0-24-10.7-24-24L16 72c0-9.7 5.8-18.5 14.8-22.2s19.3-1.7 26.2 5.2L98.6 96.6c87.6-86.5 228.7-86.2 315.8 1c87.5 87.5 87.5 229.3 0 316.8s-229.3 87.5-316.8 0c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0c62.5 62.5 163.8 62.5 226.3 0s62.5-163.8 0-226.3c-62.2-62.2-162.7-62.5-225.3-1L185 183c6.9 6.9 8.9 17.2 5.2 26.2s-12.5 14.8-22.2 14.8L48.5 224z"/>
                        </svg> Cancel
                    </button>
                    <button type="submit" id="studentSubmitBtn" class="btn btn-success">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                            <path d="M96 80c0-26.5 21.5-48 48-48l288 0c26.5 0 48 21.5 48 48l0 304L96 384 96 80zm313 47c-9.4-9.4-24.6-9.4-33.9 0l-111 111-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l64 64c9.4 9.4 24.6 9.4 33.9 0L409 161c9.4-9.4 9.4-24.6 0-33.9zM0 336c0-26.5 21.5-48 48-48l16 0 0 128 448 0 0-128 16 0c26.5 0 48 21.5 48 48l0 96c0 26.5-21.5 48-48 48L48 480c-26.5 0-48-21.5-48-48l0-96z"/>
                        </svg> Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

