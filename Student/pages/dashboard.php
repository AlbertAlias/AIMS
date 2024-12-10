<div class="container-fluid p-0 m-0" id="dashboard" style="display: none;">
    <div class="row">
        <!-- Left Container -->
        <div class="col-md-8">
            <!-- Full-width Container -->
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="card p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                    <!-- OJT Hours at the top center -->
                    <div class="text-center mb-2">
                        <div class="card-title fs-4 text-success">OJT Hours</div>
                    </div>

                    <!-- Left and Right Section with Hours Needed and Hours Remaining -->
                    <div class="d-flex justify-content-between">
                        <!-- Left Side: Hours Needed -->
                        <div class="text-left">
                            <div class="fs-6">Hours Needed</div>
                            <div class="h4">600 Hours</div>
                        </div>

                        <!-- Right Side: Hours Remaining -->
                        <div class="text-right">
                            <div class="fs-6">Hours Remaining</div>
                            <div class="h4">590 Hours</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Pending Status -->
                <div class="col-12 col-md-6 col-lg-6 mb-3">
                    <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                        <div>
                            <div class="card-title fs-6">Pending</div>
                            <div id="num-pending" class="h2">1</div>
                        </div>
                        <div>
                            <!-- Small Circle for Pending (Red) -->
                            <div style="width: 15px; height: 15px; background-color: #dc3545; border-radius: 50%;"></div>
                        </div>
                    </div>
                </div>
                <!-- Submitted Status -->
                <div class="col-12 col-md-6 col-lg-6 mb-3">
                    <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                        <div>
                            <div class="card-title fs-6">Submitted</div>
                            <div id="num-submitted" class="h2">1</div>
                        </div>
                        <div>
                            <!-- Small Circle for Submitted (Orange) -->
                            <div style="width: 15px; height: 15px; background-color: #fd7e14; border-radius: 50%;"></div>
                        </div>
                    </div>
                </div>
                <!-- Completed Status -->
                <div class="col-12 col-md-6 col-lg-6 mb-3">
                    <div class="card d-flex flex-row justify-content-between align-items-center p-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                        <div>
                            <div class="card-title fs-6">Completed</div>
                            <div id="num-completed" class="h2">2</div>
                        </div>
                        <div>
                            <!-- Small Circle for Completed (Green) -->
                            <div style="width: 15px; height: 15px; background-color: #28a745; border-radius: 50%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Container for Requirements (Dynamic Content) -->
        <div class="col-md-4">
            <div class="card task-header mb-3" style="background-color: #198754; box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px; border-radius: 12px; transition: transform 0.3s ease;">
                <div class="d-flex justify-content-center align-items-center">
                        <div class="card-title fs-5 text-light fw-bold mt-1">Task</div>
                </div>
            </div>
            <div id="requirementsContainer">
                <!-- Dynamic requirement items will be appended here -->
            </div>
        </div>

        <div class="col-md-4">
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title fs-5 text-primary">Pass the MOA until the first week of internship</div>
                            <div class="card-text fs-6">Please accomplish this as soon as possible</div>
                        </div>

                        <div class="card p-2 text-center bg-danger" style="color: white; cursor: pointer; border: none; border-radius: 5px;">
                            <div class="card-text fs-6">Pending</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title fs-5 text-primary">Pass the Medical Certificate</div>
                            <div class="card-text fs-6">Deadline: Dec 09, 2024</div>
                        </div>

                        <div class="card p-2 text-center bg-warning" style="color: white; cursor: pointer; border: none; border-radius: 5px;">
                            <div class="card-text fs-6">Submitted</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title fs-5 text-primary">Pass the Birth Certificate or PSA</div>
                            <div class="card-text fs-6">Deadline: Dec 09, 2024</div>
                        </div>

                        <div class="card p-2 text-center bg-success" style="color: white; cursor: pointer; border: none; border-radius: 5px;">
                            <div class="card-text fs-6">Completed</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <div class="card-title fs-5 text-primary">Pass the Resume</div>
                            <div class="card-text fs-6">Deadline: Nov 27, 2024</div>
                        </div>

                        <div class="card p-2 text-center bg-success" style="color: white; cursor: pointer; border: none; border-radius: 5px;">
                            <div class="card-text fs-6">Completed</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>

<!-- <div class="row"> -->
        <!-- Left container for general info -->
        <!-- <div class="col-12 col-md-6">
            <div class="bg-white rounded shadow-sm p-4 d-flex flex-column" style="min-height: 220px;">
                <h5 class="text-dark fw-bold border-bottom pb-2 mb-3">Department Information</h5>
                <div class="mb-3 position-relative">
                <p>No department information available at the moment.</p>
                </div>
            </div>
        </div> -->

        <!-- Right container for Coordinator's posted requirements -->
        <!-- <div class="col-12 col-md-6">
            <div class="bg-white rounded shadow-sm p-4 d-flex flex-column" style="min-height: 220px;">
                <h5 class="text-dark fw-bold border-bottom pb-2 mb-3">Coordinator's Posted Requirements</h5>
                <div id="requirementsContainer" class="text-muted"> -->
                <!-- Dynamically populated requirements will be inserted here -->
                <!-- </div>
            </div>
        </div>
    </div> -->

    <!-- Submission Modal -->
    <!-- <div class="modal fade" id="submissionModal" tabindex="-1" aria-labelledby="submissionModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="submissionModalLabel">Submit Required Documents</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="submissionForm" action="submit_documents.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="requirementId" name="requirement_id" value="">
            <div class="mb-3">
                <label for="documents" class="form-label">Upload Documents</label>
                <input type="file" class="form-control" id="documents" name="file" required>
                <small class="text-muted">You can upload multiple files (e.g., PDFs, Word Documents).</small>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
        </div>
    </div> -->

</div>