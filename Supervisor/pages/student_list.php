<div class="container-fluid p-0 m-0" id="evaluation" style="display: none;">
    <div class="card shadow-sm mt-4">
        <!-- Header -->
        <div class="card-header bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <!-- Left section (Page Length and Search) -->
                <div class="d-flex align-items-center">
                    <!-- Page Length Selector -->
                    <div class="d-flex align-items-center me-3 mb-2 mb-sm-0">
                        <label for="pageLengthSelect" class="form-label mb-0 me-2">Show</label>
                        <select id="pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Page length selector">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <!-- Search Input -->
                    <div class="ms-3 flex-shrink-1">
                        <div class="input-group">
                            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                            <button id="searchButton" class="btn btn-outline-secondary btn-sm" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="card-body bg-white p-0">
            <!-- Table Placeholder -->
            <div class="table-responsive">
                <table id="usersTable" class="table table-hover text-center m-0" style="width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Company</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="studentTableBody">
                        <!-- Data will be dynamically loaded here via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer -->
        <div class="card-footer bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <span id="tableInfo">Showing 0 to 0 of 0 entries</span>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul id="pagination" class="pagination mb-0">
                        <!-- Pagination buttons will dynamically populate here via AJAX -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Evaluation Modal -->
<div class="modal fade" id="evaluationModal" tabindex="-1" aria-labelledby="evaluationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evaluationModalLabel">Evaluate Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Evaluation Form -->
                <form id="evaluationForm">
                    <input type="hidden" id="studentId" name="studentId">
                    <div class="mb-3">
                        <label for="evaluationRemarks" class="form-label">Remarks</label>
                        <textarea class="form-control" id="evaluationRemarks" name="remarks" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
