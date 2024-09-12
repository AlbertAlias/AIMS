document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all');
    const actionsSection = document.getElementById('actionsSection');
    const actionsText = document.getElementById('actionsText');
    const viewButton = document.getElementById('viewButton');
    const editButton = document.getElementById('editButton');
    const deleteButton = document.getElementById('deleteButton');
    
    // Function to show Action Section and buttons when checkboxes are selected
    function showActionsSection() {
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        const anyChecked = Array.from(rowCheckboxes).some(checkbox => checkbox.checked);

        if (anyChecked) {
            actionsSection.style.display = 'flex'; // Show Action Section
            actionsText.style.display = 'inline-block';    // Show Span Text
            viewButton.style.display = 'inline-block';     // Show View button
            editButton.style.display = 'inline-block';     // Show Edit button
            deleteButton.style.display = 'inline-block';   // Show Delete button
        } else {
            actionsSection.style.display = 'none';         // Hide Action Section
            actionsText.style.display = 'none';            // Hide Span Text
            viewButton.style.display = 'none';             // Hide View button
            editButton.style.display = 'none';             // Hide Edit button
            deleteButton.style.display = 'none';           // Hide Delete button
        }
    }

    // 'Select All' checkbox functionality with SweetAlert confirmation
    selectAllCheckbox.addEventListener('change', function () {
        const isChecked = selectAllCheckbox.checked;
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');

        if (isChecked) {
            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You are about to select all items for deletion.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, proceed',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, check all row checkboxes and show Action Section with Delete button
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = true; // Set all row checkboxes to checked
                    });
                    actionsSection.style.display = 'flex'; // Show actions section
                    actionsText.style.display = 'inline-block';    // Show span text
                    deleteButton.style.display = 'inline-block';   // Only show Delete button
                    viewButton.style.display = 'none';             // Hide View button
                    editButton.style.display = 'none';             // Hide Edit button
                } else {
                    // If cancelled, uncheck 'Select All' and hide actions section
                    selectAllCheckbox.checked = false;
                    rowCheckboxes.forEach(checkbox => {
                        checkbox.checked = false; // Uncheck all row checkboxes
                    });
                    actionsSection.style.display = 'none';         // Hide actions section
                }
            });
        } else {
            // If 'Select All' is unchecked, uncheck all row checkboxes
            rowCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            showActionsSection(); // Hide actions section
        }
    });

    // Event delegation for row checkboxes
    document.addEventListener('change', function (event) {
        if (event.target.classList.contains('row-checkbox')) {
            const rowCheckboxes = document.querySelectorAll('.row-checkbox');

            // Show Action Section when any row checkbox is checked
            const anyChecked = Array.from(rowCheckboxes).some(checkbox => checkbox.checked);

            if (anyChecked) {
                actionsSection.style.display = 'flex';  // Show Action Section
                actionsText.style.display = 'inline-block';    // Show span text
                viewButton.style.display = 'inline-block';      // Show View button
                editButton.style.display = 'inline-block';      // Show Edit button
                deleteButton.style.display = 'inline-block';    // Show Delete button
            } else {
                actionsSection.style.display = 'none';          // Hide Action Section
                actionsText.style.display = 'none';            // Hide Span Text
                viewButton.style.display = 'none';              // Hide View button
                editButton.style.display = 'none';              // Hide Edit button
                deleteButton.style.display = 'none';            // Hide Delete button
            }
            
            // If all row checkboxes are checked, check 'Select All'
            selectAllCheckbox.checked = Array.from(rowCheckboxes).every(checkbox => checkbox.checked);
        }
    });

    // Initial check if any checkboxes are pre-selected (in case)
    showActionsSection();
});