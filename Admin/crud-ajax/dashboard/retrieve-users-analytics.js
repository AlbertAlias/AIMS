$(document).ready(function() {
    $.ajax({
        url: 'controller/dashboards/retrieve-users-analytics.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            // Prepare the data for the chart
            const series = [];
            const categories = ['Admin', 'Sub-Admin', 'Coordinator', 'Intern'];
            categories.forEach(category => {
                series.push(data[category.toLowerCase()] || 0);
            });

            // Donut chart options
            var options = {
                chart: {
                    type: 'donut',
                    height: '293px'
                },
                series: series,
                labels: categories,
                colors: ['#FF4560', '#00E396', '#008FFB', '#775DD0'],
                title: {
                    text: 'User Distribution by Type',
                    align: 'center'
                },
                dataLabels: {
                    enabled: true
                }
            };

            var chart = new ApexCharts(document.querySelector("#user-donut-chart"), options);
            chart.render();
        },
        error: function(err) {
            console.error('Error fetching user counts:', err);
        }
    });
});