$(document).ready(function() {
    const chartConfig = {
        baseColor: '#198754',
        errorMessages: {
            noData: 'No data available',
            parseError: 'Error parsing data',
            loadError: 'Error loading data'
        },
        refreshInterval: 300000
    };

    // Generate lighter and darker variations of the base color
    function generateUniqueGreenShades(baseColor, count) {
        const colors = new Set(); // Use a Set to avoid duplicates
        const [r, g, b] = hexToRgb(baseColor);

        let factor = 0.1; // Starting adjustment factor
        for (let i = 0; i < count; i++) {
            let adjustedColor;
            do {
                // Alternate between lighter and darker shades
                const adjustment = i % 2 === 0 ? factor : -factor;
                adjustedColor = rgbToHex(
                    adjustColorValue(r, adjustment),
                    adjustColorValue(g, adjustment),
                    adjustColorValue(b, adjustment)
                );
                factor += 0.1; // Increment factor to ensure no repeats
            } while (colors.has(adjustedColor)); // Ensure the color is unique

            colors.add(adjustedColor);
        }

        return Array.from(colors); // Convert Set to Array
    }

    // Convert HEX to RGB
    function hexToRgb(hex) {
        const bigint = parseInt(hex.slice(1), 16);
        const r = (bigint >> 16) & 255;
        const g = (bigint >> 8) & 255;
        const b = bigint & 255;
        return [r, g, b];
    }

    // Convert RGB to HEX
    function rgbToHex(r, g, b) {
        return `#${((1 << 24) + (r << 16) + (g << 8) + b).toString(16).slice(1)}`;
    }

    // Adjust color values for lighter/darker shades
    function adjustColorValue(value, factor) {
        return Math.min(255, Math.max(0, Math.round(value + value * factor)));
    }

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
                <img src="../assets/img/404-NOT-FOUND.png" alt="No Data Image" style="width: 300px; height: auto;">
            </div>
        `);
    }

    function fetchChartData() {
        $.ajax({
            url: 'controller/dashboards/retrieve-students-analytics.php',
            method: 'GET',
            success: function(response) {
                try {
                    const data = JSON.parse(response);
                    if (!data.error && data.length > 0) {
                        // No filtering for departments based on student count
                        let departments = data;
    
                        // Sort departments alphabetically (optional)
                        departments = sortDepartments(departments);
    
                        const series = [{
                            data: departments.map(item => parseInt(item.total) || 0)
                        }];
    
                        const colors = generateUniqueGreenShades(chartConfig.baseColor, departments.length);
    
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
