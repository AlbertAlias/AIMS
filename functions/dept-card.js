let cards; // Declare cards globally
let activeIndex = 4; // Initial active card index
let interval; // For the carousel interval

// Function to update which cards are visible and animate their positions
const updateCards = () => {
    if (!cards || cards.length === 0) return; // Exit if cards are not loaded yet

    const cardContainer = document.getElementById('department-cards');

    // Update visibility and classes for cards
    cards.forEach((card, index) => {
        card.style.display = 'none'; // Hide all cards by default
        card.classList.remove('flipped', 'active', 'left', 'right'); // Reset classes

        // Determine which cards to show
        if (index === activeIndex - 1 || index === activeIndex || index === activeIndex + 1) {
            card.style.display = 'block';

            if (index < activeIndex) {
                card.classList.add('left'); // Card on the left
            } else if (index > activeIndex) {
                card.classList.add('right'); // Card on the right
            } else {
                card.classList.add('active'); // Active card
            }
        }
    });

    // Update the transform for the card container
    cardContainer.style.transition = 'transform 0.6s ease'; // Smooth transition
};

// Function to handle seamless looping
const handleSeamlessLoop = () => {
    const cardContainer = document.getElementById('department-cards');
    if (activeIndex === cards.length - 2) {
        // If at the last card, jump to the cloned first card
        setTimeout(() => {
            cardContainer.style.transition = 'none'; // Disable animation
            activeIndex = 1; // Jump to the first real card
            updateCards();
        }, 500); // Wait for the transition to complete
    } else if (activeIndex === 0) {
        // If at the first card, jump to the cloned last card
        setTimeout(() => {
            cardContainer.style.transition = 'none'; // Disable animation
            activeIndex = cards.length - 2; // Jump to the last real card
            updateCards();
        }, 500); // Wait for the transition to complete
    }
};

// Start auto-scroll for carousel (move right)
const startCarousel = () => {
    interval = setInterval(() => {
        activeIndex = (activeIndex + 1) % cards.length; // Increment index
        updateCards();
        handleSeamlessLoop();
    }, 3000); // 3 seconds interval
};

// Function to load cards and initialize the carousel
const loadCards = () => {
    cards = document.querySelectorAll('.card'); // Get all cards
    if (cards.length > 0) {
        const cardContainer = document.getElementById('department-cards');
        const firstCard = cards[0].cloneNode(true); // Clone the first card
        const lastCard = cards[cards.length - 1].cloneNode(true); // Clone the last card

        // Append the clones to the container
        cardContainer.appendChild(firstCard);
        cardContainer.insertBefore(lastCard, cards[0]);

        // Reinitialize the cards collection
        cards = document.querySelectorAll('.card');
        activeIndex = 1; // Set active index to the first real card
        updateCards(); // Initialize carousel
        startCarousel(); // Start auto-scroll
    } else {
        setTimeout(loadCards, 100); // Retry after 100ms if cards are not loaded yet
    }
};

// Initialize carousel on DOM content loaded
document.addEventListener("DOMContentLoaded", () => {
    loadCards(); // Load cards and initialize the carousel
});
