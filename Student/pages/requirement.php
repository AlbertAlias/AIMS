<div class="container-fluid p-0 m-0" id="requirement" style="display: none;">
    <!-- Upload Document Modal -->
<div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-labelledby="uploadDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadDocumentModalLabel">Upload Required Documents</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="submitDocument.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="requirement_id" id="requirement_id">
                    <div class="mb-3">
                        <label for="document" class="form-label">Select Document</label>
                        <input type="file" class="form-control" id="document" name="document" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Document</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>