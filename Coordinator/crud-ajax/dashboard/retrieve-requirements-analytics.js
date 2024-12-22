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
                        dropdown.empty();
                        dropdown.append('<option value="all">All Requirements</option>');

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

                    if (data.noData) {
                        $("#requirements-chart").html('<p style="text-align:center; font-size:16px; color:gray;">No data available</p>');
                        return;
                    }

                    if (data.error) {
                        console.error("Error fetching chart data:", data.error);
                        alert("Unauthorized access or error fetching chart data.");
                        return;
                    }

                    const labels = ['Pending', 'Rejected', 'Approved'];
                    const series = [0, 0, 0];

                    data.labels.forEach((label, index) => {
                        const labelIndex = labels.findIndex(l => l.toLowerCase() === label.toLowerCase());
                        if (labelIndex !== -1) {
                            series[labelIndex] = data.series[index];
                        }
                    });

                    const chartData = {
                        series: [{ name: 'Requirement Status', data: series }],
                        labels,
                        chart: { type: 'bar', height: 380 },
                        plotOptions: {
                            bar: {
                                distributed: true,
                                horizontal: false // Set to false for a column chart
                            }
                        },
                        colors: ['#FEB019', '#FF4560', '#00E396'],
                        title: {
                            text: 'Requirement Status',
                            align: 'center',
                            style: { fontSize: '18px', fontWeight: '600' }
                        },
                        xaxis: { categories: labels }, // Map labels to the x-axis
                        tooltip: { theme: 'dark' }
                    };

                    const chartElement = document.querySelector("#requirements-chart");
                    if (chartElement) {
                        chartElement.innerHTML = "";
                        const chart = new ApexCharts(chartElement, chartData);
                        chart.render();
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

    fetchRequirements();
    fetchChartData();

    $('#requirement-dropdown').change(function () {
        const selectedRequirement = $(this).val();
        fetchChartData(selectedRequirement);
    });
});