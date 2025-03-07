@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'Dashboard')

@section('content')
<div class="card mt-3">
    <div class="card-header">
        <h5>สถิติระบบ</h5>
    </div>
    <div class="card-body">
        <canvas id="dashboardChart"></canvas>
    </div>
</div>

    <h3 style="padding-top: 10px;">ยินดีต้อนรับเข้าสู่ระบบจัดการข้อมูลวิจัยของสาขาวิชาวิทยาการคอมพิวเตอร์</h3>
    <br>
    <h4>สวัสดี {{ Auth::user()->position_th }} {{ Auth::user()->fname_th }} {{ Auth::user()->lname_th }}</h4><br>

    <h4>Dashboard</h4>

    @if(Auth::user()->hasRole('admin') || (isset(Auth::user()->is_admin) && Auth::user()->is_admin))
    <div class="card mt-3">
            <div class="card-header">
                <h5>สรุปข้อมูลระบบ</h5>
            </div>
            <div class="card-body">
                <h6>ข้อมูลพื้นฐาน</h6>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <strong>จำนวนบัญชีผู้ใช้ทั้งหมด:</strong> {{ $totalUsers }}
                    </li>
                    <li class="list-group-item">
                        <strong>จำนวนเอกสารวิจัยทั้งหมด:</strong> {{ $totalPapers }}
                    </li>
                </ul>

                @if($summaryData)
                    <h6 class="mt-3">Activity Logs</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>จำนวนการกระทำทั้งหมด:</strong> {{ $summaryData['activity']['total'] }}</li>
                        <li class="list-group-item"><strong>จำนวนการล็อกอิน:</strong> {{ $summaryData['activity']['logins'] }}</li>
                        <li class="list-group-item"><strong>จำนวนการล็อกเอาท์:</strong> {{ $summaryData['activity']['logouts'] }}</li>
                    </ul>
                    <h6 class="mt-3">HTTP Errors</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>จำนวนข้อผิดพลาด HTTP (400+):</strong> {{ $summaryData['http_errors'] }}</li>
                    </ul>
                    <h6 class="mt-3">System Errors</h6>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>จำนวนข้อผิดพลาดระบบ:</strong> {{ $summaryData['system_errors'] }}</li>
                    </ul>
                @else
                    <p class="text-muted mt-3">ไม่พบข้อมูล Log สำหรับการสรุป</p>
                @endif

                <h6 class="mt-3">ผู้ใช้ที่บ่อยที่สุด (Top 10)</h6>
                @if(!empty($topActiveUsers))
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Total Activity</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($topActiveUsers as $index => $activeUser)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $activeUser['email'] }}</td>
                                        <td>{{ $activeUser['total_activity'] }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.user.activity', $activeUser['user_id']) }}" class="btn btn-sm btn-primary">ดูรายละเอียด</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted">ไม่มีข้อมูลผู้ใช้ที่活跃</p>
                @endif
            </div>
        </div>
    @endif


@endsection

@push('styles')
<style>
    .table-responsive {
        overflow-x: auto;
        max-width: 100%;
    }
    .details-cell, .timestamp-cell, .ip-cell {
        max-width: 250px;
        word-wrap: break-word;
        overflow-wrap: break-word;
        white-space: normal;
    }
    .details-cell ul {
        margin-bottom: 0;
        padding-left: 15px;
        list-style-type: disc;
    }
    .details-cell li {
        margin: 0;
        padding: 0;
    }
    .card {
        border-radius: 8px;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }
    .nav-tabs .nav-link {
        border-radius: 0.25rem 0.25rem 0 0;
    }
    .nav-tabs .nav-link.active {
        background-color: #fff;
        border-bottom: none;
    }.card {
        border-radius: 8px;
    }
    .list-group-item {
        padding: 0.5rem 1rem;
    }
    h6 {
        font-weight: bold;
        color: #333;
    }
</style>
@endpush

@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInputs = document.querySelectorAll('input[name="activity_search"], input[name="http_search"], input[name="system_search"]');
        searchInputs.forEach(input => {
            input.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.form.submit();
                }
            });
        });
    });
</script>
@endpush


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['บัญชีผู้ใช้', 'เอกสารวิจัย', 'กิจกรรมทั้งหมด', 'ล็อกอิน', 'ล็อกเอาท์', 'HTTP Errors', 'System Errors'],
                datasets: [{
                    label: 'จำนวน',
                    data: [
                        { $totalUsers },
                        { $totalPapers },
                        { $summaryData,['activity']:['total'] ?? 0 },
                        { $summaryData,['activity']:['logins'] ?? 0 },
                        { $summaryData,['activity']:['logouts'] ?? 0 },
                        { $summaryData,['http_errors'] : 0 },
                        { $summaryData,['system_errors'] : 0 }
                    ],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.6)',
                        'rgba(54, 162, 235, 0.6)',
                        'rgba(255, 206, 86, 0.6)',
                        'rgba(153, 102, 255, 0.6)',
                        'rgba(255, 159, 64, 0.6)',
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(201, 203, 207, 0.6)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(201, 203, 207, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endpush


