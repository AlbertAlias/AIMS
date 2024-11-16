$(document).ready(function () {
    let isLoadingDetails = false;
    let currentAjaxRequest = null;

    window.loadInternDetails = function (id) {
        if (isLoadingDetails) return;
        isLoadingDetails = true;

        console.log("Loading intern details for ID:", id);

        if (currentAjaxRequest) {
            currentAjaxRequest.abort();
        }

        currentAjaxRequest = $.ajax({
            url: "controller/interns/retrieve-intern-info.php",
            method: "GET",
            data: { id: id },
            dataType: "json",
            success: function (response) {
                console.log("Intern Details:", response);

                if (response.error) {
                    console.error("Error:", response.error);
                    return;
                }

                // Populate form fields with response data
                $("#internID").val(response.id || "");
                $("#intern_intern_id").val(response.intern_id || "").prop("disabled", false);
                $("#intern_last_name").val(response.last_name || "").prop("disabled", false);
                $("#intern_first_name").val(response.first_name || "").prop("disabled", false);
                $("#intern_gender").val(response.gender || "").prop("disabled", false);
                $("#studentID").val(response.studentID || "").prop("disabled", false);
                $("#intern_department").val(response.department_id || "").prop("disabled", false);
                $("#intern_username").val(response.username || "").prop("disabled", false);
                $("#intern_password").val(response.password || "").prop("disabled", false);
                $("#internCancelBtn").show();
                $("#internUpdateBtn").prop("disabled", false);
            },
            error: function (xhr, status, error) {
                if (status !== "abort") {
                    console.error("Error retrieving intern details:", error);
                }
            },
            complete: function () {
                isLoadingDetails = false;
            },
        });
    };

    // Click event for intern buttons
    $(document).on("click", ".intern-btn", function (e) {
        e.preventDefault();
        const internId = $(this).data("id");
        window.loadInternDetails(internId);
    });

    // Click event for cancel button
    $(document).on("click", "#internCancelBtn", function () {
        // Reset the form and hide the cancel button
        $("#internsForm")[0].reset();
        $("#internCancelBtn").hide();
        $("#internUpdateBtn").prop("disabled", true);
        $("#internsForm input, #internsForm select").prop("disabled", true);
    });
});