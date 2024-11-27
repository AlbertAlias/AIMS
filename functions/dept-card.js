document.addEventListener("DOMContentLoaded", () => {
    const cards = document.querySelectorAll('.card'); // Get all cards
    const totalCards = cards.length;
    let activeIndex = 4; // Initial active card index (center one)

    // Function to update the active card
    const updateCards = () => {
        cards.forEach((card, index) => {
            card.style.display = 'none';
            card.classList.remove('flipped');
            if (index === activeIndex - 1 || index === activeIndex || index === activeIndex + 1) {
                card.style.display = 'block'; // Only show 3 cards: left, center, right
            }
            card.classList.remove('active');
            if (index === activeIndex) {
                card.classList.add('active');
            }
        });
    };

    // Function to set the active card by index
    const setActiveCard = (index) => {
        activeIndex = index;
        updateCards();
    };

    // Add click event for each card
    cards.forEach((card, index) => {
        card.addEventListener('click', () => {
            if (index === activeIndex) {
                // Flip the card only if it's the active one
                card.classList.toggle('flipped');
            } else {
                // If a non-active card is clicked, make it active
                setActiveCard(index);
            }
        });
    });

    // Initial call to display the first set of cards
    updateCards();
});
