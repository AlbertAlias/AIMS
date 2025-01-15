$(document).ready(function() {
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
            noData: 'No data available',
            parseError: 'Error parsing data',
            loadError: 'Error loading data'
        },
        refreshInterval: 300000
    };

    function filterDepartments(data) {
        return data.filter(item => parseInt(item.total) > 5);
    }

    function calculateOtherTotal(data) {
        return data.filter(item => parseInt(item.total) <= 5)
                   .reduce((acc, item) => acc + parseInt(item.total), 0);
    }

    function sortDepartments(data) {
        return data.sort((a, b) => a.department_name.localeCompare(b.department_name));
    }

    function showError(message) {
        $('#students-chart').html(`
            <div style="text-align: center; font-size: 16px; color: #999;">
                ${message}
            </div>
            <div style="display: flex; justify-content: center; align-items: center; height: 320px;">
                <img src="../assets/img/index/404-NOT-FOUND.png" alt="No Data Image" style="width: 300px; height: auto;">
            </div>
        `);
    }

    // Show the loading state initially
    function showLoadingState() {
        $('#students-chart').html(`
            <div style="text-align: center; font-size: 16px; color: #999;">
                Loading data...
            </div>
            <div style="display: flex; justify-content: center; align-items: center; height: 320px;">
                <img src="../assets/img/index/404-NOT-FOUND.png" alt="Loading" style="width: 300px; height: auto;">
            </div>
        `);
    }

    function fetchChartData() {
        showLoadingState(); // Display loading state while data is being fetched

        $.ajax({
            url: 'controller/dashboards/retrieve-students-analytics.php',
            method: 'GET',
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    if (!data.error && data.length > 0) {
                        let departments = filterDepartments(data);
                        const otherTotal = calculateOtherTotal(data);

                        if (otherTotal > 0) {
                            departments.push({ department_name: 'Other', total: otherTotal });
                        }

                        departments = sortDepartments(departments);

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
                                            height: '350px'
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
                                            height: '250px'
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

    fetchChartData();

    window.addEventListener('updateChart', function() {
        fetchChartData();
    });
});