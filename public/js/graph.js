// public/js/graph.js

google.charts.load('current', { packages: ['corechart'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    fetch('/mood-graph')
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            let today = new Date();
            let startDate = new Date();
            startDate.setDate(today.getDate() - 6);

            let allDates = [];
            for (let i = 0; i < 7; i++) {
                let date = new Date(startDate);
                date.setDate(startDate.getDate() + i);
                allDates.push(date.toISOString().split('T')[0]); // Format date as YYYY-MM-DD
            }

            let scoresMap = {};
            data.forEach(item => {
                let date = new Date(item.created_at).toISOString().split('T')[0];
                if (allDates.includes(date)) {
                    scoresMap[date] = item.score;
                }
            });

            // Interpolate missing points
            let chartData = [['Date', 'Score']];
            allDates.forEach(date => {
                if (scoresMap[date] === undefined) {
                    // If no data, use average score or some other placeholder value
                    scoresMap[date] = null; // Use null to indicate no data
                }
                chartData.push([new Date(date), scoresMap[date]]);
            });

            let dataTable = google.visualization.arrayToDataTable(chartData);

            let options = {
                title: 'Your Scores Over the Last 7 Days',
                hAxis: {
                    title: 'Date',
                    format: 'M/d/yy', // Customize the date format as needed
                    slantedText: true, // Rotate x-axis labels if needed
                    slantedTextAngle: 45, // Angle of x-axis labels
                    ticks: allDates.map(date => new Date(date)) // Ensure only 7 ticks are set
                },
                vAxis: {
                    title: 'Score',
                    ticks: [-2, -1, 0, 1, 2] // Custom y-axis labels
                },
                legend: 'none',
                series: {
                    0: { lineWidth: 2, pointSize: 5 } // Adjust line width and point size
                }
            };

            let chart = new google.visualization.LineChart(document.getElementById('graph_div'));
            chart.draw(dataTable, options);
        })
        .catch(error => console.error('Error fetching data:', error));
}
