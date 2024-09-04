document.addEventListener('DOMContentLoaded', function () {
    fetch('api/mood.php')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(row => row.created_at);
            const values = data.map(row => row.score);

            const ctx = document.getElementById('moodGraph').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'My Data',
                        data: values,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        x: {
                            beginAtZero: true
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
