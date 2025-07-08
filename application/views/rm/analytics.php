<?php
include('header.php');
?>
<!-- Main Wrapper -->
<div class="main-wrapper">

    <!-- Sidebar -->
    <?php include('side_bar.php'); ?>

    <!-- Page Wrapper -->
    <div class="page-wrapper" style="min-height: 653px;">
        <div class="content container-fluid">

            <!-- Page Header -->
            <?php include('breadcum.php'); ?>

            <?php include('alerts.php'); ?>

            <div class="card-body">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-md-5">
                        <!-- Counseling Chart -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Counseling</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="monthlyCounselingChart" height="150"></canvas>
                            </div>
                        </div>

                        <!-- Top Educators -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Top Educators</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="topEducatorsChart" height="100"></canvas>
                            </div>
                        </div>

                        <!-- Brands Chart -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Brands Distribution</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center">
                                    <div class="col-6">
                                        <canvas id="ciplaChart" width="150" height="150"></canvas>
                                        <div class="mt-2">Cipla</div>
                                    </div>
                                    <div class="col-6">
                                        <canvas id="nonCiplaChart" width="150" height="150"></canvas>
                                        <div class="mt-2">Non-Cipla</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Right Column -->
                    <div class="col-md-7">
                        <!-- Camp Chart -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Educators Camp</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="campChart" height="100"></canvas>
                            </div>
                        </div>

                        <!-- Obesity Chart -->
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title">Doctor Prescribed Cipla Brands</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="obesityChart" height="150"></canvas>
                            </div>
                        </div>

                        <!-- Blood Pressure Chart -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Doctor Not Prescribed Cipla Brands</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="bpChart" height="100"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /Main Wrapper -->

<?php include('footer.php'); ?>

<!-- CHARTS SCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const API_BASE_URL = '<?= base_url() ?>Charts/rm';

        async function fetchChartData(endpoint, params = {}) {
            try {
                const url = new URL(`${API_BASE_URL}${endpoint}`);
                Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));
                const response = await fetch(url);
                if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                const data = await response.json();
                if (!data.success) throw new Error(data.message || 'Failed to fetch data');
                return data.data;
            } catch (error) {
                console.error(`Error fetching ${endpoint}:`, error);
                return null;
            }
        }

        async function initializeCharts() {
            const [
                monthlyData,
                educatorsData,
                genderData,
                campData,
                bpData,
                obesityData
            ] = await Promise.all([
                fetchChartData('monthly_counseling'),
                fetchChartData('top_educators', { limit: 5 }),
                fetchChartData('gender_distribution'),
                fetchChartData('camp_distribution'),
                fetchChartData('blood_pressure', { days: 5 }),
                fetchChartData('obesity_metrics', { days: 5 })
            ]);

            if (monthlyData) renderMonthlyChart(monthlyData);
            if (educatorsData) renderEducatorsChart(educatorsData);
            if (genderData) renderBrandChart(genderData);
            if (campData) renderCampChart(campData);
            if (bpData) renderBPChart(bpData);
            if (obesityData) renderObesityChart(obesityData);
        }

        function renderMonthlyChart(data) {
            const ctx = document.getElementById('monthlyCounselingChart').getContext('2d');
            const colorList = [
                'rgba(153, 102, 255, 0.8)',
                'rgba(54, 162, 235, 0.8)',
                'rgba(255, 99, 132, 0.8)',
                'rgba(255, 206, 86, 0.8)',
                'rgba(75, 192, 192, 0.8)',
            ];

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.month),
                    datasets: [{
                        label: 'Counseling Sessions',
                        data: data.map(item => item.count),
                        backgroundColor: colorList,
                        borderColor: colorList.map(c => c.replace('0.8', '1')),
                        borderWidth: 1,
                        borderRadius: 4,
                        barThickness: 25
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y',
                    plugins: { legend: { display: false } },
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: { display: true, text: 'Number of Sessions' }
                        },
                        y: {
                            title: { display: true, text: 'Month' }
                        }
                    }
                }
            });
        }

        function renderEducatorsChart(data) {
            data.sort((a, b) => b.session_count - a.session_count);
            const cardBody = document.querySelector('#topEducatorsChart').closest('.card-body');
            cardBody.innerHTML = `
            <ol class="list-group list-group-numbered">
                ${data.slice(0, 5).map(e => `
                    <li class="list-group-item border-0 ps-0">
                        ${e.educator_name} - ${e.session_count}
                    </li>
                `).join('')}
            </ol>
        `;
        }

        function renderBrandChart(data) {
            const ciplaData = data.find(d => d.type === 'Brand');
            const nonCiplaData = data.find(d => d.type === 'Non-brand');

            const ciplaCount = parseInt(ciplaData?.count || 0);
            const nonCiplaCount = parseInt(nonCiplaData?.count || 0);
            const total = ciplaCount + nonCiplaCount || 1;

            const centerTextPlugin = {
                id: 'centerText',
                beforeDraw(chart) {
                    const { width, height, ctx } = chart;
                    ctx.restore();
                    const fontSize = (height / 6).toFixed(2);
                    ctx.font = `${fontSize}px sans-serif`;
                    ctx.textBaseline = 'middle';
                    ctx.textAlign = 'center';
                    ctx.fillStyle = '#333';

                    const text = chart.config.options.customText;
                    ctx.fillText(text, width / 2, height / 2);
                    ctx.save();
                }
            };

            new Chart(document.getElementById('ciplaChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [ciplaCount, total - ciplaCount],
                        backgroundColor: ['#ec407a', '#e0e0e0'],
                        cutout: '80%',
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: false,
                    customText: ciplaCount.toString(),
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    }
                },
                plugins: [centerTextPlugin]
            });

            new Chart(document.getElementById('nonCiplaChart').getContext('2d'), {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [nonCiplaCount, total - nonCiplaCount],
                        backgroundColor: ['#42a5f5', '#e0e0e0'],
                        cutout: '80%',
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: false,
                    customText: nonCiplaCount.toString(),
                    plugins: {
                        legend: { display: false },
                        tooltip: { enabled: false }
                    }
                },
                plugins: [centerTextPlugin]
            });
        }


        function renderCampChart(data) {
            const ctx = document.getElementById('campChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.date),
                    datasets: [{
                        label: 'Camp',
                        data: data.map(item => item.count),
                        backgroundColor: data.map((_, i) => `hsl(${i * 360 / data.length}, 70%, 60%)`),
                        borderColor: data.map((_, i) => `hsl(${i * 360 / data.length}, 70%, 45%)`),
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, title: { display: true, text: 'Number of Participants' } },
                        x: { title: { display: true, text: 'Date' } }
                    }
                }
            });
        }

        function renderBPChart(data) {
            const ctx = document.getElementById('bpChart').getContext('2d');
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

        function renderObesityChart(data) {
            const ctx = document.getElementById('obesityChart').getContext('2d');

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


        initializeCharts();
    });
</script>