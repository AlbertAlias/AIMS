$(document).ready(function () {
    function fetchRequirements() {
        $.ajax({
            url: 'controller/dashboard/retrieve-requirements.php',
            method: 'GET',
            success: function (response) {
                try {
                    console.log("Raw response:", response);
                    const data = typeof response === 'string' ? JSON.parse(response) : response;

                    if (Array.isArray(data)) {
                        const dropdown = $('#requirement-dropdown');
                        dropdown.empty(); // Clear existing options
                        dropdown.append('<option value="all">All Requirements</option>'); // Default option

                        data.forEach(requirement => {
                            dropdown.append(`<option value="${requirement.requirement_id}">${requirement.title}</option>`);
                        });
                    } else {
                        console.error("Unexpected data format:", data);
                    }
                } catch (e) {
                    console.error("Error parsing requirements JSON:", e.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Failed to fetch requirements:", status, error);
            }
        });
    }

    function fetchChartData(requirementId = 'all') {
        $.ajax({
            url: 'controller/dashboard/retrieve-requirements-analytics.php',
            method: 'POST',
            data: { requirement_id: requirementId },
            success: function (response) {
                try {
                    console.log("Raw response:", response);
                    const data = typeof response === 'string' ? JSON.parse(response) : response;
    
                    if (data.error) {
                        console.error("No data for chart:", data.error);
                        alert("Unauthorized access or error fetching chart data.");
                        return;
                    }
    
                    if (data.series && data.labels) {
                        // Format series to be an array of arrays for multiple series
                        const seriesData = [{
                            name: 'Requirement Status',
                            data: data.series
                        }];
    
                        // Ensure labels are in the correct format
                        const chartData = {
                            series: seriesData,
                            labels: data.labels,
                            chart: {
                                type: 'bar',
                                height: 380
                            },
                            plotOptions: {
                                bar: {
                                    distributed: true,
                                    horizontal: true
                                }
                            },
                            colors: ['#FF4560', '#00E396', '#FEB019'],
                            title: {
                                text: `Requirement Status Counts`,
                                align: 'center',
                                style: {
                                    fontSize: '18px',
                                    fontWeight: '600'
                                }
                            },
                            tooltip: {
                                theme: 'dark'
                            }
                        };
    
                        const chartElement = document.querySelector("#requirements-chart");
                        if (chartElement) {
                            chartElement.innerHTML = ""; // Clear existing chart
                            const chart = new ApexCharts(chartElement, chartData);
                            chart.render();
                        }
                    } else {
                        console.error("No data for chart:", "Empty dataset or missing series/labels");
                    }
                } catch (e) {
                    console.error("Error parsing chart data JSON:", e.message);
                }
            },
            error: function (xhr, status, error) {
                console.error("Failed to fetch chart data:", status, error);
            }
        });
    }

    // Populate dropdown and initialize chart
    fetchRequirements();
    fetchChartData();

    // Update chart when dropdown selection changes
    $('#requirement-dropdown').change(function () {
        const selectedRequirement = $(this).val();
        fetchChartData(selectedRequirement);
    });
});