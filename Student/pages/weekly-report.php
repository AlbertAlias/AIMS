<div class="container-fluid bg-light p-0 m-0" id="weeklyreport" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
                <div class="card-body">
                    <h5 class="mb-2">Upload Weekly Report</h5>
                    <input type="hidden" class="student-id">
                    <form id="weeklyReportForm" method="POST" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="title" class="form-label">Report Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="mb-2">
                            <label for="week_start" class="form-label">Week Start</label>
                            <input type="date" class="form-control" name="week_start" id="week_start" required>
                        </div>
                        <div class="mb-2">
                            <label for="week_end" class="form-label">Week End</label>
                            <input type="date" class="form-control" name="week_end" id="week_end" required>
                        </div>
                        <div class="mb-2">
                            <label for="file" class="form-label">Attach File/Picture (PDF, JPG, PNG)</label>
                            <label class="btn btn-white d-flex align-items-center justify-content-center border-secondary mb-3" style="cursor: pointer;">
                                <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 144L48 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l144 0 0 144c0 17.7 14.3 32 32 32s32-14.3 32-32l0-144 144 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-144 0 0-144z"/>
                                </svg> Add File
                                <input type="file" id="reportInput" style="display: none;" accept=".png, .jpg, .jpeg, .pdf">
                            </label>
                            <div id="reportContainer" class="mt-1"></div>
                        </div>
                        <button id="turnInReportButton" class="btn btn-success w-100 mb-2" disabled>Turn in report</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12 col-lg-7">
            <h4 class="border-bottom border-secondary pb-2 mb-2">Weekly Reports</h4>
            <div id="weeklypostedRequirementsContainer" class="row"></div>
        </div>
    </div>
</div>

<div id="reportModal" class="modal" style="display: none;">
    <div class="report-modal-content">
        <span id="report-closeModal" class="close">&times;</span>
        <iframe id="reportViewer" src="" frameborder="0"></iframe>
        <img id="imageViewer" src="" alt="Preview" style="width: 100%; height: 100%; display: none;" />
    </div>
</div>