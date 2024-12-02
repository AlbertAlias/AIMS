console.log("Session timeout script loaded.");

function setupInactivityTimeout() {
    const inactivityTime = 180000; // 10 seconds for testing
    let initialIdleTimer = null;  // Timer for when user does not interact at all
    let interactionIdleTimer = null; // Timer for when user interacts and then becomes idle

    // Function to handle session timeout logic
    function triggerSessionTimeout() {
        console.log("Session expired due to inactivity.");
        Swal.fire({
            title: 'Session Expired',
            text: 'You will now be logged out due to inactivity.',
            icon: 'warning',
            confirmButtonText: 'Ok',
            allowOutsideClick: false
        }).then(() => {
            window.location.href = '../index.php'; // Redirect to login page
        });
    }

    // Function to check session status via AJAX
    function checkSessionStatus() {
        $.ajax({
            url: 'controller/auto-logout/session-timeout.php',
            method: 'GET',
            success: function (response) {
                console.log("Session check response:", response); // Debugging line
                const data = JSON.parse(response);

                if (data.sessionExpired) {
                    triggerSessionTimeout();
                }
            },
            error: function (xhr, status, error) {
                console.error("AJAX error:", status, error); // Debugging line for AJAX errors
            }
        });
    }

    // Function to start the initial idle timer
    function startInitialIdleTimer() {
        console.log("Starting initial idle timer...");
        initialIdleTimer = setTimeout(() => {
            console.log("User inactive after login (no interaction).");
            checkSessionStatus(); // Check session status after the initial idle time
        }, inactivityTime);
    }

    // Function to reset the interaction idle timer
    function resetInteractionIdleTimer() {
        console.log("User activity detected, resetting interaction idle timer...");
        clearTimeout(interactionIdleTimer); // Clear previous interaction idle timer
        interactionIdleTimer = setTimeout(() => {
            console.log("User inactive after interaction.");
            checkSessionStatus(); // Check session status after the interaction idle time
        }, inactivityTime);
    }

    // Function to handle user interaction
    function handleUserInteraction() {
        // Clear the initial idle timer on the first user interaction
        if (initialIdleTimer) {
            console.log("User interacted, clearing initial idle timer...");
            clearTimeout(initialIdleTimer);
            initialIdleTimer = null; // Stop the initial idle timer
        }

        // Reset the interaction idle timer
        resetInteractionIdleTimer();
    }

    // Attach event listeners for user activity
    document.addEventListener('mousemove', handleUserInteraction);
    document.addEventListener('mousedown', handleUserInteraction); // Includes mouse clicks
    document.addEventListener('touchstart', handleUserInteraction); // Includes mobile touches
    document.addEventListener('keypress', handleUserInteraction);

    // Start the initial idle timer immediately on page load, including after re-login
    startInitialIdleTimer();
}

setupInactivityTimeout();