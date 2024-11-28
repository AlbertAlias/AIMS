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
        // If the user clicks the leftmost or rightmost card, update accordingly
        if (index === 0) {
            activeIndex = 0;  // Set to the first card
        } else if (index === cards.length - 1) {
            activeIndex = cards.length - 1;  // Set to the last card
        } else {
            activeIndex = index;  // Otherwise, set to the clicked card
        }

        // Check for the edge cases:
        // - If the active card is at the left edge, set the opposite side's 4th card in place.
        if (activeIndex === 0) {
            // Set the 4th card on the right to the left
            activeIndex = 4;  // Bring the 4th card from the right side into the middle
        } else if (activeIndex === cards.length - 1) {
            // Set the 4th card on the left to the right
            activeIndex = cards.length - 5;  // Bring the 4th card from the left side to the middle
        }

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
