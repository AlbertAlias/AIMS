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
                            <th>Student ID</th>
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

<div class="modal fade" id="evaluateModal" tabindex="-1" role="dialog" aria-labelledby="evaluateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="evaluateModalLabel">Evaluate Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="evaluationForm">
          <table class="table table-bordered">
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
              <tr>
                <td>Neatness and presentation of work</td>
                <td><input type="radio" name="quality3" value="5"></td>
                <td><input type="radio" name="quality3" value="4"></td>
                <td><input type="radio" name="quality3" value="3"></td>
                <td><input type="radio" name="quality3" value="2"></td>
                <td><input type="radio" name="quality3" value="1"></td>
              </tr>
              <tr>
                <td colspan="6"><strong>B. PRODUCTIVITY</strong></td>
              </tr>
              <tr>
                <td>Effective use of time</td>
                <td><input type="radio" name="quality4" value="5"></td>
                <td><input type="radio" name="quality4" value="4"></td>
                <td><input type="radio" name="quality4" value="3"></td>
                <td><input type="radio" name="quality4" value="2"></td>
                <td><input type="radio" name="quality4" value="1"></td>
              </tr>
              <tr>
                <td>Tasks accomplished</td>
                <td><input type="radio" name="quality5" value="5"></td>
                <td><input type="radio" name="quality5" value="4"></td>
                <td><input type="radio" name="quality5" value="3"></td>
                <td><input type="radio" name="quality5" value="2"></td>
                <td><input type="radio" name="quality5" value="1"></td>
              </tr>
              <tr>
                <td>Prompt completion of work assignments</td>
                <td><input type="radio" name="quality6" value="5"></td>
                <td><input type="radio" name="quality6" value="4"></td>
                <td><input type="radio" name="quality6" value="3"></td>
                <td><input type="radio" name="quality6" value="2"></td>
                <td><input type="radio" name="quality6" value="1"></td>
              </tr>
              <tr>
                <td>Useful or effective application of knowledge and skills</td>
                <td><input type="radio" name="quality7" value="5"></td>
                <td><input type="radio" name="quality7" value="4"></td>
                <td><input type="radio" name="quality7" value="3"></td>
                <td><input type="radio" name="quality7" value="2"></td>
                <td><input type="radio" name="quality7" value="1"></td>
              </tr>
              <tr>
                <td colspan="6"><strong>C. WORK HABITS, TALENTS & SKILLS</strong></td>
              </tr>
              <tr>
                <td>Appropriate attire</td>
                <td><input type="radio" name="quality8" value="5"></td>
                <td><input type="radio" name="quality8" value="4"></td>
                <td><input type="radio" name="quality8" value="3"></td>
                <td><input type="radio" name="quality8" value="2"></td>
                <td><input type="radio" name="quality8" value="1"></td>
              </tr>
              <tr>
                <td>Adherence to policies and procedures</td>
                <td><input type="radio" name="quality9" value="5"></td>
                <td><input type="radio" name="quality9" value="4"></td>
                <td><input type="radio" name="quality9" value="3"></td>
                <td><input type="radio" name="quality9" value="2"></td>
                <td><input type="radio" name="quality9" value="1"></td>
              </tr>
              <!-- Add more criteria as needed -->
            </tbody>
          </table>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="submitEvaluation()">Submit</button>
      </div>
    </div>
  </div>
</div>
