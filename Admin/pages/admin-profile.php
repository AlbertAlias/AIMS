<div class="container-fluid p-0 m-0" style="display: none;" id="profile">
    <div class="row">
        <div class="col-md-3 col-12 mb-3">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column align-items-center">
                <div style="position: relative; display: flex; flex-direction: column; align-items: center;">
                    <img id="profile-picture" src="" alt="Profile Picture" style="display: none; width: 148px; height: 145px; border-radius: 50%; object-fit: cover;">
                    <span id="profile-initials-placeholder" class="initials-placeholder" style="display: none;"></span>
                    <i class="fa-solid fa-camera" id="camera-icon" data-user-id="<?php echo $_SESSION['user_id']; ?>" style="cursor: pointer; position: absolute; bottom: 8px; right: 6px; font-size: 20px; color: white; background-color: dimgray; border-radius: 50%; padding: 6px;"></i>
                    <input type="file" id="profile-picture-input" accept="image/png, image/jpeg" style="display: none;">
                </div>
                <!-- Add any other profile-related elements here -->
            </div>
        </div>
        <div class="col-md-9 col-12">
            <div class="bg-light rounded-3 shadow px-4 py-4 d-flex flex-column">
                <!-- Add any other admin information here -->
            </div>
        </div>
    </div>
</div>
