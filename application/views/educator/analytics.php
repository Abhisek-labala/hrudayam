<?php
include('header.php');
?>
<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Sidebar -->
    <?php
    include('side_bar.php');
    ?>
    <!-- Page Wrapper -->
    <div class="page-wrapper" style="min-height: 653px;">
        <div class="content container-fluid">

            <!-- Page Header -->
            <?php include('breadcum.php'); ?>
            <!-- /Page Header -->

            <?php
            include('alerts.php');
            ?>

            <div class="card-body">
                <div class="row">
                    <!-- Monthly Counseling Chart -->
                    <div class="card-body">
                        <div class="row">
                            <!-- Left Column: Counseling & Gender -->
                            <div class="col-md-5">
                                <!-- Counseling Chart -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Counseling</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="monthlyCounselingChart" height="200"></canvas>
                                    </div>
                                </div>

                                <!-- Gender Chart -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Gender</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="genderChart" height="80"></canvas>
                                    </div>
                                </div>
                                <!-- Doctor Prescribed Cipla Brands -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Doctor Prescribed Cipla Brands</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="doctorChart" height="200"></canvas>
                                    </div>
                                </div>
                            </div>

                            <!-- Right Column: Camp, Obesity & Blood Pressure -->
                            <div class="col-md-7">
                                <!-- Camp Chart -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Camp</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="campChart" height="100"></canvas>
                                    </div>
                                </div>

                                <!-- Obesity Chart -->
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-title">Obesity</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="obesityChart" height="100"></canvas>
                                    </div>
                                </div>

                                <!-- Blood Pressure Chart -->
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Blood Pressure</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="bpChart" height="100"></canvas>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">Doctor Not Prescribed Cipla Brands</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="dnChart" height="100"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</div>
<!-- /Main Wrapper -->
<?php
include('footer.php');
?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Base URL for API endpoints
        const API_BASE_URL = '<?= base_url() ?>Charts/';

        // Function to fetch data from API with error handling
        async function fetchChartData(endpoint, params = {}) {
            try {
                // Show loading state
                const chartContainer = document.getElementById(`${endpoint.replace('_', '-')}-chart-container`);
                if (chartContainer) {
                    chartContainer.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin"></i> Loading data...</div>';
                }

                // Build URL with parameters
                const url = new URL(`${API_BASE_URL}${endpoint}`);
                Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

                // Fetch data
                const response = await fetch(url);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

                const data = await response.json();

                if (!data.success) {
                    throw new Error(data.message || 'Failed to fetch data');
                }

                return data.data;
            } catch (error) {
                console.error(`Error fetching ${endpoint} data:`, error);

                // Show error message in chart container
                const chartContainer = document.getElementById(`${endpoint.replace('_', '-')}-chart-container`);
                if (chartContainer) {
                    chartContainer.innerHTML = `<div class="text-center py-4 text-danger">
                    <i class="fas fa-exclamation-triangle"></i> Failed to load data: ${error.message}
                </div>`;
                }

                return null;
            }
        }

        // Initialize all charts
        async function initializeCharts() {
            // Load all chart data in parallel
            const [
                monthlyData,
                // educatorsData, 
                genderData,
                campData,
                bpData,
                obesityData,
                doctorData
            ] = await Promise.all([
                fetchChartData('monthly_counseling'),
                // fetchChartData('top_educators', {limit: 5}),
                fetchChartData('gender_distribution'),
                fetchChartData('camp_distribution'),
                fetchChartData('blood_pressure', { days: 5 }),
                fetchChartData('obesity_metrics', { days: 5 }),
                fetchChartData('doctor_metrics', { days: 5 }),
                fetchChartData('doctornot_metrics', { days: 5 })
            ]);

            // Render charts with the fetched data
            if (monthlyData) renderMonthlyChart(monthlyData);
            // if (educatorsData) renderEducatorsChart(educatorsData);
            if (genderData) renderGenderChart(genderData);
            if (campData) renderCampChart(campData);
            if (bpData) renderBPChart(bpData);
            if (obesityData) renderObesityChart(obesityData);
            if (doctorData) renderDoctorChart(doctorData);
            if (dnData) renderDoctornot(dnData);

            // Add event listeners for filters/refresh
            setupEventListeners();
        }

        function renderDoctornot(data) {
            const ctx = document.getElementById('dnChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.name),
                    datasets: [{
                        label: 'Count',
                        data: data.map(item => parseInt(item.count, 10)),
                        backgroundColor: 'rgba(251, 0, 0, 0.7)',
                        borderColor: 'rgb(224, 39, 76)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Name'
                            }
                        }
                    }
                }
            });
        }

        // Chart rendering functions
        function renderMonthlyChart(data) {
            const ctx = document.getElementById('monthlyCounselingChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.month),
                    datasets: [{
                        label: 'Counseling Sessions',
                        data: data.map(item => item.count),
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'x', // Horizontal bar chart (left to right)
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.dataset.label}: ${context.raw}`;
                                }
                            }
                        },
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Sessions'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Month'
                            }
                        }
                    }
                }
            });
        }

        //     function renderEducatorsChart(data) {
        //     // Sort educators by session count (descending)
        //     data.sort((a, b) => b.session_count - a.session_count);

        //     // Get the card body where we'll insert our list
        //     const cardBody = document.querySelector('#topEducatorsChart').closest('.card-body');

        //     // Create and insert the list HTML
        //     cardBody.innerHTML = `
        //         <div >
        //             <ol class="list-group list-group-numbered">
        //                 ${data.slice(0, 5).map((educator, index) => `
        //                     <li class="list-group-item border-0 ps-0">${educator.educator_name} - ${educator.session_count}</li>
        //                 `).join('')}
        //             </ol>
        //         </div>
        //     `;
        // }
        function renderGenderChart(data) {
            const ctx = document.getElementById('genderChart').getContext('2d');
            new Chart(ctx, {
                type: 'pie', // Circle graph
                data: {
                    labels: data.map(item => `${item.gender} (${item.count})`),
                    datasets: [{
                        data: data.map(item => item.count),
                        backgroundColor: [
                            'rgba(54, 162, 235, 0.7)', // Blue for male
                            'rgba(255, 99, 132, 0.7)', // Pink for female
                            'rgba(255, 206, 86, 0.7)' // Yellow for other
                        ],
                        borderColor: [
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = Math.round((context.raw / total) * 100);
                                    return `${context.label}: ${percentage}% (${context.raw})`;
                                }
                            }
                        },
                        legend: {
                            position: 'right'
                        }
                    }
                }
            });
        }

        function renderCampChart(data) {
            const ctx = document.getElementById('campChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // Changed to bar graph as requested
                data: {
                    labels: data.map(item => `${item.date}`),
                    datasets: [{
                        label: 'Camp',
                        data: data.map(item => item.count),
                        backgroundColor: data.map((_, i) =>
                            `hsl(${(i * 360 / data.length)}, 70%, 60%)`),
                        borderColor: data.map((_, i) =>
                            `hsl(${(i * 360 / data.length)}, 70%, 45%)`),
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `Patients: ${context.raw}`;
                                }
                            }
                        },
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Participants'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        }
                    }
                }
            });
        }

        function renderBPChart(data) {
            const ctx = document.getElementById('bpChart').getContext('2d');
            new Chart(ctx, {
                type: 'line', // Line graph as requested
                data: {
                    labels: data.map(item => new Date(item.date).toLocaleDateString()),
                    datasets: [
                        {
                            label: 'Systolic (mmHg)',
                            data: data.map(item => item.systolic),
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 2,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: 'Diastolic (mmHg)',
                            data: data.map(item => item.diastolic),
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            tension: 0.1,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.dataset.label}: ${context.raw}`;
                                }
                            }
                        },
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            title: {
                                display: true,
                                text: 'Blood Pressure (mmHg)'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        }
                    }
                }
            });
        }

        function renderDoctorChart(data) {
            const ctx = document.getElementById('doctorChart').getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.name),
                    datasets: [{
                        label: 'Count',
                        data: data.map(item => parseInt(item.count, 10)),
                        backgroundColor: 'rgba(63, 54, 235, 0.7)',
                        borderColor: 'rgb(69, 39, 224)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: true }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Count'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Name'
                            }
                        }
                    }
                }
            });
        }


        function renderObesityChart(data) {
            const ctx = document.getElementById('obesityChart').getContext('2d');
            new Chart(ctx, {
                type: 'line', // Line graph as requested
                data: {
                    labels: data.map(item => new Date(item.date).toLocaleDateString()),
                    datasets: [
                        {
                            label: 'Average BMI',
                            data: data.map(item => item.bmi),
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: 'Average WHR',
                            data: data.map(item => item.whr),
                            backgroundColor: 'rgba(153, 102, 255, 0.2)',
                            borderColor: 'rgba(153, 102, 255, 1)',
                            borderWidth: 2,
                            tension: 0.1,
                            fill: false,
                            yAxisID: 'y1'
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return `${context.dataset.label}: ${context.raw.toFixed(1)}`;
                                }
                            }
                        },
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            type: 'linear',
                            display: true,
                            position: 'left',
                            title: {
                                display: true,
                                text: 'BMI'
                            }
                        },
                        y1: {
                            type: 'linear',
                            display: true,
                            position: 'right',
                            title: {
                                display: true,
                                text: 'Waist-Hip Ratio'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Date'
                            }
                        }
                    }
                }
            });
        }

        // Setup event listeners for filters and refresh
        function setupEventListeners() {
            // Date range filter
            const dateRangeFilter = document.getElementById('date-range-filter');
            if (dateRangeFilter) {
                dateRangeFilter.addEventListener('change', async function () {
                    const days = this.value;
                    const bpData = await fetchChartData('blood_pressure', { days });
                    if (bpData) renderBPChart(bpData);

                    const obesityData = await fetchChartData('obesity_metrics', { days });
                    if (obesityData) renderObesityChart(obesityData);
                });
            }

            // Refresh button
            const refreshBtn = document.getElementById('refresh-charts');
            if (refreshBtn) {
                refreshBtn.addEventListener('click', function () {
                    // Show loading state
                    document.querySelectorAll('.chart-container').forEach(container => {
                        container.innerHTML = '<div class="text-center py-4"><i class="fas fa-spinner fa-spin"></i> Refreshing data...</div>';
                    });

                    // Reinitialize all charts
                    initializeCharts();
                });
            }
        }

        // Start initializing charts
        initializeCharts();
    });</script>