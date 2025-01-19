<div class="container-fluid p-0 m-0" id="studentlist" style="display: none;">
    <div class="card" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
        <div class="card-header bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-flex align-items-center">
                        <select id="stud-lists-pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Page length selector">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="flex-shrink-1">
                        <div class="input-group">
                            <input type="text" id="stud-lists-searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                            <button class="btn btn-success btn-sm" type="button">
                                <svg class="table-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path fill="#f3f3f3" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body bg-white p-0">
            <div class="table-responsive">
                <table id="stud-lists" class="table table-hover text-center m-0" style="width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Email</th>
                            <th>Supervisor</th>
                            <th>Company</th>
                            <th>Company Address</th>
                            <th>Final Grade</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="tdata">
                        <!-- Data will be loaded here via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card-footer bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <span class="mb-2" id="stud-lists-tableInfo">Showing 1 to 10 of 50 entries</span>
                <nav aria-label="Page navigation">
                    <ul id="stud-lists-pagination" class="pagination mb-0">
                        <!-- Pagination buttons will be generated here via AJAX -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ojthoursModal" tabindex="-1" aria-labelledby="ojthoursModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center w-100">
                <h5 class="text-center mb-0">OJT Hours</h5>
            </div>
            <div class="modal-body m-0 p-2">
                <div class="card shadow-sm">
                    <div class="card-header bg-light text-dark">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <div class="d-flex align-items-center">
                                <div class="d-flex align-items-center me-1">
                                    <select id="ojthours-pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Page length selector">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="flex-shrink-1">
                                    <div class="input-group">
                                        <input type="text" id="ojthours-searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                                        <button class="btn btn-sm btn-outline-secondary" type="button">
                                            <svg class="table-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="totalHoursDisplay" class="text-end">
                                Rendered Hours:
                            </div>
                        </div>
                    </div>

                    <div class="card-body bg-white p-0">
                        <div class="table-responsive">
                            <table id="ojthours" class="table table-hover text-center m-0" style="width: 100%;">
                                <thead class="table-light">
                                    <tr>
                                        <th>Submission Date</th>
                                        <th>Morning Start</th>
                                        <th>Lunch Start</th>
                                        <th>Lunch End</th>
                                        <th>Afternoon End</th>
                                        <th>Total Hours</th>
                                        <th>File</th>
                                    </tr>
                                </thead>
                                <tbody id="tdata">
                                    <!-- Data will be loaded here via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer bg-light text-dark">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <span class="mb-2" id="ojthours-tableInfo">Showing 0 to 0 of 0 entries</span>
                            <nav aria-label="Page navigation">
                                <ul id="ojthours-pagination" class="pagination mb-0">
                                    <!-- Pagination buttons will be generated here via AJAX -->
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div id="stud-ojthoursModal" class="modal" style="display: none;">
    <div class="ojthours-modal-content">
        <span id="ojthours-closeModal" class="close">&times;</span>
        <iframe id="ojthoursViewer" src="" frameborder="0"></iframe>
        <img id="ojtimageViewer" src="" alt="Preview" style="width: 100%; height: 100%; display: none;" />
    </div>
</div>