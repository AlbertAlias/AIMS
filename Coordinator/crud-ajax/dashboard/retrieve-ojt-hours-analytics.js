$(document).ready(function () {
    let chart = null; // Keep a reference to the chart instance

    // Function to validate incoming data
    function validateData(data) {
        return (
            data &&
            Array.isArray(data.segments) &&
            Array.isArray(data.counts) &&
            data.segments.length === 4 &&
            data.counts.length === 4
        );
    }

    // Function to fetch the user analytics data
    function fetchUserAnalytics() {
        // Add a timestamp to prevent caching
        $.ajax({
            url: 'controller/dashboard/retrieve-ojt-hours-analytics.php',
            method: 'GET',
            data: { timestamp: new Date().getTime() }, // Prevent cache
            success: function (response) {
                console.log("Raw response from PHP:", response);

                try {
                    const data = JSON.parse(response);
                    console.log("Parsed data:", data);

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
                showError(`There was an error processing your request. Status: ${status}`);
            }
        });
    }

    // Function to render the chart with the parsed data
    function renderChart(data) {
        const segments = data.segments;
        const counts = data.counts;

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
                height: '400px', // Set a fixed height for larger screens
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
                `0 - ${segments[0]}`,
                `${segments[0] + 1} - ${segments[1]}`,
                `${segments[1] + 1} - ${segments[2]}`,
                `${segments[2] + 1} - ${segments[3]}`
            ],
            colors: [
                'rgba(204, 0, 0, 0.85)',   // Soft Red (less intense) for the first segment
                'rgba(255, 165, 0, 0.85)',   // Muted Orange for the second segment
                'rgba(70, 130, 180, 0.85)', // Soft Steel Blue for the third segment
                'rgba(34, 139, 34, 0.85)'   // Soft Green for the last segment
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

        console.log("Chart data:", chartOptions);

        // Destroy the existing chart if it exists
        if (chart) {
            chart.destroy();
        }

        // Create a new chart instance
        chart = new ApexCharts(document.querySelector("#ojthours-chart"), chartOptions);
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
                        height: '400px' // Set a larger fixed height for larger screens
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
                        height: '350px' // Adjust the height for smaller screens
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

    // Function to show error messages using SweetAlert
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