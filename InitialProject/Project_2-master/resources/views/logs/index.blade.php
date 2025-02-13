@extends('dashboards.users.layouts.user-dash-layout')

@section('title', 'System Logs')

@section('content')

<h3>System Logs</h3>

@if (!empty($pagedLogs) && count($pagedLogs) > 0)
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5>Logs - {{ $logType ?? 'Unknown Log Type' }}</h5>
        </div>
        <div>
            <a href="{{ url('/logs?type=activity') }}" class="btn btn-secondary">Activity Logs</a>
            <a href="{{ url('/logs?type=laravel') }}" class="btn btn-secondary">Laravel Logs</a>
            <a href="{{ url('/export-logs?type=' . $logType) }}" class="btn btn-primary">Export Log</a>
        </div>
    </div>

    <div class="card">
        <div class="card-header">Logs (ไฟล์: <strong>{{ $logType }}.log</strong>)</div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($pagedLogs as $log)
                    <li class="list-group-item small 
                        @if(Str::contains($log, '.CRITICAL:')) list-group-item-danger @endif
                        @if(Str::contains($log, '.ERROR:')) list-group-item-warning @endif
                        " style="padding: 0.25rem 1.25rem;">{{ $log }}
                    </li>
                @endforeach
            </ul>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $pagedLogs->appends(['type' => $logType])->links() }}
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning">
        <strong>⚠ ไม่มีไฟล์ Log!</strong> ยังไม่มีข้อมูล หรือถูกลบไปแล้ว
    </div>
@endif

@endsection
