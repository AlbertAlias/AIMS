<div class="container mt-2">
    <div class="row">
        <!-- User Role Selection Container (Top Left) -->
        <div class="col-12 col-md-4 mb-4">
            <div class="role-selection-container bg-light border rounded shadow-sm p-2">
                <h5 class="text-center mb-3 mt-2">Select User Role</h5>
                <hr class="sidebar-divider my-0">
                <div class="form-check mb-2 p-2 rounded d-flex align-items-center" style="transition: background-color 0.2s ease; margin-left: 30px; font-size: 18px;">
                    <input class="form-check-input me-2" type="radio" name="userRole" id="roleStudent" value="OJT Student">
                    <label class="form-check-label" for="roleStudent" style="flex-grow: 1;">OJT Student</label>
                </div>
                <div class="form-check mb-2 p-2 rounded d-flex align-items-center" style="transition: background-color 0.2s ease; margin-left: 30px; font-size: 18px;">
                    <input class="form-check-input me-2" type="radio" name="userRole" id="roleCoordinator" value="OJT Coordinator">
                    <label class="form-check-label" for="roleCoordinator" style="flex-grow: 1;">OJT Coordinator</label>
                </div>
                <div class="form-check mb-2 p-2 rounded d-flex align-items-center" style="transition: background-color 0.2s ease; margin-left: 30px; font-size: 18px;">
                    <input class="form-check-input me-2" type="radio" name="userRole" id="roleSupervisor" value="OJT Supervisor">
                    <label class="form-check-label" for="roleSupervisor" style="flex-grow: 1;">OJT Supervisor</label>
                </div>
                <div class="form-check mb-2 p-2 rounded d-flex align-items-center" style="transition: background-color 0.2s ease; margin-left: 30px; font-size: 18px;">
                    <input class="form-check-input me-2" type="radio" name="userRole" id="roleRegistrar" value="Registrar">
                    <label class="form-check-label" for="roleRegistrar" style="flex-grow: 1;">Registrar</label>
                </div>
            </div>
        </div>

        <!-- User Information Form Container (Top Right) -->
        <div class="col-12 col-md-8">
            <div id="studentForm" class="form-container bg-light border rounded shadow-sm p-3" style="display: none;">
                <h5 class="text-center">OJT Student Information</h5>
                <hr class="sidebar-divider my-0">
                <form>
                    <div class="mb-2">
                        <label for="studentFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="studentFirstName" name="firstname" required>
                    </div>
                    <div class="mb-2">
                        <label for="studentLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="studentLastName" name="lastname" required>
                    </div>
                    <div class="mb-2">
                        <label for="studentDepartment" class="form-label">Department</label>
                        <select class="form-select w-100" id="studentDepartment" style="background-color: #f8f9fa; padding: 10px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" name="department" required aria-label="Select Department">
                            <option value="" disabled selected hidden>Select Department</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Tourism Management">Tourism Management</option>
                            <option value="Hospitality Management">Hospitality Management</option>
                            <option value="Business Administration">Business Administration</option>
                            <option value="Accountancy">Accountancy</option>
                            <option value="Education">Education</option>
                            <option value="Criminology">Criminology</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a department.
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="studentID" class="form-label">Student ID</label>
                        <input type="text" class="form-control" id="studentID" name="studentID">
                    </div>
                    <div class="mb-2">
                        <label for="studentEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="studentEmail" name="email" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="studentPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="studentPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </form>
            </div>

            <div id="coordinatorForm" class="form-container bg-light border rounded shadow-sm p-3" style="display: none;">
                <h5 class="text-center">OJT Coordinator Information</h5>
                <form>
                    <div class="mb-2">
                        <label for="coordinatorFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="coordinatorFirstName" name="firstname" required>
                    </div>
                    <div class="mb-2">
                        <label for="coordinatorLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="coordinatorLastName" name="lastname" required>
                    </div>
                    <div class="mb-2">
                        <label for="coordinatorDepartment" class="form-label">Department</label>
                        <select class="form-select w-100" id="coordinatorDepartment" style="background-color: #f8f9fa; padding: 10px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);" name="department" required aria-label="Select Department">
                            <option value="" disabled selected>Select Department</option>
                            <option value="Information Technology">Information Technology</option>
                            <option value="Computer Engineering">Computer Engineering</option>
                            <option value="Computer Science">Computer Science</option>
                            <option value="Tourism Management">Tourism Management</option>
                            <option value="Hospitality Management">Hospitality Management</option>
                            <option value="Business Administration">Business Administration</option>
                            <option value="Accountancy">Accountancy</option>
                            <option value="Education">Education</option>
                            <option value="Criminology">Criminology</option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a department.
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="coordinatorEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="coordinatorEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="coordinatorPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="coordinatorPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </form>
            </div>

            <div id="supervisorForm" class="form-container bg-light border rounded shadow-sm p-3" style="display: none;">
                <h5 class="text-center">OJT Supervisor Information</h5>
                <hr class="sidebar-divider my-0">
                <form>
                    <div class="mb-2">
                        <label for="supervisorFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="supervisorFirstName" name="firstname" required>
                    </div>
                    <div class="mb-2">
                        <label for="supervisorLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="supervisorLastName" name="lastname" required>
                    </div>
                    <div class="mb-2">
                        <label for="supervisorEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="supervisorEmail" name="email" required>
                    </div>
                    <div class="mb-2">
                        <label for="supervisorPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="supervisorPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </form>
            </div>

            <div id="registrarForm" class="form-container bg-light border rounded shadow-sm p-3" style="display: none;">
                <h5 class="text-center">Registrar Information</h5>
                <hr class="sidebar-divider my-0">
                <form>
                    <div class="mb-2">
                        <label for="registrarFirstName" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="registrarFirstName" name="firstname" required>
                    </div>
                    <div class="mb-2">
                        <label for="registrarLastName" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="registrarLastName" name="lastname" required>
                    </div>
                    <div class="mb-2">
                        <label for="registrarEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="registrarEmail" name="email" required>
                    </div>
                    <div class="mb-2">
                        <label for="registrarPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="registrarPassword" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save User</button>
                </form>
            </div>
        </div>
    </div>
</div>