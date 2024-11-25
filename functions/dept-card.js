document.addEventListener("DOMContentLoaded", function () {
    const circleButtons = document.querySelectorAll(".circle-button");
    const cardContents = document.querySelectorAll(".card-content");
    let activeCard = document.querySelector(".card-content.active");

    const handleCircleButtonClick = (event) => {
        const clickedButton = event.currentTarget;

        // If the clicked button is already active, we don't need to do anything
        if (clickedButton.classList.contains("active")) {
            return; // Prevent any action if the button is already active
        }

        // Remove the active state from all buttons and cards
        circleButtons.forEach((button) => button.classList.remove("active"));
        cardContents.forEach((card) => {
            card.classList.remove("active");
            card.classList.remove("exit");
        });

        // Add the active state to the clicked button
        clickedButton.classList.add("active");

        // Get the ID of the card-content to display
        const targetCardId = clickedButton.getAttribute("data-card");
        const targetCard = document.getElementById(targetCardId);

        // If there is an active card, apply the exit animation
        if (activeCard) {
            activeCard.classList.remove("active");
            activeCard.classList.add("exit");
            // Wait for the exit animation to finish before removing the "exit" class
            activeCard.addEventListener(
                "transitionend",
                () => {
                    activeCard.classList.remove("exit");
                },
                { once: true }
            );
        }

        // Display the new card with the enter animation
        if (targetCard) {
            setTimeout(() => {
                targetCard.classList.add("active"); // Slide in from the right
            }, 500); // Delay to allow the exit animation to complete
            activeCard = targetCard;
        }
    };

    // Attach event listeners to all circle buttons
    circleButtons.forEach((button) => {
        button.addEventListener("click", handleCircleButtonClick);
    });
});