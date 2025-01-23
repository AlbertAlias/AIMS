$(document).ready(function () {
    const chartElement = $("#handles-chart");

    function showError(message) {
        chartElement.html(`
            <div style="text-align: center; font-size: 16px; color: #999;">
                ${message}
            </div>
            <div style="display: flex; justify-content: center; align-items: center; height: 320px;">
                <img src="../assets/img/404-NOT-FOUND.png" alt="No Data Image" style="width: 300px; height: auto;">
            </div>
        `);
    }

    $.ajax({
        url: 'controller/dashboard/retrieve-handles.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            if (data && data.length > 0) {
                renderChart(data);
            } else {
                showError("No data available");
            }
        },
        error: function (error) {
            console.error('Error fetching data:', error);
            showError("An error occurred while loading data.");
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
