document.addEventListener('DOMContentLoaded', function () {
    var calendarEl = document.getElementById('calendar');
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
        }


    });
    calendar.render();

});

