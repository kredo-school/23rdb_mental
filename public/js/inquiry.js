$(document).ready(function () {
    console.log('123')
    $('#inquiry-form').on('submit', function (event) {
        event.preventDefault(); // Prevent the default form submission
        $.ajax({
            url: '/contactus/store',
            method: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    $('#ContactUs').modal('hide'); // Hide the form modal 
                    $('#completeInquiry').modal('show'); // Show the thank you modal 
                }
            }, error: function (xhr) {
                // Handle errors if necessary 
                console.error('Form submission failed.');
            }
        });
    });
    const myModalEl = document.getElementById('completeInquiry'); 
    console.log(myModalEl) 
    myModalEl.addEventListener('hidden.bs.modal', event => { 
        if ($(".modal-backdrop").length >= 1) {
             $(".modal-backdrop").remove();
            } 
            console.log('hidden') 
        }); 
});