try{

    document.addEventListener('DOMContentLoaded', function() {
        var textContainers = document.querySelectorAll('.text-container');

        textContainers.forEach(function(container) {
            var textContent = container.querySelector('.text-content');
            var moreDetailsButton = container.querySelector('.more-details');

            // Check if the content is overflowing
            // if (textContent.scrollWidth > textContent.clientWidth) {
                // moreDetailsButton.style.display = 'block'; // Show the button
                // moreDetailsButton.addEventListener('click', function() {
                    // alert('More details here!'); // Replace this with your functionality
            //     });
            //     moreDetailsButton.style.display = 'block';
            // } else {
                // moreDetailsButton.style.display = 'hidden'; // Hide if not overflowing

            // }
        try{
            if (textContent.scrollWidth > textContent.clientWidth) {
                moreDetailsButton.style.display = 'block';
                moreDetailsButton.addEventListener('click', function() {
                    var modalId = moreDetailsButton.getAttribute('data-bs-target');
                    var modal = document.querySelector(modalId);

                    var dateElement = container.closest('td').querySelector('.text-center');
                    var modalDate = modal.querySelector('.date-display');
                    var modalBody = modal.querySelector('.modal-body');
                    modalDate.textContent = dateElement ? dateElement.textContent : 'Unknown Date';
                    modalBody.textContent = textContent.textContent;

                    var bsModal = new bootstrap.Modal(modal);
                    bsModal.show();
                });
            } else {
                moreDetailsButton.style.display = 'none';
            }
        } catch (error) {
            console.error("An error occurred:", error.message);
        };

        });
    });
    } catch (error) {
        console.error("An error occurred:", error.message);
    };

// try {

//     document.addEventListener('DOMContentLoaded', function () {
//         var textContainers = document.querySelectorAll('.text-container');

//         textContainers.forEach(function (container) {
//             try {
//                 var textContent = container.querySelector('.text-content');
//                 var moreDetailsButton = container.querySelector('.more-details');
//                 if (!textContent || !moreDetailsButton) {
//                     console.warn('textContent or moreDetailsButton is null. Skipping this container.');
//                     return;
//                 }
//                 console.log('textContent.scrollWidth:', textContent.scrollWidth);
//                 console.log('textContent.clientWidth:', textContent.clientWidth);
//                 if (textContent.scrollWidth > 500) {
//                     moreDetailsButton.style.display = 'block';
//                     moreDetailsButton.addEventListener('click', function () {
//                         var modalId = moreDetailsButton.getAttribute('data-bs-target');
//                         var modal = document.querySelector(modalId);
//                         if (!modal) {
//                             console.error('Modal element not found.');
//                             return;
//                         }
//                         var dateElement = container.closest('tr').querySelector('.text-center');
//                         var modalDate = modal.querySelector('.date-display');
//                         var modalBody = modal.querySelector('.modal-body');
//                         if (dateElement && modalDate) {
//                             modalDate.textContent = dateElement.textContent;
//                         } else {
//                             console.error('Date element or modal date display not found.');
//                         }
//                         if (modalBody) {
//                             modalBody.textContent = textContent.textContent;
//                         } else {
//                             console.error('Modal body not found.');
//                         }
//                         var bsModal = new bootstrap.Modal(modal);
//                         bsModal.show();
//                     });
//                 } else {
//                     moreDetailsButton.style.display = 'none';
//                 }
//             } catch (error) {
//                 console.error('An error occurred:', error.message);
//             }


//         });
//     });
// } catch (error) {
//     console.error("An error occurred:", error.message);
// };
