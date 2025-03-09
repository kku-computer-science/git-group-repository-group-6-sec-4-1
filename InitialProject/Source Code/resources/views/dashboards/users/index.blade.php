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

    #httpErrorsChart {
        max-height: 400px;

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
                    const dayMap = [6, 1, 2, 3, 4, 5, 0]; // Maps getDay() to labels
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

    });
</script>

@endstack