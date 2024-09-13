document.addEventListener('DOMContentLoaded', function () {
    const selectAllCheckbox = document.getElementById('select-all');
    const actionsSection = document.getElementById('actionsSection');
    const actionsText = document.getElementById('actionsText');
    const viewButton = document.getElementById('viewButton');
    const editButton = document.getElementById('editButton');
    const deleteButton = document.getElementById('deleteButton');
    const pagination = document.getElementById('pagination');
    const pageLengthSelect = document.getElementById('pageLengthSelect');

    // Function to show Action Section and buttons based on checkbox state
    function showActionsSection() {
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');
        const checkedCheckboxes = Array.from(rowCheckboxes).filter(checkbox => checkbox.checked);

        if (checkedCheckboxes.length === 1) {
            actionsSection.style.display = 'flex'; // Show Action Section
            actionsText.style.display = 'inline-block'; // Show Span Text
            viewButton.style.display = 'inline-block'; // Show View button
            editButton.style.display = 'inline-block'; // Show Edit button
            deleteButton.style.display = 'inline-block'; // Show Delete button
        } else if (checkedCheckboxes.length > 1) {
            actionsSection.style.display = 'flex'; // Show Action Section
            actionsText.style.display = 'inline-block'; // Show Span Text
            viewButton.style.display = 'none'; // Hide View button
            editButton.style.display = 'none'; // Hide Edit button
            deleteButton.style.display = 'inline-block'; // Show Delete button
        } else {
            actionsSection.style.display = 'none'; // Hide Action Section
            actionsText.style.display = 'none'; // Hide Span Text
            viewButton.style.display = 'none'; // Hide View button
            editButton.style.display = 'none'; // Hide Edit button
            deleteButton.style.display = 'none'; // Hide Delete button
        }
    }

    // Reset "Select All" checkbox and Actions Section visibility on pagination or page length change
    function resetSelection() {
        selectAllCheckbox.checked = false;
        document.querySelectorAll('.row-checkbox').forEach(checkbox => {
            checkbox.checked = false;
        });
        showActionsSection();
    }

    // 'Select All' checkbox functionality
    selectAllCheckbox.addEventListener('change', function () {
        const isChecked = selectAllCheckbox.checked;
        document.querySelectorAll('.row-checkbox').forEach(checkbox => {
            checkbox.checked = isChecked;
        });
        showActionsSection();
    });

    // Event delegation for row checkboxes
    document.addEventListener('change', function (event) {
        if (event.target.classList.contains('row-checkbox')) {
            showActionsSection();
            selectAllCheckbox.checked = Array.from(document.querySelectorAll('.row-checkbox')).every(checkbox => checkbox.checked);
        }
    });

    // Confirm deletion when delete button is clicked
    deleteButton.addEventListener('click', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: "You are about to delete the selected users.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, proceed',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                const checkedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
                const ids = Array.from(checkedCheckboxes).map(checkbox => checkbox.getAttribute('data-id'));
    
                if (ids.length > 0) {
                    $.ajax({
                        url: 'controller/manage-users/delete-users.php',
                        type: 'POST',
                        data: {
                            ids: ids.join(','),
                            page: currentPage // Include current page if needed
                        },
                        traditional: true, // Allow array to be sent as POST data
                        success: function (response) {
                            let res = JSON.parse(response);
                            alert(res.message);
                            if (res.status === 'success') {
                                // Reload current page if deletion is successful
                                location.reload(); 
                            }
                        },
                        error: function () {
                            alert('An error occurred while deleting users.');
                        }
                    });
                }
            }
        });
    });    

    // Reset selection on pagination and page length change
    pagination.addEventListener('click', resetSelection);
    pageLengthSelect.addEventListener('change', resetSelection);

    // Initial check if any checkboxes are pre-selected (in case)
    showActionsSection();
});