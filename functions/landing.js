// ARIA accessibility: Dynamically update aria-expanded attribute
document.querySelectorAll('[data-bs-toggle="collapse"]').forEach(function(toggle) {
    toggle.addEventListener('click', function() {
        const target = document.querySelector(toggle.getAttribute('data-bs-target'));
        const expanded = toggle.getAttribute('aria-expanded') === 'true';
        toggle.setAttribute('aria-expanded', !expanded);
    });
});