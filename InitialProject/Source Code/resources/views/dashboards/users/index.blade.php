@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'Dashboard')

@section('content')
<div class="container mt-3">
    <!-- ส่วนหัว -->
    <div class="dashboard-header mb-4 d-flex align-items-center justify-content-between">
        <h2 class="text-primary mb-0">Dashboard</h2>
        <div class="d-flex align-items-center">
            <div class="date-picker me-3">
                <input type="text" id="dashboardDate" class="form-control" value="{{ date('d/m/Y') }}">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <button class="btn btn-primary me-2" id="applyButton">Apply</button>
            <button class="btn btn-outline-secondary me-2" id="refreshButton"><i class="fas fa-sync-alt"></i></button>
        </div>
    </div>

    <!-- การแจ้งเตือน -->
    <div id="errorAlert" class="alert alert-danger d-none" role="alert">
        <i class="fas fa-exclamation-circle"></i> มีข้อผิดพลาดที่ยังไม่ได้แก้ไข โปรดตรวจสอบ
    </div>

    <!-- ส่วนข้อมูลหลัก -->
    <div class="row">
        <!-- Emergency (สถานะระบบ) -->
        <div class="col-md-3" style="margin-bottom: 20px;">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-bolt fa-2x text-primary"></i>
                    <h6 class="card-title mt-2">Emergency</h6>
                    <h4 id="systemStatus" class="card-text">{{ $summaryData['http_errors'] + $summaryData['system_errors'] }}</h4>
                </div>
            </div>
        </div>

        <!-- Most Active User -->
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-user-tie fa-2x text-primary"></i>
                    <h6 class="card-title mt-2">Most Active User</h6>
                    <h4 id="mostActiveUser" class="card-text">{{ $activeUser['email'] ?? 'N/A' }}</h4>
                </div>
            </div>
        </div>

        <!-- Paper -->
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-file-alt fa-2x text-primary"></i>
                    <h6 class="card-title mt-2">Paper</h6>
                    <h4 id="paperCount" class="card-text">0</h4>
                </div>
            </div>
        </div>

        <!-- Login Total, Success, Fail -->
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Login</h6>
                    <div class="row">
                        <div class="col-12">
                            <h4 id="totalLogins" class="card-text">Total: {{ $summaryData['activity']['total'] }}</h4>
                        </div>
                        <div class="col-6">
                            <h4 id="loginSuccess" class="card-text">Success: {{ $summaryData['activity']['logins'] }}</h4>
                        </div>
                        <div class="col-6">
                            <h4 id="loginFail" class="card-text">Fail: 0</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- HTTP Error Chart -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">HTTP Error</h6>
                    <canvas id="httpErrorChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Paper Fetch -->
        <div class="col-md-3">
            <div class="card text-center">
                <div class="card-body">
                    <i class="fas fa-download fa-2x text-primary"></i>
                    <h6 class="card-title mt-2">Paper Fetch</h6>
                    <h4 id="paperFetch" class="card-text">0</h4>
                </div>
            </div>
        </div>

    

    </div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    .card-body {
        padding: 20px;

    }
    .card-title {
        font-size: 1rem;
        font-weight: 600;
        color: #666;
    }
    .card-text {
        font-size: 1.5rem;
        font-weight: bold;
        color: #333;
    }
    .alert {
        border-radius: 8px;
        margin-top: 20px;
    }
    .d-none {
        display: none;
    }
    .card-body i {
        margin-bottom: 10px;
    }
    .date-picker {
        position: relative;
    }
    .date-picker i {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
    }
    #httpErrorChart {
        height: 200px !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script>
    let httpErrorChart;

    document.addEventListener('DOMContentLoaded', function () {
        // เริ่มต้น Flatpickr สำหรับ Date Picker
        flatpickr("#dashboardDate", {
            dateFormat: "d/m/Y",
            maxDate: "today",
            defaultDate: "{{ date('d/m/Y') }}",
            onChange: function() {}
        });

        // ฟังก์ชันสร้างหรืออัปเดตกราฟ
        function updateChart(chartData) {
            const ctx = document.getElementById('httpErrorChart').getContext('2d');
            if (httpErrorChart) {
                httpErrorChart.destroy();
            }
            httpErrorChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.map(item => item.label),
                    datasets: [{
                        label: 'HTTP Errors',
                        data: chartData.map(item => item.value),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        fill: true,
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        }

        // ฟังก์ชันดึงข้อมูลจาก API
        async function fetchDashboardData(selectedDate = null) {
            try {
                let url = 'https://your-api-endpoint/dashboard-data';
                if (selectedDate) {
                    const [day, month, year] = selectedDate.split('/');
                    const formattedDate = `${year}-${month}-${day}`;
                    url += `?date=${encodeURIComponent(formattedDate)}`;
                }

                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                });

                if (!response.ok) {
                    throw new Error('ไม่สามารถดึงข้อมูลจาก API ได้');
                }

                const data = await response.json();

                // อัปเดตข้อมูลในหน้าเว็บ
                document.getElementById('systemStatus').textContent = `${data.summaryData?.http_errors + data.summaryData?.system_errors || 0}`;
                document.getElementById('mostActiveUser').textContent = data.activeUser?.email || 'N/A';
                document.getElementById('paperCount').textContent = data.paperCount || 0;
                document.getElementById('totalLogins').textContent = `Total: ${data.summaryData?.activity?.total || 0}`;
                document.getElementById('loginSuccess').textContent = `Success: ${data.summaryData?.activity?.logins || 0}`;
                document.getElementById('loginFail').textContent = `Fail: ${data.summaryData?.activity?.logouts || 0}`;
                document.getElementById('paperFetch').textContent = `${data.paperFetch || 0}`;
                document.getElementById('usersOnline').textContent = `${data.usersOnline || 0} คน`;

                // อัปเดตกราฟ
                updateChart(data.chartData || []);

                // แสดงการแจ้งเตือนหากมีข้อผิดพลาด
                if (data.summaryData?.system_errors > 0 || data.summaryData?.http_errors > 0) {
                    document.getElementById('errorAlert').classList.remove('d-none');
                } else {
                    document.getElementById('errorAlert').classList.add('d-none');
                }

            } catch (error) {
                console.error('เกิดข้อผิดพลาด:', error);
                document.getElementById('errorAlert').textContent = 'เกิดข้อผิดพลาดในการดึงข้อมูล โปรดลองใหม่';
                document.getElementById('errorAlert').classList.remove('d-none');
            }
        }

        // ปุ่ม Apply
        document.getElementById('applyButton').addEventListener('click', function() {
            const selectedDate = document.getElementById('dashboardDate').value;
            if (selectedDate) {
                fetchDashboardData(selectedDate);
            } else {
                alert('กรุณาเลือกวันที่ก่อน!');
            }
        });

        // ปุ่ม Refresh
        document.getElementById('refreshButton').addEventListener('click', function() {
            const today = new Date();
            const formattedToday = `${String(today.getDate()).padStart(2, '0')}/${String(today.getMonth() + 1).padStart(2, '0')}/${today.getFullYear()}`;
            document.getElementById('dashboardDate').value = formattedToday;
            fetchDashboardData(formattedToday);
        });

        // เรียกข้อมูลเริ่มต้นเมื่อโหลดหน้า
        fetchDashboardData("{{ date('d/m/Y') }}");
    });
</script>
@endpush