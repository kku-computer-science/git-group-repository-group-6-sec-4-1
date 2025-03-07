@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'User Activity Details')

@section('content')
    <h3 style="padding-top: 10px;">รายละเอียดการกระทำของผู้ใช้: {{ $user->email }}</h3>
    <br>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">กลับไปที่ Dashboard</a>

    @if(!empty($activities))
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Timestamp</th>
                        <th>Action</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($activities as $activity)
                        <tr>
                            <td>{{ is_array($activity['timestamp']) ? json_encode($activity['timestamp']) : $activity['timestamp'] }}</td>
                            <td>{{ is_array($activity['action']) ? json_encode($activity['action']) : $activity['action'] }}</td>
                            <td>
                                @if(is_array($activity['details']) && !empty($activity['details']))
                                    <ul>
                                        @foreach($activity['details'] as $key => $value)
                                            <li>{{ $key }}: {{ is_array($value) ? json_encode($value) : $value }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-muted">ไม่มีข้อมูลการกระทำสำหรับผู้ใช้นี้</p>
    @endif

@endsection

@push('styles')
<style>
    .table-responsive { overflow-x: auto; max-width: 100%; }
    .table-hover tbody tr:hover { background-color: #f8f9fa; transition: background-color 0.3s ease; }
    ul { margin-bottom: 0; padding-left: 15px; list-style-type: disc; }
</style>
@endpush