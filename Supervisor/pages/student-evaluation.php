<div class="container-fluid bg-light p-0 m-0" id="evaluation" style="display: none;">
    <div class="card shadow-sm">
        <div class="card-header bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center">
                        <select id="stud-lists-pageLengthSelect" class="form-select form-select-sm custom-select" aria-label="Page length selector">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <div class="flex-shrink-1">
                    <div class="input-group">
                        <input type="text" id="stud-lists-searchInput" class="form-control form-control-sm" aria-label="Search">
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
                <table id="stud-lists" class="table table-hover text-center m-0" style="width: 100%;">
                    <thead class="table-light">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
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

        <div class="card-footer bg-light text-dark">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <span class="mb-2" id="stud-lists-tableInfo">Showing 0 to 0 of 0 entries</span>
                <nav aria-label="Page navigation">
                    <ul id="stud-lists-pagination" class="pagination mb-0">
                        <!-- Pagination buttons will be generated here via AJAX -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="evaluationModal" tabindex="-1" aria-labelledby="evaluationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable custom-modal-width">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="evaluationForm">
                <input type="hidden" id="student_id" name="student_id">
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
                                <td><input type="radio" name="ratings[quality1]" value="5"></td>
                                <td><input type="radio" name="ratings[quality1]" value="4"></td>
                                <td><input type="radio" name="ratings[quality1]" value="3"></td>
                                <td><input type="radio" name="ratings[quality1]" value="2"></td>
                                <td><input type="radio" name="ratings[quality1]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Thoroughness and attention to detail in performing the assigned tasks</td>
                                <td><input type="radio" name="ratings[quality2]" value="5"></td>
                                <td><input type="radio" name="ratings[quality2]" value="4"></td>
                                <td><input type="radio" name="ratings[quality2]" value="3"></td>
                                <td><input type="radio" name="ratings[quality2]" value="2"></td>
                                <td><input type="radio" name="ratings[quality2]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Neatness and presentation of work</td>
                                <td><input type="radio" name="ratings[quality3]" value="5"></td>
                                <td><input type="radio" name="ratings[quality3]" value="4"></td>
                                <td><input type="radio" name="ratings[quality3]" value="3"></td>
                                <td><input type="radio" name="ratings[quality3]" value="2"></td>
                                <td><input type="radio" name="ratings[quality3]" value="1"></td>
                            </tr>
                            <tr>
                                <td colspan="6"><strong>B. PRODUCTIVITY</strong></td>
                            </tr>
                            <tr>
                                <td>Effective use of time</td>
                                <td><input type="radio" name="ratings[quality4]" value="5"></td>
                                <td><input type="radio" name="ratings[quality4]" value="4"></td>
                                <td><input type="radio" name="ratings[quality4]" value="3"></td>
                                <td><input type="radio" name="ratings[quality4]" value="2"></td>
                                <td><input type="radio" name="ratings[quality4]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Tasks accomplished</td>
                                <td><input type="radio" name="ratings[quality5]" value="5"></td>
                                <td><input type="radio" name="ratings[quality5]" value="4"></td>
                                <td><input type="radio" name="ratings[quality5]" value="3"></td>
                                <td><input type="radio" name="ratings[quality5]" value="2"></td>
                                <td><input type="radio" name="ratings[quality5]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Prompt completion of work assignments</td>
                                <td><input type="radio" name="ratings[quality6]" value="5"></td>
                                <td><input type="radio" name="ratings[quality6]" value="4"></td>
                                <td><input type="radio" name="ratings[quality6]" value="3"></td>
                                <td><input type="radio" name="ratings[quality6]" value="2"></td>
                                <td><input type="radio" name="ratings[quality6]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Useful or effective application of knowledge and skills</td>
                                <td><input type="radio" name="ratings[quality7]" value="5"></td>
                                <td><input type="radio" name="ratings[quality7]" value="4"></td>
                                <td><input type="radio" name="ratings[quality7]" value="3"></td>
                                <td><input type="radio" name="ratings[quality7]" value="2"></td>
                                <td><input type="radio" name="ratings[quality7]" value="1"></td>
                            </tr>
                            <tr>
                                <td colspan="6"><strong>C. WORK HABITS, TALENTS & SKILLS</strong></td>
                            </tr>
                            <tr>
                                <td>Appropriate attire</td>
                                <td><input type="radio" name="ratings[quality8]" value="5"></td>
                                <td><input type="radio" name="ratings[quality8]" value="4"></td>
                                <td><input type="radio" name="ratings[quality8]" value="3"></td>
                                <td><input type="radio" name="ratings[quality8]" value="2"></td>
                                <td><input type="radio" name="ratings[quality8]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Adherence to policies and procedures</td>
                                <td><input type="radio" name="ratings[quality9]" value="5"></td>
                                <td><input type="radio" name="ratings[quality9]" value="4"></td>
                                <td><input type="radio" name="ratings[quality9]" value="3"></td>
                                <td><input type="radio" name="ratings[quality9]" value="2"></td>
                                <td><input type="radio" name="ratings[quality9]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Attendance and punctuality</td>
                                <td><input type="radio" name="ratings[quality10]" value="5"></td>
                                <td><input type="radio" name="ratings[quality10]" value="4"></td>
                                <td><input type="radio" name="ratings[quality10]" value="3"></td>
                                <td><input type="radio" name="ratings[quality10]" value="2"></td>
                                <td><input type="radio" name="ratings[quality10]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Ability to communicate effectively to guest, supervisor and colleagues</td>
                                <td><input type="radio" name="ratings[quality11]" value="5"></td>
                                <td><input type="radio" name="ratings[quality11]" value="4"></td>
                                <td><input type="radio" name="ratings[quality11]" value="3"></td>
                                <td><input type="radio" name="ratings[quality11]" value="2"></td>
                                <td><input type="radio" name="ratings[quality11]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Ability to think independently</td>
                                <td><input type="radio" name="ratings[quality12]" value="5"></td>
                                <td><input type="radio" name="ratings[quality12]" value="4"></td>
                                <td><input type="radio" name="ratings[quality12]" value="3"></td>
                                <td><input type="radio" name="ratings[quality12]" value="2"></td>
                                <td><input type="radio" name="ratings[quality12]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Ability to remain calm and in control when presented with stressful situations</td>
                                <td><input type="radio" name="ratings[quality13]" value="5"></td>
                                <td><input type="radio" name="ratings[quality13]" value="4"></td>
                                <td><input type="radio" name="ratings[quality13]" value="3"></td>
                                <td><input type="radio" name="ratings[quality13]" value="2"></td>
                                <td><input type="radio" name="ratings[quality13]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Demonstrates an interest and willingness to learn the task required to maintain operational standards</td>
                                <td><input type="radio" name="ratings[quality14]" value="5"></td>
                                <td><input type="radio" name="ratings[quality14]" value="4"></td>
                                <td><input type="radio" name="ratings[quality14]" value="3"></td>
                                <td><input type="radio" name="ratings[quality14]" value="2"></td>
                                <td><input type="radio" name="ratings[quality14]" value="1"></td>
                            </tr>
                            <tr>
                                <td colspan="6"><strong>D. INTERPERSONAL WORK RELATIONSHIP</strong></td>
                            </tr>
                            <tr>
                                <td>Demonstrates positive relationship with the establishments’ workers</td>
                                <td><input type="radio" name="ratings[quality15]" value="5"></td>
                                <td><input type="radio" name="ratings[quality15]" value="4"></td>
                                <td><input type="radio" name="ratings[quality15]" value="3"></td>
                                <td><input type="radio" name="ratings[quality15]" value="2"></td>
                                <td><input type="radio" name="ratings[quality15]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Relates effectively with visitors in a friendly and courteous manner</td>
                                <td><input type="radio" name="ratings[quality16]" value="5"></td>
                                <td><input type="radio" name="ratings[quality16]" value="4"></td>
                                <td><input type="radio" name="ratings[quality16]" value="3"></td>
                                <td><input type="radio" name="ratings[quality16]" value="2"></td>
                                <td><input type="radio" name="ratings[quality16]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Accepts suggestions, directions and constructive criticism from employees and supervisors</td>
                                <td><input type="radio" name="ratings[quality17]" value="5"></td>
                                <td><input type="radio" name="ratings[quality17]" value="4"></td>
                                <td><input type="radio" name="ratings[quality17]" value="3"></td>
                                <td><input type="radio" name="ratings[quality17]" value="2"></td>
                                <td><input type="radio" name="ratings[quality17]" value="1"></td>
                            </tr>
                            <tr>
                                <td>Cooperative team player</td>
                                <td><input type="radio" name="ratings[quality18]" value="5"></td>
                                <td><input type="radio" name="ratings[quality18]" value="4"></td>
                                <td><input type="radio" name="ratings[quality18]" value="3"></td>
                                <td><input type="radio" name="ratings[quality18]" value="2"></td>
                                <td><input type="radio" name="ratings[quality18]" value="1"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="comments mt-3">
                        <label for="comments"><strong>Additional Comments:</strong></label>
                        <textarea id="comments" name="comments" rows="4" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="submit" class="btn btn-primary">Submit Evaluation</button>
                </div>
            </form>
        </div>
    </div>
</div>
