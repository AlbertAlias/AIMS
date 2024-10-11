<div class="container-fluid p-0 m-0" id="profile" style="display: none;">
    <div class="row">
        <!-- Profile Picture Section -->
        <div class="col-md-3 col-12 mb-3">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column align-items-center">
                <div style="position: relative;">
                    <img id="profile-picture" src="" alt="Profile Picture" class="rounded-circle" style="display: none; width: 148px; height: 145px; object-fit: cover;">
                    <span id="profile-initials-placeholder" class="initials-placeholder" style="display: none;"></span>
                    <i class="fa-solid fa-camera" id="camera-icon" data-user-id="<?php echo $_SESSION['user_id']; ?>" style="position: absolute; bottom: 8px; right: 6px; font-size: 20px; color: white; background-color: dimgray; border-radius: 50%; padding: 6px;"></i>
                    <input type="file" id="profile-picture-input" accept="image/png, image/jpeg" style="display: none;">
                </div>
                <!-- Add other profile-related elements here -->
            </div>
        </div>

        <!-- User Information Section -->
        <div class="col-md-9 col-12">
            <div class="bg-light rounded-3 shadow px-4 py-4">
                <!-- Personal Information Section -->
                <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Edit Personal Information</h5>
                <form id="editProfileForm">
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="" required>
                        </div>
                        <div class="col-md-7">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <label for="middle_name" class="form-label">Middle Name</label>
                            <input type="text" class="form-control" id="middle_name" name="middle_name" value="">
                        </div>
                        <div class="col-md-3">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input type="text" class="form-control" id="suffix" name="suffix" value="">
                        </div>
                        <div class="col-md-4">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="birthdate" class="form-label">Birthdate</label>
                            <input type="date" class="form-control" id="birthdate" name="birthdate" value="" required>
                        </div>
                        <div class="col-md-4">
                            <label for="civil_status" class="form-label">Civil Status</label>
                            <select class="form-select" id="civil_status" name="civil_status">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="contact_number" class="form-label">Contact Number</label>
                            <input type="tel" class="form-control" id="contact_number" name="contact_number" pattern="[0-9]{10}" maxlength="10" required>
                        </div>
                    </div>

                    <!-- Account Information Section -->
                    <h5 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Account Information</h5>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="account_email" class="form-label">Account Email</label>
                            <input type="email" class="form-control" id="account_email" name="account_email" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="col-md-6">
                            <label for="user_type" class="form-label">Role</label>
                            <!-- <select class="form-select" id="user_type" name="user_type"> -->
                                <option value="admin">Admin</option>
                                <option value="sub-admin">Sub-admin</option>
                            </select>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <button type="button" class="btn btn-secondary" id="cancelEdit"><i class="fa-solid fa-rotate-left"></i> Cancel</button>
                            <button type="submit" class="btn btn-primary"> <i class="fa-solid fa-check-to-slot"></i> Save</button>
                            <button type="button" class="btn btn-success"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>