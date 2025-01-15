$(document).ready(function () {
    let chart = null;

    function validateData(data) {
        return (
            data &&
            (parseInt(data.Dean) > 0 || parseInt(data.Coordinator) > 0 || parseInt(data.Supervisor) > 0)
        );
    }

    function fetchUserAnalytics() {
        $.ajax({
            url: 'controller/dashboards/retrieve-users-analytics.php',
            method: 'GET',
            data: { timestamp: new Date().getTime() },
            success: function (response) {
                try {
                    const data = JSON.parse(response);
                    if (!data.error && validateData(data)) {
                        renderChart(data);
                    } else if (!validateData(data)) {
                        clearChart();
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
                clearChart();
            }
        });
    }

    function renderChart(data) {
        const deanCount = parseInt(data['Dean']) || 0;
        const coordinatorCount = parseInt(data['Coordinator']) || 0;
        const supervisorCount = parseInt(data['Supervisor']) || 0;

        const chartOptions = {
            title: {
                text: 'Users Count',
                align: 'center',
                style: {
                    fontSize: '18px',
                    fontWeight: '600',
                    color: '#333',
                    fontFamily: 'Arial, sans-serif'
                }
            },
            tooltip: {
                enabled: true,
                theme: 'dark',
                style: {
                    fontSize: '14px',
                    fontFamily: 'Arial, sans-serif'
                },
                y: {
                    formatter: (val) => `${val} users`,
                },
                x: {
                    formatter: (val) => `Role: ${val}`,
                }
            },
            legend: {
                position: 'right',
                fontSize: '15px',
                labels: {
                    colors: '#333'
                },
                markers: {
                    width: 12,
                    height: 12,
                    radius: 50
                }
            },
            series: [deanCount, coordinatorCount, supervisorCount],
            chart: {
                type: 'pie',
                width: '100%',
                height: '100%',
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 1000,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    }
                }
            },
            labels: ['Dean', 'Coordinator', 'Supervisor'],
            colors: ['#FF5733', '#33FF57', '#3357FF'],
            plotOptions: {
                pie: {
                    expandOnClick: false,
                    donut: {
                        size: '50%'
                    },
                    customScale: 0.85,
                    hover: {
                        expand: true
                    }
                }
            },
            responsive: getResponsiveOptions()
        };

        if (chart) {
            chart.destroy();
        }

        chart = new ApexCharts(document.querySelector("#users-chart"), chartOptions);
        chart.render();
    }

    function getResponsiveOptions() {
        return [
            {
                breakpoint: 1024,
                options: {
                    chart: {
                        width: '100%',
                        height: '350px'
                    },
                    title: {
                        style: {
                            fontSize: '16px'
                        }
                    },
                    legend: {
                        position: 'bottom',
                        fontSize: '12px'
                    }
                }
            },
            {
                breakpoint: 768,
                options: {
                    chart: {
                        width: '100%',
                        height: '300px'
                    },
                    title: {
                        style: {
                            fontSize: '14px'
                        }
                    },
                    legend: {
                        position: 'bottom',
                        fontSize: '10px'
                    }
                }
            },
            {
                breakpoint: 480,
                options: {
                    chart: {
                        width: '100%',
                        height: '250px'
                    },
                    title: {
                        style: {
                            fontSize: '12px'
                        }
                    },
                    legend: {
                        position: 'bottom',
                        fontSize: '8px'
                    }
                }
            }
        ];
    }

    function clearChart() {
        if (chart) {
            chart.destroy();
        }
        $("#users-chart").html(`
        <div class="text-center" style="font-size: 16px; color: #999;">
            No data available
        </div>
        <div style="display: flex; justify-content: center; align-items: center; height: 320px;">
            <img src="../assets/img/404-NOT-FOUND.png" alt="No Data Image" style="width: 300px; height: auto;">
        </div>
    `);
    }

    window.fetchUserAnalytics = debounce(fetchUserAnalytics, 500);

    fetchUserAnalytics();
});

function debounce(func, delay) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}