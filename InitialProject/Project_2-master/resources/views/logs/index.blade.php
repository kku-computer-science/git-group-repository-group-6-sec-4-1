@extends('dashboards.users.layouts.user-dash-layout')

@section('title', 'System Logs')

@section('content')

<h3>System Logs</h3>

<div class="card">
    <div class="card-header">Logs</div>
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
            {{ $pagedLogs->links() }}
        </div>
    </div>
</div>

@endsection