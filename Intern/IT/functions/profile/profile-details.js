document.addEventListener('DOMContentLoaded', function() {
    // Set the active links
    const profileInfo = document.getElementById('profile-info');
    const passwordInfo = document.getElementById('account-info');
    const personalDetailsLink = document.querySelector('a[href="#profile-info"]');
    const passwordLink = document.querySelector('a[href="#account-info"]');

    personalDetailsLink.classList.add('active');

    // Add click event listeners to the links
    personalDetailsLink.addEventListener('click', function(e) {
        e.preventDefault();
        profileInfo.style.display = 'block';
        passwordInfo.style.display = 'none';
        personalDetailsLink.classList.add('active');
        passwordLink.classList.remove('active');
    });

    passwordLink.addEventListener('click', function(e) {
        e.preventDefault();
        profileInfo.style.display = 'none';
        passwordInfo.style.display = 'block';
        passwordLink.classList.add('active');
        personalDetailsLink.classList.remove('active');
    });
});


{/* <div class="row">
    <!-- Pending Status -->
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div>
            <label for="medical-certification" class="form-label">Medical Certification</label>
            <input type="file" class="form-control" id="medical-certification" name="medical_certification" required>
            </div>
            <div>
                <!-- Small Circle for Pending (Red) -->
                <div style="width: 15px; height: 15px; background-color: #dc3545; border-radius: 50%;"></div>
            </div>
        </div>
    </div>

    <!-- Submitted Status -->
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div>
            <label for="medical-certification" class="form-label">Medical Certification</label>
            <input type="file" class="form-control" id="medical-certification" name="medical_certification" required>
            </div>
            <div>
                <!-- Small Circle for Submitted (Orange) -->
                <div style="width: 15px; height: 15px; background-color: #fd7e14; border-radius: 50%;"></div>
            </div>
        </div>
    </div>

    <!-- Completed Status -->
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div>
            <label for="medical-certification" class="form-label">Medical Certification</label>
            <input type="file" class="form-control" id="medical-certification" name="medical_certification" required>
            </div>
            <div>
                <!-- Small Circle for Completed (Green) -->
                <div style="width: 15px; height: 15px; background-color: #28a745; border-radius: 50%;"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!-- Pending Status -->
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div>
            <label for="medical-certification" class="form-label">Medical Certification</label>
            <input type="file" class="form-control" id="medical-certification" name="medical_certification" required>
            </div>
            <div>
                <!-- Small Circle for Pending (Red) -->
                <div style="width: 15px; height: 15px; background-color: #dc3545; border-radius: 50%;"></div>
            </div>
        </div>
    </div>

    <!-- Submitted Status -->
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div>
            <label for="medical-certification" class="form-label">Medical Certification</label>
            <input type="file" class="form-control" id="medical-certification" name="medical_certification" required>
            </div>
            <div>
                <!-- Small Circle for Submitted (Orange) -->
                <div style="width: 15px; height: 15px; background-color: #fd7e14; border-radius: 50%;"></div>
            </div>
        </div>
    </div>

    <!-- Completed Status -->
    <div class="col-12 col-md-6 col-lg-4 mb-3">
        <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div>
            <label for="medical-certification" class="form-label">Medical Certification</label>
            <input type="file" class="form-control" id="medical-certification" name="medical_certification" required>
            </div>
            <div>
                <!-- Small Circle for Completed (Green) -->
                <div style="width: 15px; height: 15px; background-color: #28a745; border-radius: 50%;"></div>
            </div>
        </div>
    </div>
</div> */}