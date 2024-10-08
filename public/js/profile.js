document.addEventListener('DOMContentLoaded', function() {
    const radioButtons = document.querySelectorAll('input[name="theme_color"]');


    const images = document.querySelectorAll('.image');


    function hideAllImages() {
        images.forEach(image => {
            image.classList.add('hide-images');
        });
    }


    radioButtons.forEach(button => {
        button.addEventListener('change', function() {
            hideAllImages(); // Hide all images first


            const selectedImage = document.querySelector(`#image${this.id.slice(-1)}`);
            if (selectedImage) {
                selectedImage.classList.remove('hide-images');
            }
        });
    });


    document.querySelector('input[name="theme_color"]:checked').dispatchEvent(new Event('change'));
});
