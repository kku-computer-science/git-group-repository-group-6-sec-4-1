@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <h3 class="text-center text-primary">ยินดีต้อนรับเข้าสู่ระบบจัดการข้อมูลวิจัยของสาขาวิชาวิทยาการคอมพิวเตอร์</h3>
    <h4 class="text-center">สวัสดี {{ Auth::user()->position_th }} {{ Auth::user()->fname_th }} {{ Auth::user()->lname_th }}</h4>
    <h4 class="text-center text-secondary">Dashboard</h4>

    @if(Auth::user()->hasRole('admin') || (isset(Auth::user()->is_admin) && Auth::user()->is_admin))
    <div class="d-flex justify-content-between mb-4">
        <div class="d-flex gap-4 align-items-center">
            <h2>Dashboard</h2>
            <input type="text" class="form-control shadow-sm" placeholder="Search..." style="width: 200px;">
            <input type="text" id="datePicker" class="form-control shadow-sm" placeholder="Select Date" style="width: 150px;">
            <strong>Users Online:</strong> <span class="badge bg-success fs-5 count-up" data-value="{{ $usersOnline }}">0</span>
        </div>
    </div>

    <div class="container" style="height: 100vh;">
        <div class="row d-flex align-items-stretch h-100">
            <div class="col-9 d-flex flex-column h-100">
                <div class="row flex-grow-1 h-25">
                    <!-- Critical Message -->
<div class="col-md-4 d-flex h-100">
    <div class="card shadow-sm hover-card flex-fill animated-card">
        <div class="card-header bg-primary text-white">
            <h5>การแจ้งเตือนสำคัญ</h5>
        </div>
        <div class="card-body text-center d-flex flex-column justify-content-start">
            @if(!empty($notifications) && count($notifications) > 0)
                <div class="notification-container flex-grow-1">
                    <ul class="list-group list-group-flush" id="notificationList">
                        @foreach($notifications as $notification)
                            <li class="list-group-item 
                                @if($notification['severity'] === 'high') bg-danger text-white 
                                @elseif($notification['severity'] === 'medium') bg-warning text-dark 
                                @endif" 
                                data-id="{{ $notification['id'] }}">
                                <div class="d-flex flex-column align-items-start">
                                    <strong class="notification-message text-break">{{ $notification['message'] }}</strong>
                                    <small class="text-muted notification-time">{{ $notification['time_ago'] }}</small>
                                </div>
                                <div class="mt-2 d-flex gap-2 justify-content-center">
                                    <button class="btn btn-danger btn-sm dismiss-btn" data-id="{{ $notification['id'] }}">ลบ</button>
                                    <button class="btn btn-info btn-sm check-btn" data-id="{{ $notification['id'] }}" data-ip="{{ $notification['ip'] }}" data-url="{{ $notification['url'] }}">ตรวจสอบ</button>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-muted">ไม่มีการแจ้งเตือนสำคัญ</p>
            @endif
        </div>
    </div>
</div>

                    <!-- Most Activity -->
                    <div class="col-md-4 d-flex h-100">
                        <div class="card shadow-sm hover-card flex-fill animated-card">
                            <div class="card-header bg-info text-white">
                                <h5>ผู้ใช้ที่活躍ที่สุด (Top 10)</h5>
                            </div>
                            <div class="card-body">
                                @if(!empty($topActiveUsers))
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 10%;">อันดับ</th>
                                                <th scope="col" style="width: 50%;">อีเมล</th>
                                                <th scope="col" style="width: 20%;">กิจกรรมทั้งหมด</th>
                                                <th scope="col" style="width: 20%;">รายละเอียด</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($topActiveUsers as $index => $activeUser)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $activeUser['email'] }}</td>
                                                <td><span class="count-up" data-value="{{ $activeUser['total_activity'] }}">0</span></td>
                                                <td>
                                                    <a href="{{ route('dashboard.user.activity', $activeUser['user_id']) }}" class="btn btn-sm btn-primary">ดู</a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @else
                                <p class="text-muted text-center">ไม่มีข้อมูลผู้ใช้ที่活躍</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex flex-column">
                        <!-- Total Account -->
                        <div class="card shadow-sm hover-card flex-fill animated-card">
                            <div class="card-header bg-primary text-white">
                                <h5>จำนวนบัญชีผู้ใช้ทั้งหมด</h5>
                            </div>
                            <div class="card-body text-center d-flex align-items-center justify-content-center">
                                <span class="badge bg-info fs-4 count-up" data-value="{{ $totalUsers }}">0</span>
                            </div>
                        </div>

                        <!-- Total Papers -->
                        <div class="card shadow-sm hover-card flex-fill animated-card">
                            <div class="card-header bg-primary text-white">
                                <h5>จำนวนเอกสารวิจัยทั้งหมด</h5>
                            </div>
                            <div class="card-body text-center d-flex align-items-center justify-content-center">
                                <span class="badge bg-info fs-4 count-up" data-value="{{ $totalPapers }}">0</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row flex-grow-1 h-75">
                    <div class="col-md-12 h-75">
                        <!-- HTTP Table -->
                        <div class="card mt-3 shadow-sm hover-card flex-fill animated-card">
                            <div class="card-header bg-danger text-white">
                                <h5>HTTP Errors</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <strong>จำนวนข้อผิดพลาด HTTP (400+):</strong>
                                        <span class="badge bg-light count-up" data-value="{{ $summaryData['total'] ?? 0 }}">0</span>
                                    </li>
                                </ul>

                                <div class="mb-3">
                                    <label for="granularitySelect" class="form-label">View By:</label>
                                    <select id="granularitySelect" class="form-select">
                                        <option value="hourly" {{ $summaryData['granularity'] === 'hourly' ? 'selected' : '' }}>Hourly</option>
                                        <option value="daily" {{ $summaryData['granularity'] === 'daily' ? 'selected' : '' }}>Daily</option>
                                        <option value="weekly" {{ $summaryData['granularity'] === 'weekly' ? 'selected' : '' }}>Weekly</option>
                                        <option value="monthly" {{ $summaryData['granularity'] === 'monthly' ? 'selected' : '' }}>Monthly</option>
                                    </select>
                                </div>

                                <h6>Top 5 HTTP Errors</h6>
                                <div style="position: relative; height: 400px; width: 100%;">
                                    <canvas id="httpErrorsChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3 d-flex flex-column h-100">
                <div class="row flex-grow-1 h-25">
                    <div class="col-md-12 d-flex">
                        <div class="card shadow-sm hover-card flex-fill animated-card">
                            <div class="card-header bg-primary text-white">
                                <h5>จำนวนเอกสารที่ดึงมาทั้งหมด</h5>
                            </div>
                            <div class="card-body text-center d-flex align-items-center justify-content-center">
                                <span class="badge bg-info fs-4 count-up" data-value="{{ $totalPapersFetched }}">0</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row flex-grow-1 h-75">
                    <div class="col-md-12 h-75">
                        <div class="card mt-3 shadow-sm hover-card flex-fill animated-card">
                            <div class="card-header bg-success text-white">
                                <h5>User Login Stats</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <strong>Total Login:</strong>
                                    <span class="badge bg-primary count-up" data-value="{{ ($loginStats['success'] ?? 0) + ($loginStats['fail'] ?? 0) }}">0</span>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6 d-flex flex-column">
                                        <strong>Success:</strong>
                                        <span class="badge bg-success count-up" data-value="{{ $loginStats['success'] ?? 0 }}">0</span>
                                    </div>
                                    <div class="col-6 d-flex flex-column">
                                        <strong>Fail:</strong>
                                        <span class="badge bg-danger count-up" data-value="{{ $loginStats['fail'] ?? 0 }}">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity -->
                        <div class="card shadow-sm hover-card animated-card">
    <div class="card-header bg-warning text-white">
        <h5>Recent Activity</h5>
    </div>
    <div class="card-body">
        @if(!empty($activities) && count($activities) > 0)
            <div class="activity-container">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Activity</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                            <tr>
                                <td>{{ htmlspecialchars($activity['user_email']) }}</td>
                                <td>{{ htmlspecialchars($activity['activity']) }}</td>
                                <td>{{ date('Y-m-d H:i', strtotime($activity['timestamp'])) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">No recent activities found.</p>
        @endif
    </div>
</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@stack('styles')
<style>
    html,
    body {
        height: 100%;
        overflow-y: auto;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f6f9;
    }

    .container {
        min-height: 100vh;
        padding: 20px;
    }

    .card {
        border: none;
        border-radius: 12px;
        background: #ffffff;
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Specify transitions explicitly */
        overflow: hidden;
        opacity: 0; /* Start hidden for animation */
    }

    .hover-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        padding: 15px 20px;
        border-bottom: none;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .card-body {
        padding: 20px;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .badge {
        font-size: 1.2rem;
        padding: 10px 15px;
        border-radius: 20px;
        font-weight: 500;
    }

    .fs-4 {
        font-size: 1.75rem !important;
    }

    .table-responsive {
        overflow-x: auto;
        max-width: 100%;
    }

    .table {
        margin-bottom: 0;
        font-size: 0.9rem;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f5f9;
        transition: background-color 0.3s ease;
    }

    .table thead th {
        background: #f8f9fa;
        border-bottom: 2px solid #e9ecef;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        padding: 12px;
    }

    .table td {
        vertical-align: middle;
        padding: 12px;
    }

    .btn-sm {
        padding: 5px 12px;
        font-size: 0.85rem;
        border-radius: 6px;
    }

    .text-primary {
        color: #007bff !important;
    }

    .text-secondary {
        color: #6c757d !important;
    }

    /* Notification Container Styling */
    .notification-container {
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
        flex-grow: 1;
    }

    .notification-container::-webkit-scrollbar {
        width: 8px;
    }

    .notification-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .notification-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .notification-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Activity Container Styling */
    .activity-container {
        max-height: 200px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .activity-container::-webkit-scrollbar {
        width: 8px;
    }

    .activity-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    .activity-container::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    .activity-container::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* List Item Styling for Notifications */
    .list-group-item {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        min-height: 80px;
        padding: 10px;
        border: none;
    }

    .notification-message {
        font-size: 0.9rem;
        word-wrap: break-word;
        overflow-wrap: anywhere;
        max-width: 100%;
        margin-bottom: 5px;
    }

    .notification-time {
        font-size: 0.75rem;
        margin-bottom: 5px;
    }

    .d-flex.gap-2 {
        gap: 10px;
    }

    /* Chart Styling */
    #httpErrorsChart {
        max-height: 400px;
    }

    /* Animation for Cards */
    .animated-card {
        animation: fadeInUp 0.5s ease-out forwards;
        animation-delay: calc(var(--order) * 0.2s);
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Ensure hover works after animation */
    .animated-card:hover {
        transform: translateY(-8px) !important; /* Override animation's final transform */
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .notification-message {
            font-size: 0.8rem;
        }
        .btn-sm {
            font-size: 0.7rem;
            padding: 2px 8px;
        }
        .notification-container,
        .activity-container {
            max-height: 200px;
        }
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@endpush

@stack('javascript')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    window.updateChart = function() {
        const selectedGranularity = document.getElementById('granularitySelect').value;
        console.log('Granularity changed to:', selectedGranularity);
        window.location.href = "{{ route('dashboard') }}?granularity=" + selectedGranularity;
    };

    const httpErrorsData = {!!json_encode($summaryData['top5'] ?? []) !!};
    const granularity = "{{ $summaryData['granularity'] ?? 'hourly' }}";
    const dailyBreakdown = {!!json_encode($dailyBreakdown ?? []) !!};

    let chartInstance = null;

    function transformDataForChart(data, granularity, dailyBreakdown) {
        let labels, datasets = [];
        const statusCounts = {};

        Object.values(data).forEach(week => {
            Object.entries(week).forEach(([status, count]) => {
                statusCounts[status] = (statusCounts[status] ?? 0) + count;
            });
        });

        const uniqueStatusCodes = Object.keys(statusCounts).map(Number).sort().slice(0, 5);

        switch (granularity) {
            case 'hourly':
            case 'daily':
                labels = Array.from({
                    length: 24
                }, (_, i) => `${String(i).padStart(2, '0')}:00`);
                break;
            case 'weekly':
                labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                break;
            case 'monthly':
                labels = Array.from({
                    length: 31
                }, (_, i) => i + 1);
                break;
            default:
                labels = Object.keys(data);
        }

        datasets = uniqueStatusCodes.map(status => {
            const dataPoints = new Array(labels.length).fill(0);
            if (granularity === 'weekly' && dailyBreakdown) {
                Object.entries(dailyBreakdown).forEach(([weekKey, days]) => {
                    Object.entries(days).forEach(([dayStr, errors]) => {
                        const dayDate = new Date(dayStr + 'T00:00:00Z');
                        if (!isNaN(dayDate.getTime())) {
                            const dayIndex = dayDate.getUTCDay();
                            const dayMap = [6, 0, 1, 2, 3, 4, 5];
                            const adjustedIndex = dayMap[dayIndex];
                            Object.entries(errors).forEach(([errorStatus, count]) => {
                                if (errorStatus.toString() === status.toString() && adjustedIndex >= 0 && adjustedIndex < dataPoints.length) {
                                    dataPoints[adjustedIndex] += count;
                                }
                            });
                        }
                    });
                });
            } else {
                Object.entries(data).forEach(([interval, errors]) => {
                    const count = errors[status] || 0;
                    if (granularity === 'hourly' || granularity === 'daily') {
                        const parts = interval.split(' ');
                        if (parts.length > 1 && parts[1]) {
                            const hour = parseInt(parts[1].split(':')[0]);
                            if (hour < labels.length) dataPoints[hour] += count;
                        }
                    } else if (granularity === 'monthly') {
                        const day = parseInt(interval.split('-')[2]);
                        if (day <= labels.length) dataPoints[day - 1] += count;
                    }
                });
            }
            return {
                label: `HTTP ${status}`,
                data: dataPoints,
                backgroundColor: getColorForStatus(status),
                borderColor: getColorForStatus(status),
                borderWidth: 1
            };
        });

        return {
            labels,
            datasets
        };
    }

    function renderChart() {
        const ctx = document.getElementById('httpErrorsChart')?.getContext('2d');
        if (!ctx) return;

        if (chartInstance) chartInstance.destroy();

        const {
            labels,
            datasets
        } = transformDataForChart(httpErrorsData, granularity, dailyBreakdown);

        chartInstance = new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: `Top 5 HTTP Errors (${granularity.charAt(0).toUpperCase() + granularity.slice(1)})`
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: granularity === 'hourly' || granularity === 'daily' ? 'Hour' : granularity === 'weekly' ? 'Day of Week' : 'Day of Month'
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of Errors'
                        }
                    }
                }
            }
        });
    }

    function getColorForStatus(status) {
        const colors = {
            401: 'rgba(255, 99, 132, 0.6)',
            404: 'rgba(54, 162, 235, 0.6)',
            500: 'rgba(255, 206, 86, 0.6)',
            403: 'rgba(75, 192, 192, 0.6)',
            405: 'rgba(153, 102, 255, 0.6)'
        };
        return colors[status] || 'rgba(201, 203, 207, 0.6)';
    }

    document.addEventListener('DOMContentLoaded', function() {
        renderChart();
        document.getElementById('granularitySelect')?.addEventListener('change', window.updateChart);
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.animated-card');
        cards.forEach((card, index) => {
            card.style.setProperty('--order', index); // Set delay order
        });

        // Existing chart rendering, dismiss, and check button handlers...
        renderChart();

        document.querySelectorAll('.dismiss-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                console.log('Dismissing notification with ID:', id);
                fetch(`/api/notifications/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    return response.json();
                })
                .then(data => {
                    console.log('Response data:', data);
                    if (data.success) {
                        const item = document.querySelector(`[data-id="${id}"]`);
                        if (item) item.remove();
                        alert('Notification dismissed successfully');
                    } else {
                        alert('Failed to dismiss notification: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while dismissing the notification');
                });
            });
        });

        document.querySelectorAll('.check-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const ip = this.getAttribute('data-ip');
                const url = this.getAttribute('data-url');
                const defaultStartDate = '{{ $defaultStartDate }}';
                const defaultEndDate = '{{ $defaultEndDate }}';
                const startDate = prompt('Enter start date (YYYY-MM-DD):', defaultStartDate);
                const endDate = prompt('Enter end date (YYYY-MM-DD):', defaultEndDate);

                fetch('/api/notifications/filter', {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                }).params({
                    ip: ip || '',
                    url: url || '',
                    start_date: startDate || defaultStartDate,
                    end_date: endDate || defaultEndDate,
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Filtered Notifications:', data);
                    alert('Filtered logs: ' + JSON.stringify(data));
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });

    fetch.prototype.params = function(params) {
        this.url += '?' + new URLSearchParams(params).toString();
        return this;
    };
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".count-up").forEach(el => {
            let target = parseInt(el.dataset.value) || 0;
            let count = 0;
            let duration = 2000; // 2 seconds
            let step = target / (duration / 20);

            let interval = setInterval(() => {
                count += step;
                if (count >= target) {
                    count = target;
                    clearInterval(interval);
                }
                el.textContent = Math.floor(count).toLocaleString();
            }, 20);
        });
    });
</script>

