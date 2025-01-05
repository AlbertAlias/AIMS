<div class="container-fluid bg-light p-0 m-0" id="hours" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-3">
            <div class="card mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <div class="card-body">
                    <h5 class="mb-3">Submit OJT Hours</h5>
                    <!-- Morning Start Time -->
                    <div class="mb-3">
                        <label for="morningStartInput" class="form-label">Morning Start</label>
                        <input type="time" id="morningStartInput" class="form-control" required>
                    </div>
                    <!-- Lunch Start Time -->
                    <div class="mb-3" id="lunchStartContainer" style="display: none;">
                        <label for="lunchBreakStartInput" class="form-label">Lunch Break Start</label>
                        <input type="time" id="lunchBreakStartInput" class="form-control" required>
                    </div>
                    <!-- Lunch End Time -->
                    <div class="mb-3" id="lunchEndContainer" style="display: none;">
                        <label for="lunchBreakEndInput" class="form-label">Lunch Break End</label>
                        <input type="time" id="lunchBreakEndInput" class="form-control" required>
                    </div>
                    <!-- Afternoon End Time -->
                    <div class="mb-3" id="afternoonEndContainer" style="display: none;">
                        <label for="afternoonEndInput" class="form-label">Afternoon End</label>
                        <input type="time" id="afternoonEndInput" class="form-control" required>
                    </div>
                    <!-- Total Hours Display -->
                    <div class="mb-3">
                        <label for="totalHoursInput" class="form-label">Total Hours</label>
                        <input type="text" id="totalHoursInput" class="form-control" readonly>
                    </div>
                    <!-- File Upload Section -->
                    <div class="mb-3">
                        <label for="ojtfile" class="form-label">Attach File/Picture (PDF, JPG, PNG)</label>
                        <input type="file" class="form-control" name="ojtfile" id="ojtfile" accept=".png, .jpg, .jpeg, .pdf">
                        <div id="ojtfilePreview" style="margin-top: 15px;"></div>
                    </div>
                    <!-- Submit Button -->
                    <button id="submitHoursButton" class="btn btn-success w-100 mb-2" disabled>Submit Hours</button>
                </div>
            </div>
            <div id="uploadedHoursContainer"></div>
        </div>

        <div class="col-12 col-md-12 col-lg-9">
            <div class="card shadow-sm">
                <!-- Header -->
                <div class="card-header bg-light text-dark">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <!-- Page Length Selector -->
                        <div class="d-flex align-items-center">
                            <div class="d-flex align-items-center me-1">
                                <select id="ojthours-pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Page length selector">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <!-- Search Input -->
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
                        <!-- Total Hours Display (to the right) -->
                        <div id="totalHoursDisplay" class="text-end">
                            Rendered Hours:
                        </div>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body bg-white p-0">
                    <!-- Table Placeholder -->
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

                <!-- Footer -->
                <div class="card-footer bg-light text-dark">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <span class="mb-2" id="ojthours-tableInfo">Showing 0 to 0 of 0 entries</span>
                        <!-- Pagination -->
                        <nav aria-label="Page navigation">
                            <ul id="ojthours-pagination" class="pagination mb-0">
                                <!-- Pagination buttons will be generated here via AJAX -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="ojthoursModal" class="modal" style="display: none;">
    <div class="ojthours-modal-content">
        <span id="ojthours-closeModal" class="close">&times;</span>
        <iframe id="ojthoursViewer" src="" frameborder="0"></iframe>
        <img id="ojtimageViewer" src="" alt="Preview" style="width: 100%; height: 100%; display: none;" />
    </div>
</div>