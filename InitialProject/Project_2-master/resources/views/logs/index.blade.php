
@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'User Activity Logs')

@section('content')
<div class="container py-4">
    <form action="{{ route('logs.show') }}" method="GET" class="mb-4 d-flex">
        <input type="text" name="search" class="form-control me-2 border-primary" placeholder="Search logs..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <h2 class="mb-3 text-danger">HTTP Error Logs</h2>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr><th>Timestamp</th><th>IP</th><th>Status</th><th>URL</th></tr>
                </thead>
                <tbody>
                    @forelse($httpErrorLogs as $log)
                    <tr>
                        <td>{{ $log->timestamp }}</td>
                        <td>{{ $log->ip }}</td>
                        <td class="text-danger fw-bold">{{ $log->status }}</td>
                        <td>{{ $log->url }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="text-center text-muted">No logs found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <h2 class="mb-3 text-warning">System Error Logs</h2>
    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr><th>Timestamp</th><th>Message</th></tr>
                </thead>
                <tbody>
                    @forelse($systemErrorLogs as $log)
                    <tr>
                        <td>{{ $log->timestamp }}</td>
                        <td>{{ $log->message }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="2" class="text-center text-muted">No logs found.</td></tr>
                    @endforelse
                </tbody>
            </table>
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
    .text-break {
        word-break: break-all;
    }
    .card {
        border-radius: 8px;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transition: background-color 0.3s ease;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Add enter key support for the search form
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.addEventListener('keypress', function (e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    this.form.submit();
                }
            });
        }
    });
</script>
@endpush