$(document).ready(function() {
    // Configuration constants
    const chartConfig = {
        departmentColors: {
            'BSA': '#FF69B4',
            'BSBA': '#FF0000',
            'BSCPE': '#FFA500',
            'BSCRIM': '#800000',
            'BSCS': '#A9A9A9',
            'BSED': '#ADD8E6',
            'BSHM': '#FFD700',
            'BSIT': '#D3D3D3',
            'BSTM': '#8A2BE2'
        },
        errorMessages: {
            noData: 'No Data Available',
            parseError: 'Error parsing data',
            loadError: 'Error loading data'
        },
        refreshInterval: 300000
    };

    // Utility functions

    // Filters departments with total count > 5
    function filterDepartments(data) {
        return data.filter(item => parseInt(item.total) > 5);
    }

    // Calculates total for "Other" category
    function calculateOtherTotal(data) {
        return data.filter(item => parseInt(item.total) <= 5)
                   .reduce((acc, item) => acc + parseInt(item.total), 0);
    }

    // Sorts departments alphabetically
    function sortDepartments(data) {
        return data.sort((a, b) => a.department_name.localeCompare(b.department_name));
    }

    // Displays error message in the chart container
    function showError(message) {
        $('#students-chart').html(`<p style="text-align: center; font-size: 18px; color: #999;">${message}</p>`);
    }

    // Fetches chart data and renders the chart
    function fetchChartData() {
        console.log("fetchChartData function called");

        $.ajax({
            url: 'controller/dashboards/retrieve-students-analytics.php',
            method: 'GET',
            success: function(response) {
                console.log("Raw response from PHP:", response);

                try {
                    const data = JSON.parse(response);
                    console.log("Parsed data:", data);

                    if (!data.error && data.length > 0) {
                        let departments = filterDepartments(data);
                        const otherTotal = calculateOtherTotal(data);

                        if (otherTotal > 0) {
                            departments.push({ department_name: 'Other', total: otherTotal });
                        }

                        departments = sortDepartments(departments);

                        // Prepare the series data (using actual department names for each department)
                        const series = [{
                            data: departments.map(item => parseInt(item.total) || 0)
                        }];

                        const colors = departments.map(item => chartConfig.departmentColors[item.department_name] || '#808080');

                        const chartData = {
                            series: series,
                            chart: {
                                type: 'bar',
                                width: '100%',
                                height: '380px',
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
                            plotOptions: {
                                bar: {
                                    distributed: true,
                                    horizontal: true
                                }
                            },
                            colors: colors,
                            labels: departments.map(item => item.department_name),
                            title: {
                                text: 'Student Count by Department',
                                align: 'center',
                                style: {
                                    fontSize: '18px',
                                    fontWeight: '600',
                                    color: '#333',
                                    fontFamily: 'Arial, sans-serif'
                                }
                            },
                            legend: {
                                show: false
                            },
                            tooltip: {
                                enabled: true,
                                theme: 'dark',
                                style: {
                                    fontSize: '14px',
                                    fontFamily: 'Arial, sans-serif'
                                },
                                y: {
                                    formatter: function(val) {
                                        return val + " students";
                                    }
                                },
                                x: {
                                    formatter: function(val) {
                                        return "Department: " + val;
                                    }
                                }
                            },
                            responsive: [
                                {
                                    breakpoint: 768,
                                    options: {
                                        chart: {
                                            width: '100%',
                                            height: '350px'  // Adjust the height for smaller screens
                                        },
                                        title: {
                                            fontSize: '14px'
                                        }
                                    }
                                },
                                {
                                    breakpoint: 480,
                                    options: {
                                        chart: {
                                            width: '100%',
                                            height: '250px'  // Further reduce height for phones
                                        },
                                        title: {
                                            fontSize: '12px'
                                        }
                                    }
                                }
                            ]
                        };

                        const chartElement = document.querySelector("#students-chart");
                        if (chartElement) {
                            const chart = new ApexCharts(chartElement, chartData);
                            chart.render();
                        } else {
                            console.error("Element with id 'students-chart' not found");
                        }

                    } else {
                        showError(chartConfig.errorMessages.noData);
                    }
                } catch (e) {
                    console.error('Error parsing JSON:', e);
                    showError(chartConfig.errorMessages.parseError);
                }
            },
            error: function() {
                console.error('AJAX request failed');
                showError(chartConfig.errorMessages.loadError);
            }
        });
    }

    // Initial chart fetch
    fetchChartData();

    // Handle updateChart event to refresh the chart when data is uploaded
    window.addEventListener('updateChart', function() {
        fetchChartData(); // Refresh the chart
    });
});