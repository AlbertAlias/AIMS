<div class="container-fluid bg-light p-0 m-0" id="requirements" style="display: none;">
    <div class="row">
        <!-- Left Container -->
        <div class="col-md-9">
            <div class="container p-3">
                <!-- Links aligned horizontally -->
                <div class="d-flex justify-content-between mb-4">
                    <a href="#" class="btn btn-outline-primary text-dark active" id="filter-all">All</a>
                    <a href="#" class="btn btn-outline-danger text-dark" id="filter-pending">Pending</a>
                    <a href="#" class="btn btn-outline-warning text-dark" id="filter-submitted">Submitted</a>
                    <a href="#" class="btn btn-outline-success text-dark" id="filter-completed">Completed</a>
                </div>

                <!-- Content will be dynamically displayed below the buttons -->
                <div id="requirements-content">
                    <div class="col-12 col-md-12 col-lg-12 mb-3">
                        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title fs-5 text-danger">Pass the MOA until the first week of internship</div>
                                    <div class="card-text fs-6">Please accomplish this as soon as possible</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 mb-3">
                        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title fs-5 text-warning">Pass the Medical Certificate</div>
                                    <div class="card-text fs-6">Deadline: Dec 09, 2024</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 mb-3">
                        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title fs-5 text-success">Pass the Birth Certificate or PSA</div>
                                    <div class="card-text fs-6">Deadline: Dec 01, 2024</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-12 mb-3">
                        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="card-title fs-5 text-success">Pass the Resume</div>
                                    <div class="card-text fs-6">Deadline: Nov 27, 2024</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Container -->
        <div class="col-md-3">
            <!-- Container with border-radius and buttons -->
            <div class="container bg-white p-4 rounded-3" style="border-radius: 7px; border: 1px solid #ddd;">
                <h5>Your Files</h5>
                <!-- Submit Files Button -->
                <div class="mt-4">
                    <button class="btn btn-primary w-100" id="submit-files">Submit Files</button>
                </div>
                <!-- Mark as Done Button -->
                <div class="mt-3">
                    <button class="btn btn-success w-100" id="mark-done">Mark as Done</button>
                </div>
            </div>
        </div>
    </div>
</div>