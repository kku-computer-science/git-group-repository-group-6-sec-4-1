@extends('dashboards.users.layouts.user-dash-layout')
@section('title', 'Dashboard')

@section('content')

<h3 style="padding-top: 10px;">ยินดีต้อนรับเข้าสู่ระบบจัดการข้อมูลวิจัยของสาขาวิชาวิทยาการคอมพิวเตอร์</h3>
<br>
<h4>สวัสดี {{ Auth::user()->position_th }} {{ Auth::user()->fname_th }} {{ Auth::user()->lname_th }}</h4><br>


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