<div class="container-fluid p-0 m-0" id="dashboard" style="display: none;">

    <div class="row">
        <!-- First Row of 4 Containers -->
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card bg-light p-2 shadow" style="height: 105px;">
                <div class="card-body text-start d-flex justify-content-between align-items-center h-100">
                    <div>
                        <h4 class="card-title">Departments</h4>
                        <span id="num-departments" class="num-light">0</span>
                    </div>
                    <i class="fa-solid fa-scroll fs-3 text-secondary"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card bg-light p-2 shadow" style="height: 105px;">
                <div class="card-body text-start d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Coordinators</h4>
                        <span id="num-coordinators" class="num-light">0</span>
                    </div>
                    <i class="fa-solid fa-users fs-3 text-secondary"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card bg-light p-2 shadow" style="height: 105px;">
                <div class="card-body text-start d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Interns</h4>
                        <span id="num-interns" class="num-light">0</span>
                    </div>
                    <i class="fa-solid fa-user-graduate fs-3 text-secondary"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card bg-light p-2 shadow" style="height: 105px;">
                <div class="card-body text-start d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Supervisors</h4>
                        <span id="num-supervisors" class="num-light">0</span>
                    </div>
                    <i class="fa-solid fa-user-tie fs-3 text-secondary"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row of 4 Containers -->
    <div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card bg-light p-2 shadow" style="height: 105px;">
                <div class="card-body text-start d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="card-title">Admins</h4>
                        <span id="num-admins" class="num-light">0</span>
                    </div>
                    <i class="fa-solid fa-user-shield fs-3 text-secondary"></i>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card bg-light p-2 shadow" style="height: 105px;">
                <div class="card-body text-start">
                    <h4 class="card-title">Container 6</h4>
                    <p class="card-text">This is container 6.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card bg-light p-2 shadow" style="height: 105px;">
                <div class="card-body text-start">
                    <h4 class="card-title">Container 7</h4>
                    <p class="card-text">This is container 7.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card bg-light p-2 shadow" style="height: 105px;">
                <div class="card-body text-start">
                    <h4 class="card-title">Container 8</h4>
                    <p class="card-text">This is container 8.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <script>
    $(document).ready(function() {
        function fetchAdminCount() {
            $.ajax({
                url: '../controller/dashboards/retrieve-adminCounts.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#num-admins').text(data.count);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching admin count:', error);
                    $('#num-admins').text('0');
                }
            });
        }

        fetchAdminCount();
    });

    $(document).ready(function() {
        function fetchCoordinatorCount() {
            $.ajax({
                url: '../controller/dashboards/retrieve-coorCounts.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#num-coordinators').text(data.count);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching coordinator count:', error);
                    $('#num-coordinators').text('0'); // Fallback in case of error
                }
            });
        }

        fetchCoordinatorCount(); // Call the function to fetch count
    });

    $(document).ready(function() {
        function updateDepartmentCount() {
            $.ajax({
                url: '../controller/dashboards/retrieve-deptCounts.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log("AJAX Success:", data);
                    if (data.count !== undefined) {
                        $('#num-departments').text(data.count);
                    } else {
                        $('#num-departments').text('0');
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                    $('#num-departments').text('0');
                }
            });
        }

        updateDepartmentCount();
    });

    $(document).ready(function() {
        function fetchInternCount() {
            $.ajax({
                url: '../controller/dashboards/retrieve-internCounts.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#num-interns').text(data.count);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching intern count:', error);
                    $('#num-interns').text('0');
                }
            });
        }

        fetchInternCount();
    });
</script> -->