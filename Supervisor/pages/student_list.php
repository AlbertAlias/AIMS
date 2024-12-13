<div class="container-fluid p-0 m-0" id="evaluation" style="display: none;">
  <h2>Student Management</h2>

  <!-- Search Section -->
  <section class="search-container">
    <input
      type="text"
      id="searchInput"
      placeholder="Search by name, username, or email"
      aria-label="Search by name, username, or email"
    />
    <button id="searchButton" class="btn btn-primary">Search</button>
  </section>

  <!-- Student Table Section -->
  <article>
    <table class="table table-striped">
      <thead>
        <tr>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Company</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="studentTableBody">
        <!-- Rows will be dynamically populated here -->
      </tbody>
    </table>
  </article>

  <!-- Pagination Section -->
  <nav aria-label="Student table pagination">
    <ul class="pagination" id="pagination"></ul>
  </nav>
</div>
