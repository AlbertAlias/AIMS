<div class="container-fluid p-0 m-0" id="dashboard" style="display: none;">
    <div class="row">
        <div class="col-md-8">
            <div class="col-12 col-md-12 col-lg-12 mb-3">
                <div class="card p-3"
                    style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                    <div class="text-center mb-2">
                        <div class="card-title fs-5 text-success fw-bold">OJT Hours</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="text-left">
                            <div class="fs-6 text-center">Hours Needed</div>
                            <div class="h4 text-center" id="hours_needed">0</div>
                        </div>

                        <div class="text-center">
                            <div class="fs-6 text-center">Hours Rendered</div>
                            <div class="h4 text-center" id="hours_rendered">0</div>
                        </div>

                        <div class="text-right">
                            <div class="fs-6 text-center">Hours Remaining</div>
                            <div class="h4 text-center" id="hours_remaining">0</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card task-title bg-success mb-4"
                style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px; transition: transform 0.3s ease;">
                <div class="d-flex justify-content-center align-items-center">
                    <div>
                        <div class="card-title fs-5 text-white fw-bold mt-1">Task</div>
                    </div>
                </div>
            </div>
            <div id="requirementsContainer"></div>
        </div>
    </div>
</div>