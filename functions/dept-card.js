let cards; // Declare cards globally
let activeIndex = 4; // Initial active card index
let interval; // For the carousel interval

// Function to update which cards are visible and animate their positions
// const updateCards = () => {
//     if (!cards || cards.length === 0) return; // Exit if cards are not loaded yet

//     const cardContainer = document.getElementById('department-cards');

//     // Update visibility and classes for cards
//     cards.forEach((card, index) => {
//         card.style.display = 'none'; // Hide all cards by default
//         card.classList.remove('flipped', 'active', 'left', 'right'); // Reset classes

//         // Determine which cards to show
//         if (index === activeIndex - 1 || index === activeIndex || index === activeIndex + 1) {
//             card.style.display = 'block';

//             if (index < activeIndex) {
//                 card.classList.add('left'); // Card on the left
//             } else if (index > activeIndex) {
//                 card.classList.add('right'); // Card on the right
//             } else {
//                 card.classList.add('active'); // Active card
//             }
//         }
//     });

//     // Update the transform for the card container
//     cardContainer.style.transition = 'transform 0.6s ease'; // Smooth transition
// };

const updateCards = () => {
    cards = document.querySelectorAll('.card'); // Re-fetch all cards to ensure dynamic changes are included

    if (!cards || cards.length === 0) return; // Exit if no cards

    const cardContainer = document.getElementById('department-cards');

    // Update visibility and classes for cards
    cards.forEach((card, index) => {
        card.style.display = 'none'; // Hide all cards by default
        card.classList.remove('flipped', 'active', 'left', 'right'); // Reset classes

        // Show and position relevant cards
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

    // Update container transition
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
        }, 1000); // Wait for the transition to complete
    } else if (activeIndex === 0) {
        // If at the first card, jump to the cloned last card
        setTimeout(() => {
            cardContainer.style.transition = 'none'; // Disable animation
            activeIndex = cards.length - 2; // Jump to the last real card
            updateCards();
        }, 1000); // Wait for the transition to complete
    }
};

// Start auto-scroll for carousel (move right)
// const startCarousel = () => {
//     interval = setInterval(() => {
//         activeIndex = (activeIndex + 1) % cards.length; // Increment index
//         updateCards();
//         handleSeamlessLoop();
//     }, 4000); // 4 seconds interval
// };

const startCarousel = () => {
    if (!cards || cards.length <= 3) { 
        // Stop carousel if less than 3 cards (including clones)
        console.log('Not enough cards for carousel. Auto-scroll disabled.');
        return;
    }

    interval = setInterval(() => {
        activeIndex = (activeIndex + 1) % cards.length; // Increment index
        updateCards();
        handleSeamlessLoop();
    }, 4000); // 4 seconds interval
};


// Function to load cards and initialize the carousel
// const loadCards = () => {
//     cards = document.querySelectorAll('.card'); // Get all cards
//     if (cards.length > 0) {
//         const cardContainer = document.getElementById('department-cards');
//         const firstCard = cards[0].cloneNode(true); // Clone the first card
//         const lastCard = cards[cards.length - 1].cloneNode(true); // Clone the last card

//         // Append the clones to the container
//         cardContainer.appendChild(firstCard);
//         cardContainer.insertBefore(lastCard, cards[0]);

//         // Reinitialize the cards collection
//         cards = document.querySelectorAll('.card');
//         activeIndex = 1; // Set active index to the first real card
//         updateCards(); // Initialize carousel
//         startCarousel(); // Start auto-scroll
//     } else {
//         setTimeout(loadCards, 100); // Retry after 100ms if cards are not loaded yet
//     }
// };

// const loadCards = () => {
//     cards = document.querySelectorAll('.card'); // Get all cards
//     if (cards.length > 0) {
//         const cardContainer = document.getElementById('department-cards');
//         const firstCard = cards[0].cloneNode(true); // Clone the first card
//         const lastCard = cards[cards.length - 1].cloneNode(true); // Clone the last card

//         // Append the clones to the container
//         cardContainer.appendChild(firstCard);
//         cardContainer.insertBefore(lastCard, cards[0]);

//         // Reinitialize the cards collection
//         cards = document.querySelectorAll('.card');
//         activeIndex = 1; // Set active index to the first real card

//         // Add the no-transition class temporarily
//         cards.forEach((card) => card.classList.add('no-transition'));

//         // Update the cards for initial positioning
//         updateCards();

//         // Remove the no-transition class after the DOM has settled
//         setTimeout(() => {
//             cards.forEach((card) => card.classList.remove('no-transition'));
//         }, 100); // Wait for 100ms to allow positioning
//     } else {
//         setTimeout(loadCards, 100); // Retry after 100ms if cards are not loaded yet
//     }
// };

// const loadCards = () => {
//     cards = document.querySelectorAll('.card'); // Get all cards
//     if (cards.length > 0) {
//         const cardContainer = document.getElementById('department-cards');

//         // Check if clones already exist to avoid duplication
//         const existingClones = cardContainer.querySelectorAll('.card.clone');
//         if (existingClones.length === 0) {
//             const firstCard = cards[0].cloneNode(true); // Clone the first card
//             const lastCard = cards[cards.length - 1].cloneNode(true); // Clone the last card

//             // Mark cloned cards for easy identification
//             firstCard.classList.add('clone');
//             lastCard.classList.add('clone');

//             // Append the clones to the container
//             cardContainer.appendChild(firstCard);
//             cardContainer.insertBefore(lastCard, cards[0]);

//             // Re-fetch all cards including clones
//             cards = document.querySelectorAll('.card');
//         }

//         activeIndex = 1; // Reset active index to the first real card
//         updateCards(); // Update cards
//     } else {
//         setTimeout(loadCards, 100); // Retry after 100ms if cards are not loaded yet
//     }
// };

const loadCards = () => {
    cards = document.querySelectorAll('.card'); // Get all cards

    if (cards.length > 0) {
        const cardContainer = document.getElementById('department-cards');

        // Check if clones already exist to avoid duplication
        const existingClones = cardContainer.querySelectorAll('.card.clone');
        if (existingClones.length === 0) {
            const firstCard = cards[0].cloneNode(true); // Clone the first card
            const lastCard = cards[cards.length - 1].cloneNode(true); // Clone the last card

            // Mark cloned cards for easy identification
            firstCard.classList.add('clone');
            lastCard.classList.add('clone');

            // Append the clones to the container
            cardContainer.appendChild(firstCard);
            cardContainer.insertBefore(lastCard, cards[0]);

            // Re-fetch all cards including clones
            cards = document.querySelectorAll('.card');
        }

        activeIndex = 1; // Reset active index to the first real card
        updateCards(); // Update cards
    } else {
        console.log('No cards available. Carousel initialization skipped.');
    }
};




// Initialize carousel on DOM content loaded
document.addEventListener("DOMContentLoaded", () => {
    loadCards(); // Load cards and initialize the carousel
});
