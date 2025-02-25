@extends('dashboards.users.layouts.user-dash-layout')

@section('title', 'User Activity Logs')

@section('content')

<h3>User Activity Logs</h3>

<div class="mb-3">
    <form method="GET" action="{{ url('/logs') }}" class="d-flex gap-3 align-items-end">
        <div class="form-group">
            <label for="user_id">Filter by User:</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">All Users</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->email }} (ID: {{ $user->id }})
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="search">Search:</label>
            <input type="text" name="search" id="search" class="form-control" 
                   value="{{ request('search') }}" placeholder="Search actions or details...">
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ url('/logs') }}" class="btn btn-secondary">Reset</a>
    </form>
</div>

@if (!empty($pagedLogs) && count($pagedLogs) > 0)
    <div class="card">
        <div class="card-header">Activity Logs</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
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
                                                                <strong>Before:</strong><br>
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

            <!-- Pagination -->
            <div class="mt-3">
                {{ $pagedLogs->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning">
        <strong>⚠ No Logs Found!</strong> No activity logs available or filtered results are empty.
    </div>
@endif

@endsection

@push('styles')
<style>
    .table-responsive {
        overflow-x: auto; /* เปิดใช้งาน scrollbar แนวนอน */
        max-width: 100%; /* จำกัดความกว้างสูงสุดของตาราง */
    }
    .details-cell, .timestamp-cell, .ip-cell {
        max-width: 250px; /* เพิ่มความกว้างของคอลัมน์ Details เพื่อรองรับข้อมูลก่อน/หลัง */
        word-wrap: break-word; /* หากข้อความยาวให้ตัดคำ */
        overflow-wrap: break-word;
        white-space: normal; /* ให้ข้อความแตกบรรทัด */
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
</style>
@endpush