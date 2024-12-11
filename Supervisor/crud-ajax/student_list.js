document.addEventListener('DOMContentLoaded', function() {
    const tableBody = document.getElementById('studentTableBody');
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const paginationContainer = document.getElementById('pagination');
    
    let currentPage = 1;
    const rowsPerPage = 10;
  
    /**
     * Function to fetch students via AJAX
     */
    function fetchStudents(page = 1, searchTerm = '') {
      fetch(`controller/student_list.php?page=${page}&length=${rowsPerPage}&search=${encodeURIComponent(searchTerm)}`)
        .then(response => response.json())
        .then(data => {
          if (data.error) {
            alert(data.error);
            return;
          }
          renderTable(data.html);
          renderPagination(data.pagination);
          currentPage = page;
        })
        .catch(error => {
          console.error('Error fetching students:', error);
        });
    }
  
    /**
     * Render student table rows
     */
    function renderTable(html) {
      tableBody.innerHTML = html;
    }
  
    /**
     * Render pagination buttons
     */
    function renderPagination(paginationHTML) {
      paginationContainer.innerHTML = paginationHTML;
  
      // Attach event listeners to the pagination buttons
      const pageLinks = document.querySelectorAll('.page-link');
      pageLinks.forEach(link => {
        link.addEventListener('click', function() {
          const page = parseInt(this.getAttribute('data-page'));
          fetchStudents(page, searchInput.value.trim());
        });
      });
    }
  
    /**
     * Event listener for the search button
     */
    searchButton.addEventListener('click', function() {
      fetchStudents(1, searchInput.value.trim());
    });
  
    // Initial fetch when the page loads
    fetchStudents();
  });
  