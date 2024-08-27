document.addEventListener('DOMContentLoaded', function() {
    var textContainers = document.querySelectorAll('.text-container');

    textContainers.forEach(function(container) {
        var textContent = container.querySelector('.text-content');
        var moreDetailsButton = container.querySelector('.more-details');

        // Check if the content is overflowing
        if (textContent.scrollWidth > textContent.clientWidth) {
            moreDetailsButton.style.display = 'block'; // Show the button
            moreDetailsButton.addEventListener('click', function() {
                alert('More details here!'); // Replace this with your functionality
            });
        } else {
            moreDetailsButton.style.display = 'none'; // Hide if not overflowing
        }
    });
});
