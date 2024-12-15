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

          <!-- List of 15 evaluation criteria -->
          <div class="form-group">
            <label>1. Accuracy of completed work according to the operational standards</label>
            <select class="form-control" name="ratings[1]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>2. Thoroughness and attention to detail in performing the assigned tasks</label>
            <select class="form-control" name="ratings[2]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>3. Neatness and presentation of work</label>
            <select class="form-control" name="ratings[3]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>4. Effective use of time</label>
            <select class="form-control" name="ratings[4]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>5. Tasks accomplished</label>
            <select class="form-control" name="ratings[5]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>6. Prompt completion of work assignments</label>
            <select class="form-control" name="ratings[6]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>7. Useful or effective application of knowledge and skills</label>
            <select class="form-control" name="ratings[7]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>8. Appropriate attire</label>
            <select class="form-control" name="ratings[8]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>9. Adherence to policies and procedures</label>
            <select class="form-control" name="ratings[9]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>10. Attendance and punctuality</label>
            <select class="form-control" name="ratings[10]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>11. Ability to communicate effectively to guest, supervisor, and colleagues</label>
            <select class="form-control" name="ratings[11]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>12. Ability to think independently</label>
            <select class="form-control" name="ratings[12]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>13. Ability to remain calm and in control when presented with stressful situations</label>
            <select class="form-control" name="ratings[13]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>14. Accepts suggestions, directions, and constructive criticism</label>
            <select class="form-control" name="ratings[14]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label>15. Cooperative team player</label>
            <select class="form-control" name="ratings[15]" required>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

          <div class="form-group">
            <label for="comments">Comments</label>
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
</div>
