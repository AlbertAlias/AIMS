$(document).ready(function() {
    let chart; // Global variable to store the chart instance

    function renderChart(data) {
        const categories = Object.keys(data); // Get department names as categories
        const series = categories.map(category => data[category] || 0); // Get student counts

        // Calculate the maximum value for y-axis
        const maxCount = Math.max(...series);

        var options = {
            chart: {
                type: 'bar',
                height: '100%',
                events: {
                    resized: function() {
                        if (chart instanceof ApexCharts) {
                            chart.resize();
                        }
                    }
                }
            },
            series: [{
                name: 'Student Count',
                data: series
            }],
            xaxis: {
                categories: categories,
                title: {
                    text: 'Student per Departments'
                }
            },
            yaxis: {
                title: {
                    text: 'Count'
                },
                max: maxCount + 1 // Optional: set a little extra space above the highest value
            },
            dataLabels: {
                enabled: true
            },
            tooltip: {
                enabled: true,
                shared: true,
                intersect: false
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: 'rounded'
                }
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            }
        };

        // Destroy the previous chart instance if it exists
        if (chart) {
            chart.destroy();
        }

        chart = new ApexCharts(document.querySelector("#students-chart"), options);
        chart.render();
    }

    $.ajax({
        url: 'controller/dashboards/retrieve-studentDepts-analytics.php', // Make sure this URL is correct
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Departments Data received:", data); // Added log to inspect the data
            renderChart(data);
        },
        error: function (err) {
            console.error('Error fetching student department counts:', err);
        }
    });

    // Resize chart on window resize
    $(window).on('resize', function () {
        if (chart && typeof chart.resize === 'function') {
            chart.resize();
        }
    });
});