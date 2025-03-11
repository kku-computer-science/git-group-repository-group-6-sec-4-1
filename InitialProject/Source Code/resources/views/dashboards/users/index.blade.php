@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'Dashboard')

@section('content')
<div class="container mt-0">
    <h3 class="text-center text-primary">ยินดีต้อนรับเข้าสู่ระบบจัดการข้อมูลวิจัยของสาขาวิชาวิทยาการคอมพิวเตอร์</h3>
    <h4 class="text-center">สวัสดี {{ Auth::user()->position_th }} {{ Auth::user()->fname_th }} {{ Auth::user()->lname_th }}</h4>
    <h4 class="text-center text-secondary">Dashboard</h4>

    @if(Auth::user()->hasRole('admin') || (isset(Auth::user()->is_admin) && Auth::user()->is_admin))
    <div class="d-flex justify-content-between mb-4">
        <div class="d-flex gap-4 align-items-center">
            <h2>Dashboard อิอิ</h2>
            <input type="text" class="form-control" placeholder="Search..." style="width: 200px;" name="activity_search">
            <input type="date" class="form-control" name="selected_date" style="width: 150px;">
            <button type="submit" class="btn btn-primary" onclick="filterDashboard()">Filter</button>
            <strong>Users Online:</strong> <span class="badge bg-success">{{ $usersOnline }}</span>
        </div>
    </div>

    <div class="container">
        <div class="row d-flex align-items-stretch">
            <div class="col-9 d-flex flex-column">
                <div class="row flex-grow-1 h-50">
                    <div class="col-md-4 d-flex">
                        <div class="card shadow-sm flex-fill">
                            <div class="card-header bg-primary text-white">
                                <h5>การแจ้งเตือนสำคัญ</h5>
                            </div>
                            <div class="card-body text-center d-flex flex-column justify-content-center">
                                <span class="badge bg-info fs-4">{{ $totalUsers }}</span>
                            </div>
                        </div>
                    </div>

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
                            <th>Actions</th>
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
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $activeUser['user_id'] }}" data-bs-toggle="dropdown" aria-expanded="false">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $activeUser['user_id'] }}">
                                        @if(!empty($activeUser['actions']))
                                            @foreach($activeUser['actions'] as $action => $count)
                                                <li><span class="dropdown-item">{{ ucfirst(str_replace('_', ' ', $action)) }}: {{ $count }} ครั้ง</span></li>
                                            @endforeach
                                        @else
                                            <li><span class="dropdown-item">ไม่มีข้อมูล Action</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
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
                        <div class="card shadow-sm flex-fill">
                            <div class="card-header bg-primary text-white">
                                <h5>จำนวนบัญชีผู้ใช้ทั้งหมด</h5>
                            </div>
                            <div class="card-body text-center d-flex align-items-center justify-content-center">
                                <span class="badge bg-info fs-4">{{ $totalUsers }}</span>
                            </div>
                        </div>

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
                    <div class="col-md-12 d-flex mt-3">
                        <div class="card shadow-sm flex-fill">
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


<style>
    html,
    body {
        height: 100%;
        overflow-y: auto;
    }

    .container {
        min-height: 100vh;
        overflow-y: auto;
        margin-top: 0 !important;
        padding-top: 0 !important;
    }

    .row {
        flex-wrap: nowrap;
    }

    .row.h-50 {
        height: auto !important;
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

    #httpErrorsChart {
        max-height: 400px;
    }
    
    .table tbody tr {
        position: relative;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }

    .dropdown-menu {
        width: 100%; /* ทำให้ dropdown กว้างเต็มแถว */
        max-height: 200px;
        overflow-y: auto;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .dropdown-item {
        font-size: 0.9rem;
        padding: 8px 15px;
        cursor: default; /* ปิด cursor pointer เพราะไม่ต้องคลิก */
    }

    .dropdown-item:hover {
        background-color: #e9ecef;
    }

    /* ปรับ cursor ให้เหมือนแถบที่คลิกได้ */
    .dropdown-toggle {
        cursor: pointer;
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
        const selectedDate = document.querySelector('input[name="selected_date"]').value;
        const activitySearch = document.querySelector('input[name="activity_search"]').value;
        
        let url = "{{ route('dashboard') }}?granularity=" + selectedGranularity;
        if (selectedDate) url += "&selected_date=" + selectedDate;
        if (activitySearch) url += (selectedDate ? "&" : "?") + "activity_search=" + activitySearch;

        console.log('Granularity changed to:', selectedGranularity);
        window.location.href = url;
    };

    window.filterDashboard = function() {
        const selectedDate = document.querySelector('input[name="selected_date"]').value;
        const activitySearch = document.querySelector('input[name="activity_search"]').value;
        
        let url = "{{ route('dashboard') }}";
        if (selectedDate) url += "?selected_date=" + selectedDate;
        if (activitySearch) url += (selectedDate ? "&" : "?") + "activity_search=" + activitySearch;

        window.location.href = url;
    };

    const httpErrorsData = {!! json_encode($summaryData['top5'] ?? []) !!};
    console.log('Raw httpErrorsData:', httpErrorsData);

    const granularity = "{{ $summaryData['granularity'] ?? 'hourly' }}";
    console.log('Granularity:', granularity);

    let chartInstance = null;

    function transformDataForChart(data, granularity) {
        let labels, datasets = [];
        const statusCounts = {};

        Object.values(data).forEach(errors => {
            Object.entries(errors).forEach(([status, count]) => {
                statusCounts[status] = (statusCounts[status] ?? 0) + count;
            });
        });

        const uniqueStatusCodes = Object.keys(statusCounts).map(Number).sort().slice(0, 5);
        console.log('Unique Status Codes:', uniqueStatusCodes);

        switch (granularity) {
            case 'hourly':
            case 'daily': 
                labels = Array.from({ length: 24 }, (_, i) => `${String(i).padStart(2, '0')}:00`);
                break;
            case 'weekly':
                labels = ['Sat', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sun'];
                break;
            case 'monthly':
                labels = Array.from({ length: 31 }, (_, i) => i + 1);
                break;
            default:
                labels = Object.keys(data);
        }

        datasets = uniqueStatusCodes.map(status => {
            const dataPoints = new Array(labels.length).fill(0);

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
                } else if (granularity === 'weekly') {
                    const date = new Date(interval);
                    const dayIndex = date.getDay();
                    const dayMap = [6, 1, 2, 3, 4, 5, 0];
                    const adjustedIndex = dayMap[dayIndex];
                    if (adjustedIndex < labels.length) dataPoints[adjustedIndex] += count;
                } else if (granularity === 'monthly') {
                    const day = parseInt(interval.split('-')[2]);
                    if (day <= labels.length) dataPoints[day - 1] += count;
                }
            });

            console.log(`Data for Status ${status}:`, dataPoints);
            return {
                label: `HTTP ${status}`,
                data: dataPoints,
                backgroundColor: getColorForStatus(status),
                borderColor: getColorForStatus(status),
                borderWidth: 1
            };
        });

        return { labels, datasets };
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

        const { labels, datasets } = transformDataForChart(httpErrorsData, granularity);
        console.log('Transformed Labels:', labels);
        console.log('Transformed Datasets:', datasets);

        try {
            chartInstance = new Chart(ctx, {
                type: 'bar',
                data: { labels, datasets },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { position: 'top' },
                        title: { display: true, text: `Top 5 HTTP Errors (${granularity.charAt(0).toUpperCase() + granularity.slice(1)})` }
                    },
                    scales: {
                        x: { title: { display: true, text: granularity === 'hourly' || granularity === 'daily' ? 'Hour' : granularity === 'weekly' ? 'Day of Week' : 'Day of Month' } },
                        y: { beginAtZero: true, title: { display: true, text: 'Number of Errors' } }
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

        // Set default value for date input if it exists in URL
        const urlParams = new URLSearchParams(window.location.search);
        const selectedDate = urlParams.get('selected_date');
        const activitySearch = urlParams.get('activity_search');
        if (selectedDate) document.querySelector('input[name="selected_date"]').value = selectedDate;
        if (activitySearch) document.querySelector('input[name="activity_search"]').value = activitySearch;
    });
</script>