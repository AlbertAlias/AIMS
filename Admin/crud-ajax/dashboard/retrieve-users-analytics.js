$(document).ready(function() {
    let chart; // Global variable to store the chart instance

    function renderChart(data) {
        const series = [];
        const categories = ['Admin', 'Sub-Admin', 'Coordinator'];

        categories.forEach(category => {
            series.push(data[category.toLowerCase()] || 0);
        });

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
                name: 'User Count',
                data: series
            }],
            xaxis: {
                categories: categories,
                title: {
                    text: 'User Roles'
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
                    endingShape: 'rounded',
                    colors: {
                        ranges: [
                            { from: 0, to: 1, color: '#00E396' },
                            { from: 1, to: 2, color: '#00E396' },
                            { from: 2, to: 3, color: '#3357FF' }
                        ]
                    }
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

        chart = new ApexCharts(document.querySelector("#users-chart"), options);
        chart.render();
    }

    $.ajax({
        url: 'controller/dashboards/retrieve-users-analytics.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            renderChart(data);
        },        
        error: function(err) {
            console.error('Error fetching user counts:', err);
        }
    });

    // Listen for window resize events
    $(window).on('resize', function() {
        if (chart && typeof chart.resize === 'function') {
            chart.resize(); // Resize the chart on window resize
        }
    });    
});