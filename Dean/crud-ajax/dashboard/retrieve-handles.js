$(document).ready(function () {
    const chartElement = $("#handles-chart");

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
                height: 400,
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                },
                toolbar: { show: true },
            },
            title: {
                text: 'Dean Department Handles',
                align: 'center',
                style: {
                    fontSize: '20px',
                    fontWeight: 'bold',
                    color: '#333',
                },
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '85%',
                },
            },
            dataLabels: {
                enabled: true,
            },
            xaxis: {
                categories: categories,
                title: { text: 'Departments' },
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return `${val} individuals`;
                    },
                },
            },
            legend: {
                position: 'bottom',
                horizontalAlign: 'center',
            },
            responsive: [
                {
                    breakpoint: 768,
                    options: {
                        chart: {
                            height: 300,
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '50%',
                            },
                        },
                        title: {
                            style: {
                                fontSize: '16px',
                            },
                        },
                        legend: {
                            fontSize: '14px',
                        },
                    },
                },
                {
                    breakpoint: 576,
                    options: {
                        chart: {
                            height: 200,
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '40%',
                            },
                        },
                        title: {
                            style: {
                                fontSize: '14px',
                            },
                        },
                        legend: {
                            fontSize: '12px',
                        },
                    },
                },
            ],
        };

        const chart = new ApexCharts(chartElement[0], options);
        chart.render();
    }
});