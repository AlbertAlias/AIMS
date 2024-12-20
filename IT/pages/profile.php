<div class="container-fluid p-0 m-0" id="profile" style="display: none;">
    <!-- User Information Section -->
    <div class="col-md-9 col-12">
        <div class="bg-light rounded-3 px-2" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="row">
                <div class="col-md-4 d-flex flex-column align-items-center py-4" style="border-right: 2px solid #ddd;">
                    <div class="profile-wrapper" style="position: relative;">
                        <div id="profile-picture-container">
                            <svg id="default-profile-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                            </svg>
                            <img id="profile-picture" src="" alt="Profile Picture" class="rounded-circle" style="display: none;">
                        </div>
                        <svg id="user-profile" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-user-id="<?php echo $_SESSION['user_id']; ?>">
                            <path d="M149.1 64.8L138.7 96 64 96C28.7 96 0 124.7 0 160L0 416c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64l-74.7 0L362.9 64.8C356.4 45.2 338.1 32 317.4 32L194.6 32c-20.7 0-39 13.2-45.5 32.8zM256 192a96 96 0 1 1 0 192 96 96 0 1 1 0-192z"/>
                        </svg>
                        <input type="file" id="profile-picture-input" accept="image/png, image/jpeg" style="display: none;">
                    </div>
                    <!-- Sidebar Navigation -->
                    <div class="mt-3 w-100">
                        <div class="list-group">
                            <a href="#profile-info" class="list-group-item list-group-item-action active">Profile</a>
                            <a href="#account-info" class="list-group-item list-group-item-action">Account</a>
                        </div>
                    </div>
                </div>

                <!-- Form Section on the Right Side -->
                <div class="col-md-8 py-3">
                    <!-- Personal Information Section -->
                    <div id="profile-info" style="display: block;">
                        <h6 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Personal Information</h6>
                        <form>
                            <div class="mt-2 mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="name">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512l388.6 0c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304l-91.4 0z"/>
                                    </svg>
                                    <span id="users-name"></span>
                                </label>
                                <button type="button" id="nameEditBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editNameModal">
                                    <svg class="edit-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                    </svg> 
                                    Edit
                                </button>
                            </div>
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="location">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                                        <path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z"/>
                                    </svg>
                                    <span id="users-location"></span>
                                </label>
                                <button type="button" id="locEditBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editLocationModal">
                                    <svg class="edit-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                    </svg> 
                                    Edit
                                </button>
                            </div>
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="gender">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path d="M176 288a112 112 0 1 0 0-224 112 112 0 1 0 0 224zM352 176c0 86.3-62.1 158.1-144 173.1l0 34.9 32 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-32 0 0 32c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-32-32 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l32 0 0-34.9C62.1 334.1 0 262.3 0 176C0 78.8 78.8 0 176 0s176 78.8 176 176zM271.9 360.6c19.3-10.1 36.9-23.1 52.1-38.4c20 18.5 46.7 29.8 76.1 29.8c61.9 0 112-50.1 112-112s-50.1-112-112-112c-7.2 0-14.3 .7-21.1 2c-4.9-21.5-13-41.7-24-60.2C369.3 66 384.4 64 400 64c37 0 71.4 11.4 99.8 31l20.6-20.6L487 41c-6.9-6.9-8.9-17.2-5.2-26.2S494.3 0 504 0L616 0c13.3 0 24 10.7 24 24l0 112c0 9.7-5.8 18.5-14.8 22.2s-19.3 1.7-26.2-5.2l-33.4-33.4L545 140.2c19.5 28.4 31 62.7 31 99.8c0 97.2-78.8 176-176 176c-50.5 0-96-21.3-128.1-55.4z"/>
                                    </svg>
                                    <span id="users-gender"></span>
                                </label>
                                <button type="button" id="genderEditBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editGenderModal">
                                    <svg class="edit-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                    </svg> 
                                    Edit
                                </button>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="form-label" for="email">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                    </svg>
                                    <span id="users-email"></span>
                                </label>
                                <button type="button" id="emailEditBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editEmailModal">
                                    <svg class="edit-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                    </svg> 
                                    Edit
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Password Change Section -->
                    <div id="account-info" style="display: none;">
                        <h6 class="text-gray-800 fw-bold border-bottom border-dark pb-2 mb-3">Account Settings</h6>
                        <form>
                            <!-- Username (New Section) -->
                            <div class="mb-3 d-flex justify-content-between align-items-center">
                                <label class="form-label" for="username" style="flex-grow: 1;">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48L48 64zM0 176L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-208L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/>
                                    </svg>
                                    <span id="users-username"></span>
                                    <input type="text" id="username-input" class="form-control form-control-sm" style="display: none;" value="">
                                </label>
                                <button type="button" id="editUsernameBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#editUsernameModal">
                                    <svg class="edit-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M362.7 19.3L314.3 67.7 444.3 197.7l48.4-48.4c25-25 25-65.5 0-90.5L453.3 19.3c-25-25-65.5-25-90.5 0zm-71 71L58.6 323.5c-10.4 10.4-18 23.3-22.2 37.4L1 481.2C-1.5 489.7 .8 498.8 7 505s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L421.7 220.3 291.7 90.3z"/>
                                    </svg> 
                                    Edit
                                </button>
                            </div>

                            <!-- Password Settings -->
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" id="changePasswordBtn" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                                    <svg class="edit-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M336 352c97.2 0 176-78.8 176-176S433.2 0 336 0S160 78.8 160 176c0 18.7 2.9 36.8 8.3 53.7L7 391c-4.5 4.5-7 10.6-7 17l0 80c0 13.3 10.7 24 24 24l80 0c13.3 0 24-10.7 24-24l0-40 40 0c13.3 0 24-10.7 24-24l0-40 40 0c6.4 0 12.5-2.5 17-7l33.3-33.3c16.9 5.4 35 8.3 53.7 8.3zM376 96a40 40 0 1 1 0 80 40 40 0 1 1 0-80z"/>
                                    </svg>
                                    Change Password
                                </button> 
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Name -->
<div class="modal fade" id="editNameModal" tabindex="-1" aria-labelledby="editNameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editNameModalLabel">Edit Name</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Last Name -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="editLastNameInput" placeholder="Last name">
                </div>
                
                <!-- First Name -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="editFirstNameInput" placeholder="First name">
                </div>
                
                <!-- Middle Name -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="editMiddleNameInput" placeholder="Middle name">
                </div>

                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Location -->
<div class="modal fade" id="editLocationModal" tabindex="-1" aria-labelledby="editLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLocationModalLabel">Edit Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="editLocationInput" placeholder="Enter new location">
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Gender -->
<div class="modal fade" id="editGenderModal" tabindex="-1" aria-labelledby="editGenderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGenderModalLabel">Edit Gender Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Dropdown for Gender -->
                <select class="form-select" id="editGenderInput">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Email -->
<div class="modal fade" id="editEmailModal" tabindex="-1" aria-labelledby="editEmailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmailModalLabel">Edit Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="email" class="form-control" id="editEmailInput" placeholder="Enter new email">
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Username -->
<div class="modal fade" id="editUsernameModal" tabindex="-1" aria-labelledby="editUsernameModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUsernameModalLabel">Edit Username</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" id="editUsernameInput" placeholder="Enter new username">
                <div class="d-flex justify-content-end mt-3">
                    <button type="button" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="changePasswordForm">
                    <div class="mb-3 position-relative">
                        <label for="modalOldPassword" class="form-label">Old Password</label>
                        <input type="password" id="modalOldPassword" class="form-control" required>
                        <!-- Feedback positioned above the input field, to the right -->
                        <span id="oldPasswordFeedback" class="position-absolute"></span>
                    </div>
                    <div class="mb-3">
                        <label for="modalNewPassword" class="form-label">New Password</label>
                        <input type="password" id="modalNewPassword" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="modalConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" id="modalConfirmPassword" class="form-control" required>
                        <span id="passwordFeedback" class="position-absolute text-danger"></span>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>