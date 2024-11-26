document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".circle-btn");
    const cards = document.querySelectorAll(".card-container");

    // Ensure the first button and card are active by default
    buttons.forEach((btn, index) => {
        if (index === 0) {
            btn.classList.add("active");
        } else {
            btn.classList.remove("active");
        }
    });

    cards.forEach((card, index) => {
        if (index === 0) {
            card.classList.add("active");
        } else {
            card.classList.remove("active");
        }
    });

    // Button click logic
    buttons.forEach((button, index) => {
        button.addEventListener("click", () => {
            // Reset active classes for buttons
            buttons.forEach(btn => btn.classList.remove("active"));
            button.classList.add("active");

            // Reset active classes for card containers
            cards.forEach(card => card.classList.remove("active"));
            const correspondingCard = document.getElementById(`card-${index + 1}`);
            if (correspondingCard) {
                correspondingCard.classList.add("active");
            }
        });
    });
});