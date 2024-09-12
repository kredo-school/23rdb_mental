document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
    var currentMonth, currentYear;

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        timeZone: 'UTC',
        headerToolbar: {
            left: '',  // Only previous and next buttons
            center: 'title',    // Title in the center
            right: 'prev,next'           // No buttons on the right
        },
        editable: true,
        events: '/mood-calendar', // URL to fetch events from
        eventContent: function (info) {
            let score = info.event.extendedProps.score;
            let className = '';

            if (typeof score === 'undefined') {
                className = 'mood-icon-default'; // Fallback class
            } else if (score >= 1.5) {
                className = 'mood-icon-great';
            } else if (score >= 0.5) {
                className = 'mood-icon-good';
            } else if (score >= -0.5) {
                className = 'mood-icon-ok';
            } else if (score >= -1.5) {
                className = 'mood-icon-notgood';
            } else {
                className = 'mood-icon-bad';
            }

            return {
                html: `<div class="mood-icon ${className}">${info.event.title}</div>`
            };
        },
        selectable: true,

        dayCellDidMount: function (info) {
            info.el.addEventListener('click', function () {
                console.log('Date:', info.dateStr);

                var date = info.date; // Use the date object
                var formattedDate = date.toISOString().split('T')[0];

                console.log('Selected Date:', formattedDate); // Debugging

                var modalHeader = document.getElementById('modalHeader');
                modalHeader.innerHTML = `
                    <h4>Details for ${formattedDate}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModalButton"></button>
                `;
                // var modalBody = document.getElementById('modalBody');
                // modalBody.innerHTML;
                // $('#moodModal').modal('show');

                // Fetch data for the selected date
                fetch(`/get-mood-data/${formattedDate}`)
                    .then(response => response.json())
                    .then(data => {
                        var modalBody = document.getElementById('modalBody');
                        var modalFooter = document.getElementById('modalFooter');

                        if (data.length > 0) {
                            // Calculate the average score
                            let totalScore = 0;
                            data.forEach(mood => totalScore += mood.score);
                            let averageScore = totalScore / data.length;
                            // Sort the data by created_at
                            data.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
                            // Populate modal body with mood data
                            var tableRows = data.map(mood => {
                                const date = new Date(mood.created_at);
                                let hours = date.getHours();
                                const minutes = date.getMinutes().toString().padStart(2, '0');
                                const seconds = date.getSeconds().toString().padStart(2, '0');
                                const ampm = hours >= 12 ? 'PM' : 'AM';
                                hours = hours % 12;
                                hours = hours ? hours : 12; // the hour '0' should be '12'
                                const time12 = `${hours.toString().padStart(2, '0')}:${minutes}:${seconds} ${ampm}`;

                                // Determine the image based on the mood score
                                let imageUrl;
                                if (mood.score == 2) {
                                    imageUrl = '/images/moods/great.png';
                                } else if (mood.score == 1) {
                                    imageUrl = '/images/moods/good.png';
                                } else if (mood.score == 0) {
                                    imageUrl = '/images/moods/ok.png';
                                } else if (mood.score == -1) {
                                    imageUrl = '/images/moods/notgood.png';
                                } else {
                                    imageUrl = '/images/moods/bad.png';
                                }

                                return `
                                    <tr>
                                        <td class="text-center">${time12}</td>
                                        <td class="text-center"><img src="${imageUrl}" alt="Mood Image" style="width: 50px; height: auto;"></td>
                                        <td class="text-center">${mood.score}</td>
                                    </tr>
                                `;
                            }).join('');
                            modalBody.innerHTML = `
                            <table class="table align-middle bg-white mt-0 table-hover table-bordered table-moods">
                                <thead class="small table-secondary border">
                                    <tr>
                                        <th class="text-center col-date">Date</th>
                                        <th class="text-center col-mood">Mood</th>
                                        <th class="text-center col-score">Score</th>
                                    </tr>
                                </thead>
                                <tbody class="moods-table">
                                    ${tableRows}
                                </tbody>
                            </table>
                        `;

                            // Determine the image based on the average score
                            let averageImageUrl;
                            if (averageScore >= 1.5) {
                                averageImageUrl = '/images/moods/great.png';
                            } else if (averageScore >= 0.5) {
                                averageImageUrl = '/images/moods/good.png';
                            } else if (averageScore >= -0.5) {
                                averageImageUrl = '/images/moods/ok.png';
                            } else if (averageScore >= -1.5) {
                                averageImageUrl = '/images/moods/notgood.png';
                            } else {
                                averageImageUrl = '/images/moods/bad.png';
                            }

                            modalFooter.innerHTML = `<p class="text-center">Your average mood score is <h4>${averageScore.toFixed(1)}</h4><img src="${averageImageUrl}" alt="Average Mood Image" style="width: 50px; height: auto;"></p>`;

                        } else {
                            modalBody.innerHTML = '<p>No records for this date.</p>';
                            modalFooter.innerHTML = '';
                        }
                        $('#moodModal').modal('show');

                    })
                    .catch(error => console.error('Error fetching mood data:', error));
            });
        },

        viewDidMount: function (view) {
            // Set the month and year based on the current view
            currentMonth = view.view.currentStart.getMonth() + 1; // FullCalendar months are 0-based
            currentYear = view.view.currentStart.getFullYear();
            console.log('Initial view month:', currentMonth);
            console.log('Initial view year:', currentYear);
            updateFeedbackSection(currentMonth, currentYear);
        },
        datesSet: function (info) {
            // Update the month and year when the view changes
            currentMonth = info.view.currentStart.getMonth() + 1;
            currentYear = info.view.currentStart.getFullYear();
            console.log('Dates set month:', currentMonth);
            console.log('Dates set year:', currentYear);
            updateFeedbackSection(currentMonth, currentYear);
        },

    });
    calendar.render();

    // Add event listener for search button
    // Store the calendar instance in a variable for later use
    window.myCalendar = calendar;

    document.getElementById('searchButton').addEventListener('click', function () {
        var dateInput = document.getElementById('dateInput').value;
        var [year, month] = dateInput.split('-');

        if (year && month) {
            // Ensure month is 2 digits
            month = month.padStart(2, '0');
            var formattedDate = `${year}-${month}-01`;

            calendar.gotoDate(formattedDate);
        } else {
            alert('Please enter a valid date in YYYY-MM format.');
        }
    });

    function updateFeedbackSection(month, year) {

        if (month === undefined || year === undefined) {
            console.error('Month or year is undefined');
            return;
        }

        console.log('Fetching feedback for month:', month, 'year:', year);
        fetch(`/api/feedbacks?year=${year}&month=${month}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                displayFeedback(data);
            })
            .catch(error => console.error('Error fetching feedback:', error));
    }


    function displayFeedback(feedback) {
        var feedbackStatus = document.getElementById('feedback-status');
        var editFeedbackText = document.getElementById('edit-feedback-text');
        var newFeedbackText = document.getElementById('new-feedback-text');

        if (!feedbackStatus || !editFeedbackText || !newFeedbackText) {
            console.error('Feedback elements are missing in the DOM');
            return;
        }

        if (feedback.length === 0) {
            feedbackStatus.innerHTML = 'No feedback yet. &nbsp;&nbsp;<a href="#" class="text-decoration-none feedback" data-bs-toggle="modal" data-bs-target="#feedback-input">Write your feedback of this month</a>';
            editFeedbackText.value = '';
            newFeedbackText.value = '';
        } else {
            feedbackStatus.innerHTML = `${feedback[0].feedback}`;
            editFeedbackText.value = feedback[0].feedback;
            newFeedbackText.value = feedback[0].feedback;
        }
    }

    document.getElementById('save-new-feedback')?.addEventListener('click', function (event) {
        event.preventDefault();
        var feedbackText = document.getElementById('new-feedback-text').value;
        saveFeedback(feedbackText, currentMonth, currentYear)
        var editFeedbackModal = bootstrap.Modal.getInstance(document.getElementById('edit-feedback'));
        editFeedbackModal.hide();
    });

    document.getElementById('save-edit-feedback')?.addEventListener('click', function (event) {
        event.preventDefault();
        var feedbackText = document.getElementById('edit-feedback-text').value;
        saveFeedback(feedbackText, currentMonth, currentYear, true);
    });

    document.getElementById('confirm-delete-feedback')?.addEventListener('click', function (event) {
        event.preventDefault();
        deleteFeedback(currentMonth, currentYear);
    });

    function saveFeedback(feedbackText, month, year, isEdit = false) {
        console.log('Saving feedback with month:', month, 'year:', year); // Debugging

        if (month === undefined || year === undefined) {
            console.error('Month or year is undefined');
            return;
        }

        var method = isEdit ? 'PATCH' : 'POST';
        var url = isEdit ? `/api/feedbacks?year=${year}&month=${month}` : '/api/feedbacks';

        console.log('Saving feedback using URL:', url);

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                feedback: feedbackText,
                month: month,
                year: year
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Feedback saved:', data);
            alert('Feedback saved successfully!');

            // Get the modal element
            var modalElement = document.getElementById('feedback-input');

            if (modalElement) {
                // Ensure Bootstrap's Modal instance is correctly created or fetched
                var modal = bootstrap.Modal.getInstance(modalElement);

                if (modal) {
                    modal.hide();
                } else {
                    // Create a new instance of the modal if it does not exist
                    modal = new bootstrap.Modal(modalElement);
                    modal.hide();
                }

                // Remove any remaining backdrop
                var backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.classList.remove('show');
                    setTimeout(() => backdrop.remove(), 150); // Allow fade-out transition
                }
            } else {
                console.error('Modal element not found');
            }

            // Optional: Refresh feedback section
            updateFeedbackSection(month, year);
        })
        .catch(error => console.error('Error saving feedback:', error));
    }

    function deleteFeedback(month, year) {
        if (month === undefined || year === undefined) {
            console.error('Month or year is undefined');
            return;
        }

        fetch(`/api/feedbacks?year=${year}&month=${month}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Feedback deleted:', data);
            alert('Feedback deleted successfully!');

            // Get the modal element
            var modalElement = document.getElementById('delete-feedback');
            if (modalElement) {
                // Ensure Bootstrap's Modal instance is correctly created or fetched
                var modal = bootstrap.Modal.getInstance(modalElement);

                if (modal) {
                    modal.hide();
                } else {
                    // Create a new instance of the modal if it does not exist
                    modal = new bootstrap.Modal(modalElement);
                    modal.hide();
                }

                // Remove any remaining backdrop
                var backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.classList.remove('show');
                    setTimeout(() => {
                        backdrop.remove();
                    }, 150); // Allow fade-out transition
                }
            } else {
                console.error('Modal element not found');
            }

            // Optional: Refresh feedback section
            updateFeedbackSection(month, year);
        })
        .catch(error => console.error('Error deleting feedback:', error));
    }


});
