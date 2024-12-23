$(document).ready(function () {
    let chart = null; // Keep a reference to the chart instance

    // Function to validate incoming data
    function validateData(data) {
        return (
            data &&
            (parseInt(data.Dean) > 0 || parseInt(data.Coordinator) > 0 || parseInt(data.Supervisor) > 0)
        );
    }

    // Function to fetch the user analytics data
    function fetchUserAnalytics() {
        // Add a timestamp to prevent caching
        $.ajax({
            url: 'controller/dashboards/retrieve-users-analytics.php',
            method: 'GET',
            data: { timestamp: new Date().getTime() }, // Prevent cache
            success: function (response) {
                console.log("Raw response from PHP:", response);

                try {
                    const data = JSON.parse(response);
                    console.log("Parsed data:", data);

                    if (!data.error && validateData(data)) {
                        renderChart(data);
                    } else if (!validateData(data)) {
                        showError('No Data Available');
                        clearChart(); // Clear any existing chart if no data is available
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
                showError(`There was an error processing your request. Status: ${status}`);
            }
        });
    }

    // Function to render the chart with the parsed data
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

        console.log("Chart data:", chartOptions);

        // Destroy the existing chart if it exists
        if (chart) {
            chart.destroy();
        }

        // Create a new chart instance
        chart = new ApexCharts(document.querySelector("#users-chart"), chartOptions);
        chart.render();
    }

    // Function to return responsive chart options
    function getResponsiveOptions() {
        return [
            {
                breakpoint: 1024, // Adjust for tablets and smaller devices
                options: {
                    chart: {
                        width: '100%',
                        height: '350px' // Adjust the height to fit better on smaller screens
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
                breakpoint: 768, // Adjust for tablets and smaller devices
                options: {
                    chart: {
                        width: '100%',
                        height: '300px'  // Adjust the height to fit better on smaller screens
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
                breakpoint: 480, // Adjust for small devices like phones
                options: {
                    chart: {
                        width: '100%',
                        height: '250px'  // Further reduce height for small screens
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

    // Function to show error messages (using a toast or alert)
    function showError(message) {
        toastr.error(message); // Show a non-blocking toast notification
    }

    // Function to clear the chart if no data is available
    function clearChart() {
        if (chart) {
            chart.destroy();
        }
        $("#users-chart").html('<div class="text-center text-muted mt-3">No Data Available</div>');
    }

    // Expose the fetchUserAnalytics function globally for external triggers
    window.fetchUserAnalytics = debounce(fetchUserAnalytics, 500); // Debounce function added

    // Call the function to fetch data on page load
    fetchUserAnalytics();
});

// Debounce function to prevent multiple simultaneous calls
function debounce(func, delay) {
    let timeout;
    return function (...args) {
        clearTimeout(timeout);
        timeout = setTimeout(() => func.apply(this, args), delay);
    };
}