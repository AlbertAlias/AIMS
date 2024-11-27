document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll('.card');   // Get all cards
    let activeIndex = 4;  // Initial active card index (center one)

    // Function to update which cards are visible and animate their positions
    const updateCards = () => {
        cards.forEach((card, index) => {
            card.style.display = 'none'; // Hide all cards by default
            card.classList.remove('flipped'); // Ensure card is reset
            card.classList.remove('active', 'left', 'right'); // Remove positioning classes

            // Show only the cards around the active index
            if (index === activeIndex - 1 || index === activeIndex || index === activeIndex + 1) {
                card.style.display = 'block';

                if (index < activeIndex) {
                    card.classList.add('left'); // Mark left cards
                } else if (index > activeIndex) {
                    card.classList.add('right'); // Mark right cards
                } else {
                    card.classList.add('active'); // Mark the active card
                }
            }
        });
    };

    // Function to set the active card
    const setActiveCard = (index) => {
        activeIndex = index;
        updateCards();
    };

    // Add event listeners for click
    cards.forEach((card, index) => {
        card.addEventListener('click', () => {
            if (card.classList.contains('active')) {
                // Flip the active card
                card.classList.toggle('flipped');
            } else {
                // Make the clicked card active
                setActiveCard(index);
            }
        });
    });

    // Initial setup
    updateCards();
});
