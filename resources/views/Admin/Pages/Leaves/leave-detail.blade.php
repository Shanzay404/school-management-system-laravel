@extends('Admin.Layout.layout')

@section('content')


<section id="multiple-column-form container" style="min-height: 82vh; max-height:auto;">
    <div class="page-title">
        <div class="row mb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $page_heading }}</h3>
                {{-- <p class="text-subtitle text-muted">For user to check they list</p> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Leave Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <h3 class="mb-3">Leave Type : <span>{{ $leave->leave_type }}</span></h3>
                        <p class="fw-bold">Start Type : <span>{{ $leave->start_date }}</span></p>
                        <p class="fw-bold">End Type : {{ $leave->end_date }}</p>
                        <p class="fw-bold">Username : {{ $leave->user->username }}</p>
                        <p class="fw-bold">Email : {{ $leave->user->email }}</p>
                        <p class="fw-bold">Status : {{ $leave->status }}</p>
                        <p class="fw-bold">Reason: <span>{!! $leave->reason !!}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection