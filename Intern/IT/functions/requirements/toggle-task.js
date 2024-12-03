// JavaScript to handle filter click and content change
const filterLinks = document.querySelectorAll('.d-flex a');
const contentContainer = document.getElementById('requirements-content');

// Define the card HTML content for each filter
const allRequirementsHTML = `
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="card-title fs-5 text-danger">Pass the MOA until the first week of internship</div>
                    <div class="card-text fs-6">Please accomplish this as soon as possible</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="card-title fs-5 text-warning">Pass the Medical Certificate</div>
                    <div class="card-text fs-6">Deadline: Dec 09, 2024</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="card-title fs-5 text-success">Pass the Birth Certificate or PSA</div>
                    <div class="card-text fs-6">Deadline: Dec 01, 2024</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="card-title fs-5 text-success">Pass the Resume</div>
                    <div class="card-text fs-6">Deadline: Nov 27, 2024</div>
                </div>
            </div>
        </div>
    </div>
`;

const pendingRequirementsHTML = `
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="card-title fs-5 text-danger">Pass the MOA until the first week of internship</div>
                    <div class="card-text fs-6">Please accomplish this as soon as possible</div>
                </div>
            </div>
        </div>
    </div>
`;

const submittedRequirementsHTML = `
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="card-title fs-5 text-warning">Pass the Medical Certificate</div>
                    <div class="card-text fs-6">Deadline: Dec 09, 2024</div>
                </div>
            </div>
        </div>
    </div>
`;

const completedRequirementsHTML = `
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="card-title fs-5 text-success">Pass the Birth Certificate or PSA</div>
                    <div class="card-text fs-6">Deadline: Dec 01, 2024</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12 mb-3">
        <div class="card p-3 mb-3" style="box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <div class="card-title fs-5 text-success">Pass the Resume</div>
                    <div class="card-text fs-6">Deadline: Nov 27, 2024</div>
                </div>
            </div>
        </div>
    </div>
`;

filterLinks.forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();

        // Remove active class from all links
        filterLinks.forEach(l => l.classList.remove('active'));

        // Add active class to the clicked link
        this.classList.add('active');

        // Change content based on the selected filter
        switch (this.id) {
            case 'filter-all':
                contentContainer.innerHTML = allRequirementsHTML;
                break;
            case 'filter-pending':
                contentContainer.innerHTML = pendingRequirementsHTML;
                break;
            case 'filter-submitted':
                contentContainer.innerHTML = submittedRequirementsHTML;
                break;
            case 'filter-completed':
                contentContainer.innerHTML = completedRequirementsHTML;
                break;
        }
    });
});
