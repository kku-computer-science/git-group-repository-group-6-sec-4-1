@extends('dashboards.users.layouts.user-dash-layout')

@section('title', 'System Logs')

@section('content')

<h3>System Logs</h3>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h5>Logs - {{ $logType ?? 'All Logs' }}</h5>
    </div>
    <div>
        <a href="{{ url('/logs?type=activity') }}" class="btn btn-secondary">Activity Logs</a>
        <a href="{{ url('/logs?type=laravel') }}" class="btn btn-secondary">Laravel Logs</a>
        <a href="{{ url('/logs') }}" class="btn btn-secondary">All Logs</a>
        <a href="{{ url('/export-logs' . ($logType ? '?type=' . $logType : '')) }}" class="btn btn-primary">Export Logs</a>
    </div>
</div>

@if (!empty($pagedLogs) && count($pagedLogs) > 0)
    <div class="card">
        <div class="card-header">Logs (รวมจากทุกไฟล์ {{ $logType ? "ที่ระบุ: {$logType}.log" : '' }})</div>
        <div class="card-body">
            <ul class="list-group">
                @foreach($pagedLogs as $log)
                    <li class="list-group-item small 
                        @if(Str::contains($log['line'], '.CRITICAL:')) list-group-item-danger 
                        @elseif(Str::contains($log['line'], '.ERROR:')) list-group-item-warning 
                        @elseif(Str::contains($log['line'], '.INFO:')) list-group-item-info @endif"
                        style="padding: 0.25rem 1.25rem;">
                        <strong>{{ $log['file'] }}</strong>: 
                        @if($log['timestamp']) <span class="text-muted">[{{ $log['timestamp'] }}]</span> @endif
                        {{ $log['line'] }}
                    </li>
                @endforeach
            </ul>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $pagedLogs->links() }}
            </div>
        </div>
    </div>
@else
    <div class="alert alert-warning">
        <strong>⚠ ไม่มีไฟล์ Log!</strong> ยังไม่มีข้อมูล หรือถูกลบไปแล้ว
    </div>
@endif

@endsection