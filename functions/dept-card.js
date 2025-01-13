// document.addEventListener("DOMContentLoaded", () => {
//     const cards = document.querySelectorAll('.card');   // Get all cards
//     let activeIndex = 4;  // Initial active card index (center one)

//     // Function to update which cards are visible and animate their positions
//     const updateCards = () => {
//         cards.forEach((card, index) => {
//             card.style.display = 'none'; // Hide all cards by default
//             card.classList.remove('flipped'); // Ensure card is reset
//             card.classList.remove('active', 'left', 'right'); // Remove positioning classes

//             // Show only the cards around the active index
//             if (index === activeIndex - 1 || index === activeIndex || index === activeIndex + 1) {
//                 card.style.display = 'block';

//                 if (index < activeIndex) {
//                     card.classList.add('left'); // Mark left cards
//                 } else if (index > activeIndex) {
//                     card.classList.add('right'); // Mark right cards
//                 } else {
//                     card.classList.add('active'); // Mark the active card
//                 }
//             }
//         });
//     };

//     // Function to set the active card
//     const setActiveCard = (index) => {
//         // If the user clicks the leftmost or rightmost card, update accordingly
//         if (index === 0) {
//             activeIndex = 0;  // Set to the first card
//         } else if (index === cards.length - 1) {
//             activeIndex = cards.length - 1;  // Set to the last card
//         } else {
//             activeIndex = index;  // Otherwise, set to the clicked card
//         }

//         // Check for the edge cases:
//         // - If the active card is at the left edge, set the opposite side's 4th card in place.
//         if (activeIndex === 0) {
//             // Set the 4th card on the right to the left
//             activeIndex = 4;  // Bring the 4th card from the right side into the middle
//         } else if (activeIndex === cards.length - 1) {
//             // Set the 4th card on the left to the right
//             activeIndex = cards.length - 5;  // Bring the 4th card from the left side to the middle
//         }

//         updateCards();
//     };

//     // Add event listeners for click
//     cards.forEach((card, index) => {
//         card.addEventListener('click', () => {
//             if (card.classList.contains('active')) {
//                 // Flip the active card
//                 card.classList.toggle('flipped');
//             } else {
//                 // Make the clicked card active
//                 setActiveCard(index);
//             }
//         });
//     });

//     // Initial setup
//     updateCards();
// });







// let cards;  // Declare cards globally
// let activeIndex = 4;  // Initial active card index (first card)
// let interval;  // For the carousel interval

// // Function to update which cards are visible and animate their positions
// const updateCards = () => {
//     // Ensure that cards are loaded
//     if (!cards || cards.length === 0) {
//         return;  // Exit if cards are not loaded yet
//     }

//     // Get the width of the first card and the total number of cards
//     const cardWidth = cards[0].offsetWidth;  // Get the width of the first card
//     const containerWidth = cardWidth * cards.length;  // Total width of all cards

//     // Show only the cards around the active index
//     cards.forEach((card, index) => {
//         card.style.display = 'none'; // Hide all cards by default
//         card.classList.remove('flipped'); // Ensure card is reset
//         card.classList.remove('active', 'left', 'right'); // Remove positioning classes

//         // Show only the cards around the active index
//         if (index === activeIndex - 1 || index === activeIndex || index === activeIndex + 1) {
//             card.style.display = 'block';

//             if (index < activeIndex) {
//                 card.classList.add('left'); // Mark left cards
//             } else if (index > activeIndex) {
//                 card.classList.add('right'); // Mark right cards
//             } else {
//                 card.classList.add('active'); // Mark the active card
//             }
//         }
//     });

//     // Move the card-container to simulate carousel movement
//     const cardContainer = document.getElementById('department-cards');
//     const offset = -activeIndex * cardWidth;  // Move the container by card width
//     cardContainer.style.transform = `translateX(${offset}px)`;  // Move container left
// };

// // Function to set the active card
// const setActiveCard = (index) => {
//     activeIndex = index;
//     updateCards();
// };

// // Start auto-scroll for carousel (move right)
// const startCarousel = () => {
//     interval = setInterval(() => {
//         activeIndex = (activeIndex + 1) % cards.length;  // Loop around
//         updateCards();
//     }, 3000);  // 3 seconds interval
// };

// // Stop carousel when clicked on a card
// const stopCarousel = () => {
//     clearInterval(interval);
// };

// document.addEventListener("DOMContentLoaded", () => {
//     // Wait for the AJAX call to complete before proceeding
//     cards = document.querySelectorAll('.card');  // Get all cards (initial check)

//     // Add event listeners for click to stop the carousel
//     document.getElementById('department-cards').addEventListener('click', (event) => {
//         if (event.target.closest('.card')) {  // If a card was clicked
//             stopCarousel();  // Stop the carousel on click
//             const clickedCard = event.target.closest('.card');
//             const index = Array.from(cards).indexOf(clickedCard);
//             setActiveCard(index);  // Set the clicked card as active
//         }
//     });

//     // Make sure the cards are populated before calling updateCards
//     const loadCards = () => {
//         cards = document.querySelectorAll('.card');  // Get all cards

//         // Ensure cards are loaded before calling updateCards
//         if (cards.length > 0) {
//             updateCards();
//             startCarousel();  // Start the carousel movement after cards are loaded
//         } else {
//             setTimeout(loadCards, 100);  // Retry after 100ms if cards are not loaded yet
//         }
//     };

//     loadCards();  // Try loading cards and starting carousel
// });



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

// Stop carousel when clicked on a card
const stopCarousel = () => {
    clearInterval(interval);
};

// Function to set the active card
const setActiveCard = (index) => {
    activeIndex = index;
    updateCards();
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
    // Add event listeners for click to stop the carousel
    document.getElementById('department-cards').addEventListener('click', (event) => {
        if (event.target.closest('.card')) {
            stopCarousel(); // Stop the carousel on click
            const clickedCard = event.target.closest('.card');
            const index = Array.from(cards).indexOf(clickedCard);
            setActiveCard(index); // Set the clicked card as active
        }
    });

    // Load cards and initialize the carousel
    loadCards();
});
