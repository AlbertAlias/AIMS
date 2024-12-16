<div class="container-fluid p-0 m-0" id="posting" style="display: none;">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-4 mb-3">
            <div class="post-container">
                <div class="post-header">
                    <h5 class="border-bottom border-black pb-2 mb-2">Post a Requirement</h5>
                    <!-- Requirement Title -->
                    <input type="text" class="form-control title" id="requirementTitle" placeholder="What's on your mind, Coordinator?">
                </div>
                <div class="post-body mb-2">
                    <!-- Requirement Description -->
                    <textarea rows="3" class="form-control" id="requirementDescription" placeholder="Write something..."></textarea>
                </div>
                <div class="post-footer d-flex justify-content-between align-items-center">
                    <div class="deadline-container">
                        <!-- Deadline Input -->
                        <input type="date" class="form-control deadline-input" id="deadline" placeholder="Set a deadline">
                    </div>
                    <div>
                        <!-- Post Button -->
                        <button class="btn btn-success" id="postRequirementBtn">Post</button>
                        <button class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8 col-lg-8">
        <!-- Dynamically populated requirement posts will appear here -->
        </div>
    </div>



</div>
