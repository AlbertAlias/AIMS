<div class="container-fluid bg-light p-0 m-0" id="masterlists" style="display: none;">
    <div class="card" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
        <div class="card-header bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center gap-2">
                    <div class="d-flex align-items-center">
                        <select id="master-lists-pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Page length selector">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="dropdown">
                        <select id="userTypeDropdown" class="form-select form-select-sm">
                            <option value="">Select User Type</option>
                        </select>
                    </div>
                    <div class="dropdown">
                        <select id="departmentDropdown" class="form-select form-select-sm" style="display: none;">
                            <option value="">Select Department</option>
                        </select>
                    </div>
                    <div class="dropdown">
                        <select id="companyDropdown" class="form-select form-select-sm" style="display: none;">
                            <option value="">Select Company</option>
                        </select>
                    </div>
                </div>
                <div class="flex-shrink-1">
                    <div class="input-group">
                        <input type="text" id="master-lists-searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                        <button class="btn btn-success btn-sm" type="button">
                            <svg class="table-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path fill="#f3f3f3" d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body bg-white p-0">
            <div class="table-responsive">
                <table id="master-lists" class="table table-hover text-center m-0" style="width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Company</th>
                            <th>Email</th>
                            <th>AY</th>
                            <th>Username</th>
                            <th>User Type</th>
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
                <span class="mb-2" id="master-lists-tableInfo">Showing 0 to 0 of 0 entries</span>
                <nav aria-label="Page navigation">
                    <ul id="master-lists-pagination" class="pagination mb-0">
                        <!-- Pagination buttons will be generated here via AJAX -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>