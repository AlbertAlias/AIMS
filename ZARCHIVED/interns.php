                <!-- CSV Export Button -->
                <button id="exportCSVBtn" class="btn btn-primary mt-2">
                    <i class="fa-solid fa-file-excel"></i> Download Excel File
                </button>

<!-- Download Progress -->
<div id="downloadProgress" class="mt-4" style="display: none; padding: 10px; border-radius: 5px;">
                    <div class="d-flex align-items-center justify-content-between" style="width: 100%;">
                        <div class="d-flex align-items-center flex-grow-1">
                            <i class="fa-solid fa-file-excel" style="font-size: 30px; color: green;"></i>
                            <div class="ms-2">
                                <span id="downloadFileName">intern-lists_template.xlsx</span>
                                <div class="progress mb-1" style="width: 180px; height: 15px;">
                                    <div id="downloadProgressBar" class="progress-bar progress-bar-striped progress-bar-animated" 
                                        role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        <span id="downloadProgressPercent" class="text-end d-block me-1">0%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span id="downloadCompleteIcon" style="display: none;">
                            <i class="fa-solid fa-check" style="font-size: 15px; color: green;"></i>
                        </span>
                    </div>
                </div>