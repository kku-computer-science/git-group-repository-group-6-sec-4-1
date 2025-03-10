@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'Dashboard')

@section('content')
<div class="container mt-4">
    <h3 class="text-center text-primary">ยินดีต้อนรับเข้าสู่ระบบจัดการข้อมูลวิจัยของสาขาวิชาวิทยาการคอมพิวเตอร์</h3>
    <h4 class="text-center">สวัสดี {{ Auth::user()->position_th }} {{ Auth::user()->fname_th }} {{ Auth::user()->lname_th }}</h4>
    <h4 class="text-center text-secondary">Dashboard</h4>

    @if(Auth::user()->hasRole('admin') || (isset(Auth::user()->is_admin) && Auth::user()->is_admin))
    <div class="d-flex justify-content-between mb-4">
        <div class="d-flex gap-4">
            <h2>Dashboard อิอิ</h2>
            <input type="text" class="form-control" placeholder="Search..." style="width: 200px;">
            <input type="text" id="datePicker" class="form-control" placeholder="Select Date" style="width: 150px;">
            <strong>Users Online:</strong> <span class="badge bg-success">{{ $usersOnline }}</span>
        </div>
    </div>

    <div class="container">
        <div class="row d-flex align-items-stretch">
            <div class="col-9 d-flex flex-column">
                <div class="row flex-grow-1 h-50">
                    <!-- critical message -->
                    <div class="col-md-4 d-flex">
                        <div class="card shadow-sm flex-fill">
                            <div class="card-header bg-primary text-white">
                                <h5>การแจ้งเตือนสำคัญ</h5>
                            </div>
                            <div class="card-body text-center d-flex flex-column justify-content-start">
                                @if(!empty($notifications) && count($notifications) > 0)
                                <div class="notification-container" style="max-height: 300px; overflow-y: auto;">
                                    <ul class="list-group list-group-flush" id="notificationList">
                                        @foreach($notifications as $notification)
                                        <li class="list-group-item @if($notification['severity'] === 'high') bg-danger text-white @elseif($notification['severity'] === 'medium') bg-warning text-dark @endif" data-id="{{ $notification['id'] }}">
                                            <strong>{{ $notification['message'] }}</strong><br>
                                            <small class="text-muted">{{ $notification['time_ago'] }}</small>
                                            <div class="mt-2">
                                                <button class="btn btn-danger btn-sm dismiss-btn" data-id="{{ $notification['id'] }}">Dismiss</button>
                                                <button class="btn btn-info btn-sm check-btn" data-id="{{ $notification['id'] }}" data-ip="{{ $notification['ip'] }}" data-url="{{ $notification['url'] }}">Check</button>
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
                    <div class="col-md-4 d-flex">
                        <div class="card shadow-sm flex-fill">
                            <div class="card-header bg-info text-white">
                                <h5>ผู้ใช้ที่活躍ที่สุด (Top 10)</h5>
                            </div>
                            <div class="card-body">
                                @if(!empty($topActiveUsers))
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="table-light">
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
                                <p class="text-muted">ไม่มีข้อมูลผู้ใช้ที่活躍</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 d-flex flex-column">
                        <!-- Total Account -->
                        <div class="card shadow-sm flex-fill">
                            <div class="card-header bg-primary text-white">
                                <h5>จำนวนบัญชีผู้ใช้ทั้งหมด</h5>
                            </div>
                            <div class="card-body text-center d-flex align-items-center justify-content-center">
                                <span class="badge bg-info fs-4">{{ $totalUsers }}</span>
                            </div>
                        </div>

                        <!-- Total Papers -->
                        <div class="card mt-3 shadow-sm flex-fill">
                            <div class="card-header bg-primary text-white">
                                <h5>จำนวนเอกสารวิจัยทั้งหมด</h5>
                            </div>
                            <div class="card-body text-center d-flex align-items-center justify-content-center">
                                <span class="badge bg-info fs-4">{{ $totalPapers }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <!-- HTTP Table -->
                    <div class="card mt-3 shadow-sm flex-fill">
                        <div class="card-header bg-danger text-white">
                            <h5>HTTP Errors</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <strong>จำนวนข้อผิดพลาด HTTP (400+):</strong>
                                    <span class="badge bg-light">{{ $summaryData['total'] ?? 0 }}</span>
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

            <div class="col-3 d-flex flex-column">
                <div class="row flex-grow-1 h-50">
                    <div class="col-md-12 d-flex">
                        <div class="card shadow-sm flex-fill">
                            <div class="card-header bg-primary text-white">
                                <h5>จำนวนเอกสารที่ดึงมาทั้งหมด</h5>
                            </div>
                            <div class="card-body text-center d-flex align-items-center justify-content-center">
                                <span class="badge bg-info fs-4">{{ $totalPapersFetched }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row flex-grow-1 h-50">
                    <div class="col-md-12 d-flex">
                        <div class="card mt-3 shadow-sm flex-fill">
                            <div class="card-header bg-success text-white">
                                <h5>User Login Stats</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <strong>Total Login:</strong>
                                    <span class="badge bg-primary">{{ ($loginStats['success'] ?? 0) + ($loginStats['fail'] ?? 0) }}</span>
                                </div>
                                <div class="row">
                                    <div class="col-6 d-flex flex-column">
                                        <strong>Success:</strong>
                                        <span class="badge bg-success">{{ $loginStats['success'] ?? 0 }}</span>
                                    </div>
                                    <div class="col-6 d-flex flex-column">
                                        <strong>Fail:</strong>
                                        <span class="badge bg-danger">{{ $loginStats['fail'] ?? 0 }}</span>
                                    </div>
                                </div>
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

@push('styles')
<style>
    html,
    body {
        height: 100%;
        overflow-y: auto;
    }

    .container {
        min-height: 100vh;
        overflow-y: auto;
    }

    .row {
        flex-wrap: nowrap;
    }

    .column-split {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: 80vh;
        gap: 15px;
    }

    .section-main {
        flex: 0 0 75%;
        overflow-y: auto;
    }

    .section-sidebar {
        flex: 0 0 25%;
        overflow-y: auto;
    }

    .card {
        border-radius: 8px;
    }

    .card-body {
        padding: 1.25rem;
    }

    .badge {
        font-size: 1rem;
    }

    .fs-4 {
        font-size: 1.5rem !important;
    }

    .table-responsive {
        overflow-x: auto;
        max-width: 100%;
    }

    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }

    .text-center {
        text-align: center;
    }

    .notification-container {
        max-height: 300px;
        /* Fixed height for the container */
        overflow-y: auto;
        /* Vertical scrollbar when content overflows */
        overflow-x: hidden;
        /* Prevent horizontal scrollbar */
    }

    .notification-container::-webkit-scrollbar {
        width: 8px;
        /* Width of the scrollbar */
    }

    .notification-container::-webkit-scrollbar-track {
        background: #f1f1f1;
        /* Track color */
        border-radius: 4px;
    }

    .notification-container::-webkit-scrollbar-thumb {
        background: #888;
        /* Thumb color */
        border-radius: 4px;
    }

    .notification-container::-webkit-scrollbar-thumb:hover {
        background: #555;
        /* Thumb color on hover */
    }

    #httpErrorsChart {
        max-height: 400px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
@endpush

@Stack('javascript')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script>
    window.updateChart = function() {
        const selectedGranularity = document.getElementById('granularitySelect').value;
        console.log('Granularity changed to:', selectedGranularity);
        window.location.href = "{{ route('dashboard') }}?granularity=" + selectedGranularity;
    };

    const httpErrorsData = {!!json_encode($summaryData['top5'] ?? []) !!};
    console.log('Raw httpErrorsData:', httpErrorsData);

    const granularity = "{{ $summaryData['granularity'] ?? 'hourly' }}";
    console.log('Granularity:', granularity);

    const dailyBreakdown = {!!json_encode($dailyBreakdown ?? []) !!};
    console.log('Raw Daily Breakdown:', dailyBreakdown);

    let chartInstance = null;

    function transformDataForChart(data, granularity, dailyBreakdown) {
        let labels, datasets = [];
        const statusCounts = {};

        // Aggregate counts by status across all intervals
        Object.values(data).forEach(week => {
            Object.entries(week).forEach(([status, count]) => {
                statusCounts[status] = (statusCounts[status] ?? 0) + count;
            });
        });

        const uniqueStatusCodes = Object.keys(statusCounts).map(Number).sort().slice(0, 5);
        console.log('Unique Status Codes:', uniqueStatusCodes);

        switch (granularity) {
            case 'hourly':
            case 'daily':
                labels = Array.from({
                    length: 24
                }, (_, i) => `${String(i).padStart(2, '0')}:00`);
                break;
            case 'weekly':
                labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']; // Start Mon, end Sun
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
            const dataPoints = new Array(labels.length).fill(0); // 7 elements for weekly
            console.log(`Processing dataset for status: ${status}`);

            if (granularity === 'weekly' && dailyBreakdown) {
                console.log('Daily Breakdown received:', JSON.stringify(dailyBreakdown));
                // Ensure dailyBreakdown is an object and has weeks
                if (typeof dailyBreakdown === 'object' && dailyBreakdown !== null) {
                    Object.entries(dailyBreakdown).forEach(([weekKey, days]) => {
                        console.log(`Week Key: ${weekKey}, Days:`, days);
                        if (typeof days === 'object' && days !== null) {
                            Object.entries(days).forEach(([dayStr, errors]) => {
                                console.log(`Processing day: ${dayStr}, Errors:`, errors);
                                // Ensure dayStr is a valid date string
                                const dayDate = new Date(dayStr + 'T00:00:00Z');
                                if (isNaN(dayDate.getTime())) {
                                    console.error(`Invalid date: ${dayStr}`);
                                    return;
                                }
                                const dayIndex = dayDate.getUTCDay();
                                const dayMap = [6, 0, 1, 2, 3, 4, 5]; // Mon=0, Tue=1, ..., Sun=6
                                const adjustedIndex = dayMap[dayIndex];
                                console.log(`Day Index: ${dayIndex}, Adjusted Index: ${adjustedIndex}`);

                                // Process each status individually
                                if (typeof errors === 'object' && errors !== null) {
                                    Object.entries(errors).forEach(([errorStatus, count]) => {
                                        console.log(`Checking status ${errorStatus} (type: ${typeof errorStatus}) against ${status} (type: ${typeof status})`);
                                        if (errorStatus.toString() === status.toString()) { // Explicit string conversion
                                            if (adjustedIndex >= 0 && adjustedIndex < dataPoints.length) {
                                                dataPoints[adjustedIndex] += count;
                                                console.log(`Adding count ${count} for status ${status} at index ${adjustedIndex}`);
                                            } else {
                                                console.log('Index out of bounds:', adjustedIndex);
                                            }
                                        }
                                    });
                                } else {
                                    console.error('Errors is not an object:', errors);
                                }
                            });
                        } else {
                            console.error('Days is not an object:', days);
                        }
                    });
                } else {
                    console.error('dailyBreakdown is not an object:', dailyBreakdown);
                }
            } else {
                Object.entries(data).forEach(([interval, errors]) => {
                    const count = errors[status] || 0;
                    if (granularity === 'hourly' || granularity === 'daily') {
                        const parts = interval.split(' ');
                        if (parts.length > 1 && parts[1]) {
                            const hour = parseInt(parts[1].split(':')[0]);
                            if (hour < labels.length) dataPoints[hour] += count;
                        } else {
                            dataPoints.forEach((_, i) => dataPoints[i] += count / 24);
                        }
                    } else if (granularity === 'monthly') {
                        const day = parseInt(interval.split('-')[2]);
                        if (day <= labels.length) dataPoints[day - 1] += count;
                    }
                });
            }

            console.log(`Data for Status ${status}:`, dataPoints);
            return {
                label: `HTTP ${status}`,
                data: dataPoints,
                backgroundColor: getColorForStatus(status),
                borderColor: getColorForStatus(status),
                borderWidth: 1
            };
        });

        console.log('Transformed Labels:', labels);
        console.log('Transformed Datasets:', datasets);
        return {
            labels,
            datasets
        };
    }

    function renderChart() {
        const ctxElement = document.getElementById('httpErrorsChart');
        if (!ctxElement) {
            console.error('Error: Canvas element #httpErrorsChart not found in the DOM');
            return;
        }
        console.log('Canvas element found:', ctxElement);

        const ctx = ctxElement.getContext('2d');
        if (!ctx) {
            console.error('Error: Unable to get 2D context from canvas');
            return;
        }
        console.log('2D context obtained successfully');

        if (chartInstance) {
            chartInstance.destroy();
            console.log('Previous chart instance destroyed');
        }

        const {
            labels,
            datasets
        } = transformDataForChart(httpErrorsData, granularity, dailyBreakdown); // Pass dailyBreakdown here
        console.log('Transformed Labels:', labels);
        console.log('Transformed Datasets:', datasets);

        try {
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
            console.log('Chart initialized successfully');
        } catch (error) {
            console.error('Error initializing chart:', error);
        }
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
        console.log('DOM fully loaded, attempting to render chart');
        renderChart();

        const granularitySelect = document.getElementById('granularitySelect');
        if (granularitySelect) {
            granularitySelect.addEventListener('change', window.updateChart);
            console.log('Granularity select event listener added');
        } else {
            console.error('Granularity select element not found');
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.dismiss-btn').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch(`/api/notifications/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const item = document.querySelector(`div[data-id="${id}"]`);
                    if (item) item.remove();
                    alert('Notification dismissed successfully');
                } else {
                    alert('Failed to dismiss notification: ' + data.message);
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });



        // Check button handler
        document.querySelectorAll('.check-btn').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const ip = this.getAttribute('data-ip');
                const url = this.getAttribute('data-url');
                const defaultStartDate = '{{ $defaultStartDate }}'; // Use passed variable
                const defaultEndDate = '{{ $defaultEndDate }}'; // Use passed variable
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
                        // Update UI or open a modal with filtered results
                        alert('Filtered logs: ' + JSON.stringify(data));
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });

    // Helper to handle fetch with params
    fetch.prototype.params = function(params) {
        this.url += '?' + new URLSearchParams(params).toString();
        return this;
    };
</script>