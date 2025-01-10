$(document).ready(function () {
    let chart = null;

    function validateData(data) {
        return (
            data &&
            Array.isArray(data.segments) &&
            Array.isArray(data.counts) &&
            data.segments.length === 4 &&
            data.counts.length === 4 &&
            data.segments.every((segment) => typeof segment === 'number') &&
            data.counts.every((count) => typeof count === 'number')
        );
    }

    function fetchUserAnalytics() {
        const timestamp = new Date().getTime();
        $.ajax({
            url: 'controller/dashboard/retrieve-ojt-hours-analytics.php',
            method: 'GET',
            data: { timestamp: timestamp }, // Prevent cache
            success: function (response) {
                try {
                    const data = JSON.parse(response);

                    if (!data.error && validateData(data)) {
                        renderChart(data);
                    } else {
                        showError(`Error fetching data: ${data.error || 'Invalid data received'}`);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    showError('Invalid JSON response.');
                }
            },
            error: function (xhr, status, error) {
                console.error('AJAX error:', error);
                console.error('Status:', status);
                console.error('Response:', xhr.responseText);
                showError(`There was an error processing your request. Status: ${status}`);
            }
        });
    }

    function renderChart(data) {
        const segments = data.segments;
        const counts = data.counts;

        // Check if counts are all zeros
        const isEmpty = counts.every((count) => count === 0);

        if (isEmpty) {
            // Show "No data available" instead of the chart
            $("#ojthours-chart").html("<div class='no-data'>No data available</div>");
            return;
        }

        const chartOptions = {
            title: {
                text: 'OJT Hours Distribution',
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
                    formatter: (val) => `${val} students`,
                },
                x: {
                    formatter: (val) => `Hours: ${val}`,
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
            series: counts,
            chart: {
                type: 'donut',
                width: '100%',
                height: '400px',
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
            labels: [
                `${segments[2] + 1} - ${segments[3]}`,
                `${segments[1] + 1} - ${segments[2]}`,
                `${segments[0] + 1} - ${segments[1]}`,
                `0 - ${segments[0]}`,
            ],
            colors: [
                'rgba(34, 139, 34, 0.85)',
                'rgba(70, 130, 180, 0.85)',
                'rgba(255, 165, 0, 0.85)',
                'rgba(204, 0, 0, 0.85)',
            ],
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

        chart = new ApexCharts(document.querySelector("#ojthours-chart"), chartOptions);
        chart.render();
    }

    function getResponsiveOptions() {
        return [
            {
                breakpoint: 1024,
                options: {
                    chart: {
                        width: '100%',
                        height: '400px'
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
                        height: '350px'
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

    function showError(message) {
        Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'error',
            title: message,
            showConfirmButton: false,
            timer: 3000,
            background: '#f8d7da',
            iconColor: '#721c24',
            color: '#721c24',
            customClass: {
                popup: 'mt-5'
            }
        });
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