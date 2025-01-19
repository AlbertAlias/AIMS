<div class="container-fluid bg-light p-0 m-0" id="requirements-folder" style="display: none;">
    <ul class="nav nav-tabs" id="folderTabs">
        <li class="nav-item">
            <a class="nav-link active text-success" id="requirements-tab" data-bs-toggle="tab" href="#requirements" role="tab" aria-controls="requirements" aria-selected="true">Requirements</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success" id="weekly-reports-tab" data-bs-toggle="tab" href="#weekly-reports" role="tab" aria-controls="weekly-reports" aria-selected="false">Weekly Reports</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-success" id="ojt-hours-tab" data-bs-toggle="tab" href="#ojt-hours" role="tab" aria-controls="ojt-hours" aria-selected="false">OJT Hours</a>
        </li>
    </ul>

    <div class="tab-content py-2 px-1">
        <div class="tab-pane fade show active" id="requirements" role="tabpanel" aria-labelledby="requirements-tab">
            <div id="requirements-content">
            </div>
        </div>
        <div class="tab-pane fade" id="weekly-reports" role="tabpanel" aria-labelledby="weekly-reports-tab">
        </div>
        <div class="tab-pane fade" id="ojt-hours" role="tabpanel" aria-labelledby="ojt-hours-tab">
        </div>
    </div>
</div>

<div id="fileModal" class="file-modal" style="display: none;">
    <div class="file-modal-content">
        <span id="closeModal" class="close">&times;</span>
        <embed id="fileViewer" width="100%" height="100%" type="application/pdf">
        <img id="fileimageViewer" src="" alt="Preview" style="width: 100%; height: 100%; display: none;" />
    </div>
</div>