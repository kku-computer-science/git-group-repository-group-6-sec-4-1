
@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'User Activity Logs')

@section('content')

<!-- Tab Navigation -->
<ul class="nav nav-tabs mb-4" id="logTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $activeTab == 'activity' ? 'active' : '' }}" href="{{ url('/logs') }}">User Activity Logs</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $activeTab == 'http' ? 'active' : '' }}" href="{{ url('/logs/http') }}">HTTP Error Logs</a>
    </li>
    <li class="nav-item" role="presentation">
        <a class="nav-link {{ $activeTab == 'system' ? 'active' : '' }}" href="{{ url('/logs/system') }}">System Error Logs</a>
    </li>
</ul>

<!-- Tab Content -->
<div class="tab-content" id="logTabContent">
    <!-- User Activity Logs Tab -->
    <div class="tab-pane fade {{ $activeTab == 'activity' ? 'show active' : '' }}" id="activity" role="tabpanel">
        <h3>User Activity Logs</h3>
        <div class="mb-3">
            <form method="GET" action="{{ url('/logs') }}" class="d-flex gap-3 align-items-end" id="activityFilterForm">
                <div class="form-group">
                    <label for="user_id">Filter by User:</label>
                    <select name="user_id" id="user_id" class="form-control">
                        <option value="">All Users</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->fname_en }} {{ $user->lname_en }} (ID: {{ $user->id }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="activity_search">Search:</label>
                    <input type="text" name="activity_search" id="activity_search" class="form-control" 
                           value="{{ request('activity_search') }}" placeholder="Search actions or details...">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ url('/logs') }}" class="btn btn-secondary">Reset</a>
            </form>
        </div>

        @if($pagedLogs && $pagedLogs->count() > 0)
            <div class="card shadow-sm mb-4">
                <div class="card-header">Activity Logs</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                    <th>Timestamp</th>
                                    <th>IP Address</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pagedLogs as $log)
                                    <tr class="@if(($log['action'] ?? '') == 'login') table-success 
                                               @elseif(($log['action'] ?? '') == 'logout') table-warning 
                                               @elseif(($log['action'] ?? '') == 'insert') table-primary 
                                               @elseif(($log['action'] ?? '') == 'update') table-info 
                                               @elseif(($log['action'] ?? '') == 'delete') table-danger @endif">
                                        <td>{{ $log['first_name'] ?? 'Unknown' }}</td>
                                        <td>{{ $log['last_name'] ?? 'Unknown' }}</td>
                                        <td>{{ Str::limit($log['email'] ?? 'Unknown', 30, '...') }} (ID: {{ $log['user_id'] ?? 'Unknown' }})</td>
                                        <td>{{ $log['action'] ?? 'Unknown' }}</td>
                                        <td class="details-cell">
                                            @if(!empty($log['details']) && is_array($log['details']))
                                                <ul class="mb-0">
                                                    @foreach($log['details'] as $key => $value)
                                                        <li>{{ $key }}: 
                                                            @if($key === 'changes')
                                                                @if(is_array($value) && isset($value['before']) && isset($value['after']))
                                                                    @if(!empty($value['before']) || !empty($value['after']))
                                                                        <br><strong>Before:</strong><br>
                                                                        @foreach($value['before'] as $field => $oldValue)
                                                                            {{ $field }}: {{ $oldValue }}<br>
                                                                        @endforeach
                                                                        <strong>After:</strong><br>
                                                                        @foreach($value['after'] as $field => $newValue)
                                                                            {{ $field }}: {{ $newValue }}<br>
                                                                        @endforeach
                                                                    @endif
                                                                @endif
                                                            @elseif($key === 'message' && $log['action'] === 'update' && isset($log['details']['target']) && $log['details']['target'] === 'password')
                                                                {{ $value }}
                                                            @else
                                                                @if(is_array($value))
                                                                    {{ json_encode($value) }}
                                                                @else
                                                                    {{ $value }}
                                                                @endif
                                                            @endif
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td class="timestamp-cell">{{ Str::limit($log['timestamp'] ?? 'Unknown', 20, '...') }}</td>
                                        <td class="ip-cell">{{ $log['ip'] ?? 'Unknown' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        {{ $pagedLogs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning mb-4">
                <strong>⚠ No Activity Logs Found!</strong> No activity logs available or filtered results are empty.
            </div>
        @endif
    </div>

    <!-- HTTP Error Logs Tab -->
    <div class="tab-pane fade {{ $activeTab == 'http' ? 'show active' : '' }}" id="http" role="tabpanel">
        <h3 class="text-danger">HTTP Error Logs</h3>
        <div class="mb-3">
            <form method="GET" action="{{ url('/logs/http') }}" class="d-flex gap-3 align-items-end" id="httpFilterForm">
                <div class="form-group">
                    <label for="http_search">Search:</label>
                    <input type="text" name="http_search" id="http_search" class="form-control" 
                           value="{{ request('http_search') }}" placeholder="Search HTTP errors...">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ url('/logs/http') }}" class="btn btn-secondary">Reset</a>
            </form>
        </div>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Timestamp</th>
                                <th>IP</th>
                                <th>Method</th>
                                <th>Status</th>
                                <th>URL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($httpErrorLogs && $httpErrorLogs->count() > 0)
                                @foreach($httpErrorLogs as $log)
                                    <tr>
                                        <td>{{ $log->timestamp }}</td>
                                        <td>{{ $log->ip }}</td>
                                        <td>{{ $log->method }}</td>
                                        <td class="text-danger fw-bold">{{ $log->status }}</td>
                                        <td>{{ $log->url }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="5" class="text-center text-muted">No HTTP error logs found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- System Error Logs Tab -->
    <div class="tab-pane fade {{ $activeTab == 'system' ? 'show active' : '' }}" id="system" role="tabpanel">
        <h3 class="text-warning">System Error Logs</h3>
        <div class="mb-3">
            <form method="GET" action="{{ url('/logs/system') }}" class="d-flex gap-3 align-items-end" id="systemFilterForm">
                <div class="form-group">
                    <label for="system_search">Search:</label>
                    <input type="text" name="system_search" id="system_search" class="form-control" 
                           value="{{ request('system_search') }}" placeholder="Search system errors...">
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ url('/logs/system') }}" class="btn btn-secondary">Reset</a>
            </form>
        </div>
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th>Timestamp</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($systemErrorLogs && $systemErrorLogs->count() > 0)
                                @foreach($systemErrorLogs as $log)
                                    <tr>
                                        <td>{{ $log->timestamp }}</td>
                                        <td>{{ $log->message }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="2" class="text-center text-muted">No system error logs found.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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