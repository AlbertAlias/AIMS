<div class="container-fluid bg-light p-0 m-0" id="registrar" style="display: none;">
    <div class="row g-3">
        <!-- Registrar Section -->
        <div class="col-12 col-md-6 col-lg-4">
            <div class="bg-light rounded-3 p-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom pb-2 mb-3">Registrar</h5>
                <div class="mb-3 position-relative">
                    <input type="text" class="form-control" id="searchRegistrar" placeholder="Search Registrar...">
                    <i class="fa-solid fa-magnifying-glass position-absolute search-icon"></i>
                </div>
                <div id="registrarInfo" class="text-gray-800">
                    <!-- Registrar information will be displayed here -->
                </div>
                <button id="addDepartmentsBtn" class="btn btn-success mt-3">See table lists</button>
            </div>
        </div>

        <!-- Add Registrar Section -->
        <div class="col-12 col-md-6 col-lg-8">
            <div class="bg-light rounded-3 p-4 d-flex flex-column" style="min-height: 200px; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <h5 class="text-gray-800 fw-bold border-bottom pb-2 mb-3">Add Registrar</h5>
                <p class="text-gray-800 fs-5 mb-3">Personal Information</p>
                <form id="registrarForm">
                    <div class="row mb-3">
                        <!-- Last Name -->
                        <div class="col-12 col-md-4">
                            <input type="hidden" id="registrarID" name="id">
                            <label for="registrar_last_name" class="form-label required-asterisk">Last Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="registrar_last_name" name="registrar_last_name" required>
                        </div>
                        <!-- First Name -->
                        <div class="col-12 col-md-4">
                            <label for="registrar_first_name" class="form-label required-asterisk">First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="registrar_first_name" name="registrar_first_name" required>
                        </div>
                        <!-- Email -->
                        <div class="col-12 col-md-4">
                            <label for="registrar_personal_email" class="form-label required-asterisk">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="registrar_personal_email" name="registrar_personal_email" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 col-md-6">
                            <label for="registrar_username" class="form-label required-asterisk">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="registrar_username" name="registrar_username" required>
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="registrar_password" class="form-label required-asterisk">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="registrar_password" name="registrar_password" required>
                        </div>
                    </div>
                    <button type="submit" id="registrarSubmitBtn" class="btn btn-success"><i class="fa-solid fa-check-to-slot"></i> Submit</button>
                    <button type="button" id="registrarUpdateBtn" class="btn btn-primary" style="display: none;"><i class="fa-solid fa-pen-to-square"></i> Update</button>
                    <button type="button" id="registrarCancelBtn" class="btn btn-secondary" style="display: none;"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                    <button type="button" id="registrarDeleteBtn" class="btn btn-danger" style="display: none;"><i class="fa-solid fa-trash"></i> Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>