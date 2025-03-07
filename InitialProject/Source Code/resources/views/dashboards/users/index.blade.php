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
                <button class="btn btn-dark" id="viewFullLogButton">View Full Log</button>
            </div>
        </div>




        <!-- การแจ้งเตือน -->
        <div id="errorAlert" class="alert alert-danger d-none" role="alert">
            <i class="fas fa-exclamation-circle"></i> มีข้อผิดพลาดที่ยังไม่ได้แก้ไข โปรดตรวจสอบ
        </div>

        <!-- ส่วนข้อมูลหลัก -->
        <div class="row">
            <!-- สถานะระบบ (Energy) -->
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-bolt fa-2x text-primary"></i>
                        <h6 class="card-title mt-2">สถานะระบบ</h6>
                        <h4 id="systemStatus" class="card-text">{{ $summaryData['http_errors'] + $summaryData['system_errors'] }}</h4>
                    </div>
                </div>
            </div>

            <!-- ผู้ใช้ที่ใช้งานมากที่สุด
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-user-tie fa-2x text-primary"></i>
                        <h6 class="card-title mt-2">ผู้ใช้ที่ใช้งานมากที่สุด</h6>
                        <h4 id="mostActiveUser" class="card-text">$activeUser['email']/h4>
                    </div>
                </div>
            </div> -->

            <!-- การล็อกอินทั้งหมด -->
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-sign-in-alt fa-2x text-primary"></i>
                        <h6 class="card-title mt-2">การล็อกอินทั้งหมด</h6>
                        <h4 id="totalLogins" class="card-text">{{ $summaryData['activity']['total'] }}</h4>
                    </div>
                </div>
            </div>

            <!-- การล็อกอิน (สำเร็จ/ล้มเหลว) -->
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-user-check fa-2x text-primary"></i>
                        <h6 class="card-title mt-2">การล็อกอิน</h6>
                        <h4 id="loginSuccess" class="card-text">สำเร็จ: {{ $summaryData['activity']['logins'] }}/ ล้มเหลว: 0</h4>
                    </div>
                </div>
            </div>

            <!-- ผู้ใช้ที่ออนไลน์ -->
            <div class="col-md-2">
                <div class="card text-center">
                    <div class="card-body">
                        <i class="fas fa-users fa-2x text-primary"></i>
                        <h6 class="card-title mt-2">ผู้ใช้ที่ออนไลน์</h6>
                        <h4 id="usersOnline" class="card-text">0 คน</h4>
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
    </style>
    @endpush

    @push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // เริ่มต้น Flatpickr สำหรับ Date Picker
        flatpickr("#dashboardDate", {
            dateFormat: "d/m/Y",
            maxDate: "today", // จำกัดวันที่สูงสุดเป็นวันปัจจุบัน
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length > 0) {
                    fetchDashboardData(dateStr); // เรียกข้อมูลเมื่อเลือกวันที่
                }
            }
        });

        // ฟังก์ชันดึงข้อมูลจาก API
        async function fetchDashboardData(selectedDate = null) {
            try {
                let url = 'https://your-api-endpoint/dashboard-data';
                if (selectedDate) {
                    url += `?date=${encodeURIComponent(selectedDate)}`; // ส่งวันที่ไปยัง API
                }

                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': 'Bearer ' + localStorage.getItem('token') // ถ้ามี token
                    }
                });

                if (!response.ok) {
                    throw new Error('ไม่สามารถดึงข้อมูลจาก API ได้');
                }

                const data = await response.json();

                // อัปเดตข้อมูลในหน้าเว็บ
                document.getElementById('totalLogins').textContent = `${data.summaryData?.activity?.total || 0} ครั้ง`;
                document.getElementById('loginSuccess').textContent = `สำเร็จ: ${data.summaryData?.activity?.logins || 0} / ล้มเหลว: ${data.summaryData?.activity?.logouts || 0}`;
                document.getElementById('usersOnline').textContent = `${data.usersOnline || 0} คน`;
                document.getElementById('paperFetch').textContent = `${data.paperFetch || 0} ครั้ง`;
                document.getElementById('systemStatus').textContent = `${data.summaryData?.http_errors + data.summaryData?.system_errors || 0}`;
                document.getElementById('activeUsers').textContent = data.usersOnline || 0;

                // อัปเดตวันที่ในการ์ด
                document.getElementById('currentDate').textContent = selectedDate || "{{ date('d/m/Y') }}";

                // ถ้ามีข้อผิดพลาด ให้แสดงการแจ้งเตือน
                if (data.summaryData?.system_errors > 0 || data.summaryData?.http_errors > 0) {
                    document.getElementById('errorAlert').classList.remove('d-none');
                } else {
                    document.getElementById('errorAlert').classList.add('d-none');
                }

                // อัปเดตกราฟ
                updateChart(data.chartData || []);
            } catch (error) {
                console.error('เกิดข้อผิดพลาด:', error);
                document.getElementById('errorAlert').textContent = 'เกิดข้อผิดพลาดในการดึงข้อมูล โปรดลองใหม่';
                document.getElementById('errorAlert').classList.remove('d-none');
            }
        }

        // ฟังก์ชันสำหรับปุ่ม
        document.getElementById('applyButton').addEventListener('click', function() {
            const selectedDate = document.getElementById('dashboardDate').value;
            if (selectedDate) {
                fetchDashboardData(selectedDate); // เรียกข้อมูลเมื่อกด Apply
            } else {
                alert('กรุณาเลือกวันที่ก่อน!');
            }
        });

        document.getElementById('refreshButton').addEventListener('click', function() {
            document.getElementById('dashboardDate').value = "{{ date('d/m/Y') }}";
            fetchDashboardData(); // รีเฟรชข้อมูล
        });

        document.getElementById('viewFullLogButton').addEventListener('click', function() {
            window.location.href = '/logs'; // เปลี่ยนไปหน้า logs (ปรับ URL ตามระบบ)
        });

        // เรียกฟังก์ชันเมื่อหน้าโหลด
        fetchDashboardData();
    });
</script>
@endpush