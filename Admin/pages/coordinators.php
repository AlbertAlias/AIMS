    <div class="container-fluid bg-light p-0 m-0">
        <div class="row g-4">
            <!-- Left square container (smaller width) -->
            <div class="col-md-4 col-lg-3">
                <div class="bg-light rounded-3 shadow-sm px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                    <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Coordinators</h5>
                    <div id="coordinatorInfo" class="text-gray-800">
                        <!-- Coordinator information will be displayed here -->
                    </div>
                    <button id="addCoordinatorsBtn" class="btn btn-success mt-3">Add Coordinator</button>
                </div>
            </div>

            <!-- Middle rectangle container (covers remaining space) -->
            <div class="col-md-4 col-lg-6">
                <div class="bg-light rounded-3 shadow-sm px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                    <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Add Coordinator</h5>
                    <p class="text-gray-800 fs-5 mb-3">Personal Information</p>

                    <!-- Personal Information Form -->
                    <form id="coordinatorForm">
                        <div class="row mb-3">
                            <!-- Last Name -->
                            <div class="col-md-6">
                                <label for="last-name" class="form-label required-asterisk">Last Name</label>
                                <input type="text" class="form-control" id="last-name" required disabled>
                            </div>

                            <!-- First Name -->
                            <div class="col-md-6">
                                <label for="first-name" class="form-label required-asterisk">First Name</label>
                                <input type="text" class="form-control" id="first-name" required disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Middle Name -->
                            <div class="col-md-6">
                                <label for="middle-name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middle-name" disabled>
                            </div>
                            <!-- Suffix -->
                            <div class="col-md-3">
                                <label for="suffix" class="form-label">Suffix</label>
                                <input type="text" class="form-control" id="suffix" disabled>
                            </div>
                            <!-- Gender -->
                            <div class="col-md-3">
                                <label for="gender" class="form-label required-asterisk">Gender</label>
                                <select class="form-select" id="gender" required disabled>
                                    <option selected disabled>Unknown</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Address -->
                            <div class="col-md-8">
                                <label for="address" class="form-label required-asterisk">Address</label>
                                <input type="text" class="form-control" id="address" required disabled>
                            </div>
                            <!-- Birthdate -->
                            <div class="col-md-4">
                                <label for="birthdate" class="form-label required-asterisk">Birthdate</label>
                                <input type="date" class="form-control" id="birthdate" required disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Civil Status -->
                            <div class="col-md-3">
                                <label for="civil-status" class="form-label required-asterisk">Civil Status</label>
                                <select class="form-select" id="civil-status" required disabled>
                                    <option selected disabled>Unknown</option>
                                    <option value="single">Single</option>
                                    <option value="married">Married</option>
                                    <option value="divorced">Divorced</option>
                                </select>
                            </div>

                            <!-- Email -->
                            <div class="col-md-9">
                                <label for="personal-email" class="form-label required-asterisk">Email</label>
                                <input type="email" class="form-control" id="personal-email" required disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <!-- Contact Number -->
                            <div class="col-md-5">
                                <label for="contact-number" class="form-label">Contact Number</label>
                                <div class="input-group">
                                    <!-- Non-editable +63 prefix -->
                                    <span class="input-group-text m-0 px-2">+63</span>
                                    
                                    <!-- Editable part for the rest of the number -->
                                    <input type="tel" class="form-control" id="contact-number" placeholder="9123456789" pattern="[1-9]{10}" maxlength="10" title="Please enter a valid 10-digit phone number" disabled>
                                </div>
                            </div>

                            <!-- Department -->
                            <div class="col-md-7">
                                <label for="department" class="form-label required-asterisk">Department</label>
                                <select class="form-select" id="department" required disabled>
                                    <option selected disabled>Select department</option>
                                    <option value="it">Information Technology</option>
                                    <option value="cs">Computer Science</option>
                                    <option value="ce">Computer Engineering</option>
                                    <option value="tm">Tourism Management</option>
                                    <option value="hm">Hospitality Management</option>
                                    <option value="ba">Business Administration</option>
                                    <option value="acc">Accountancy</option>
                                    <option value="edu">Education</option>
                                    <option value="crim">Criminology</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-md-12 text-end">
                                <button type="submit" id="submitBtn" class="btn btn-success" disabled>Submit</button>
                                <button type="button" id="cancelBtn" class="btn btn-secondary" style="display: none;">Cancel</button>
                                <button type="button" id="deleteBtn" class="btn btn-danger" style="display: none;">Delete</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right square container (smaller width) -->
            <div class="col-md-4 col-lg-3">
                <div class="bg-light rounded-3 shadow-sm px-4 py-4 d-flex flex-column" style="min-height: 200px;">
                    <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Account Information</h5>

                    <!-- Email input -->
                    <div class="mb-3">
                        <label for="account-email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="account-email" disabled>
                    </div>

                    <!-- Password input -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>