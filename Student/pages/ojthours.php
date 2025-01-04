<div class="container-fluid bg-light p-0 m-0" id="hours" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-4">
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
        </div>

        <div class="col-12 col-md-12 col-lg-8">
            <h5 class="border-bottom border-secondary pb-2 mb-2">Uploaded Hours</h5>
            <div id="uploadedHoursContainer"></div>
        </div>
    </div>
</div>
