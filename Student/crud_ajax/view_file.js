// Include a link to download uploaded files
requirements.forEach((requirement) => {
    const requirementCard = `
        <div class="card mb-3">
            <div class="card-header">
                <h5>${requirement.title}</h5>
            </div>
            <div class="card-body">
                <p>${requirement.description}</p>
                <form class="submit-form" data-id="${requirement.id}">
                    <input type="hidden" name="student_id" value="1"> <!-- Replace with dynamic student ID -->
                    <input type="file" name="file" class="form-control mb-2" required>
                    <button type="submit" class="btn btn-primary">Submit Requirement</button>
                </form>
            </div>
        </div>
    `;
    requirementsContainer.insertAdjacentHTML("beforeend", requirementCard);
});
