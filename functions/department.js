document.querySelectorAll('.circle-button').forEach(button => {
    button.addEventListener('click', () => {
        const cardId = button.getAttribute('data-card');
        const cardToShow = document.getElementById(cardId);
        const activeCard = document.querySelector('.card-content.active');
        const activeButton = document.querySelector('.circle-button.active');

        // Remove active state from the current button
        if (activeButton) {
            activeButton.classList.remove('active');
        }

        // Set active state for the clicked button
        button.classList.add('active');

        if (activeCard) {
            // Hide the currently active card
            activeCard.classList.remove('active');
            activeCard.classList.add('exit');
            setTimeout(() => {
                activeCard.classList.remove('exit');
            }, 500); // Match the animation duration
        }

        // Show the new card
        cardToShow.classList.add('active');
    });
});

// Set default active states
document.querySelector('.circle-button[data-card="card-a"]').classList.add('active');
document.getElementById('card-a').classList.add('active');
