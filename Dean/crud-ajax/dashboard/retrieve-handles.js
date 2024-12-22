$(document).ready(function () {
    // Cache the DOM element
    const chartElement = $("#handles-chart");

    // Fetch data with jQuery AJAX
    $.ajax({
        url: 'controller/dashboard/retrieve-handles.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            renderChart(data);
        },
        error: function (error) {
            console.error('Error fetching data:', error);
            alert('An error occurred while fetching data. Please try again later.');
        }
    });

    // Function to render the chart
    function renderChart(data) {
        const categories = data.map(item => item.department_name);
        const coordinators = data.map(item => item.coordinators_count);
        const students = data.map(item => item.students_count);

        const options = {
            series: [
                { name: 'Coordinators', data: coordinators },
                { name: 'Students', data: students }
            ],
            chart: {
                type: 'bar',
                height: 400, // Adjust the height of the chart
                animations: {
                    enabled: true, // Enable animations for better UX
                    easing: 'easeinout', // Smooth animation easing
                    speed: 800, // Duration of the animation
                },
                toolbar: { show: true }, // Show the toolbar
            },
            title: {
                text: 'Department Handles Overview', // Chart title text
                align: 'center', // Align the title at the top
                style: {
                    fontSize: '20px', // Title font size
                    fontWeight: 'bold', // Title font weight
                    color: '#333', // Title color
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '85%',
                },
            },
            dataLabels: {
                enabled: true, // Enable data labels
            },
            xaxis: {
                categories: categories,
                title: { text: 'Departments' }, // X-axis title
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return `${val} individuals`; // Format tooltips to add context
                    },
                },
            },
            legend: {
                position: 'bottom', // Place the legend at the bottom
                horizontalAlign: 'center', // Center align the legend
            },
            responsive: [{
                breakpoint: 768, // Responsive handling for smaller screens
                options: {
                    chart: { height: 300 }, // Adjust chart height for smaller screens
                    plotOptions: { bar: { columnWidth: '50%' } }, // Adjust bar width for smaller screens
                }
            }]
        };

        // Initialize and render the chart
        const chart = new ApexCharts(chartElement[0], options);
        chart.render();
    }
});