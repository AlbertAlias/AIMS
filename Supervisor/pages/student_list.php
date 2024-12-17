<div class="container-fluid p-0 m-0" id="evaluation" style="display: none;">
    <div class="card shadow-sm">
        <!-- Header -->
        <div class="card-header bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <!-- Page Length Selector -->
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <label for="pageLengthSelect" class="form-label mb-0 me-2">Show</label>
                        <select id="stud-lists-pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Page length selector">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <!-- Search Input -->
                <div class="flex-shrink-1">
                    <div class="input-group">
                        <input type="text" id="stud-lists-searchInput" class="form-control form-control-sm" placeholder="Search..." aria-label="Search">
                            <button class="btn btn-outline-secondary btn-sm" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                     </div>
                </div>
            </div>
        </div>
        
        <!-- Body -->
        <div class="card-body bg-white p-0">
            <!-- Table Placeholder -->
            <div class="table-responsive">
                <table id="stud-lists" class="table table-hover text-center m-0" style="width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Lastname</th>
                            <th>Department</th>
                            <!-- <th>Student ID</th> -->
                            <th>Actions</th>
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
                <span id="stud-lists-tableInfo">Showing 1 to 10 of 50 entries</span>
                <!-- Pagination -->
                <nav aria-label="Page navigation">
                    <ul id="stud-lists-pagination" class="pagination mb-0">
                        <!-- Pagination buttons will be generated here via AJAX -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Custom Container -->
</div>
<!-- End Page Content -->

<!-- <div class="modal fade" id="evaluateModal" tabindex="-1" role="dialog" aria-labelledby="evaluateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="evaluateModalLabel">Evaluate Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="evaluationForm">
          <input type="hidden" id="student_id">
          <div class="form-group">
            <label for="evaluationScore">Score:</label>
            <input type="number" class="form-control" id="evaluationScore" placeholder="Enter score (0-100)" required>
          </div>
          <div class="form-group">
            <label for="comments">Comments:</label>
            <textarea class="form-control" id="comments" placeholder="Enter comments here..."></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitEvaluation()">Submit</button>
      </div>
    </div>
  </div>
</div> -->

<!-- Evaluation Modal -->
<div class="modal fade" id="evaluationModal" tabindex="-1" aria-labelledby="evaluationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header bg-light">
                <!-- <h5 class="modal-title" id="evaluationModalLabel">Performance Evaluation Form</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <!-- Modal Body -->
            <div class="modal-body">
                <header class="text-center">
                    <h1>ASIATECH COLLEGE OF STA. ROSA</h1>
                    <h2>COLLEGE OF ENGINEERING AND INFORMATION TECHNOLOGY EDUCATION</h2>
                    <h3>PERFORMANCE EVALUATION FORM</h3>
                    <p>(Practicum Training)</p>
                </header>
                <div id="main">
                    <p>Name of Student: ___________________________________    Course: ________________________________</p>
                </div>
                <div id="main1">
                    <p>Date Covered: From_________________ to _____________    Department: ______________________________</p>
                </div>
                <div id="instructions">
                    <p>To the Rater:</p>
                    <p>This form has been developed to monitor the performance of each practicum trainee not only for grading purposes but also to provide a basis for identifying his/her strengths & weaknesses:</p>
                    <p>Kindly rate the trainee in each of the traits indicated below by encircling the appropriate number that corresponds to your OBJECTIVE EVALUATION of his/her performance in your department using the scale provided.</p>
                    <p>
                        5 – Outstanding (O)<br>
                        4 – Very Satisfactory (VS)<br>
                        3 – Satisfactory (S)<br>
                        2 – Needs Improvement (NI)<br>
                        1 – Unacceptable (U)
                    </p>
                </div>
                <table class="table table-bordered table-striped text-center">
                    <thead>
                        <tr>
                            <th>CRITERIA</th>
                            <th>O (5)</th>
                            <th>VS (4)</th>
                            <th>S (3)</th>
                            <th>NI (2)</th>
                            <th>U (1)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="6"><strong>A. QUALITY OF WORK</strong></td>
                        </tr>
                        <tr>
                            <td>Accuracy of completed work according to the operational standards</td>
                            <td><input type="radio" name="quality1" value="5"></td>
                            <td><input type="radio" name="quality1" value="4"></td>
                            <td><input type="radio" name="quality1" value="3"></td>
                            <td><input type="radio" name="quality1" value="2"></td>
                            <td><input type="radio" name="quality1" value="1"></td>
                        </tr>
                        <tr>
                            <td>Thoroughness and attention to detail in performing the assigned tasks</td>
                            <td><input type="radio" name="quality2" value="5"></td>
                            <td><input type="radio" name="quality2" value="4"></td>
                            <td><input type="radio" name="quality2" value="3"></td>
                            <td><input type="radio" name="quality2" value="2"></td>
                            <td><input type="radio" name="quality2" value="1"></td>
                        </tr>
                        <!-- Continue the rest of your rows similarly -->
                    </tbody>
                </table>
            </div>
            
            <!-- Modal Footer -->
            <div class="modal-footer bg-light">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                <button type="submit" class="btn btn-primary">Submit Evaluation</button>
            </div>
        </div>
    </div>
</div>