@extends('Admin.Layout.layout')

@section('content')


<section id="multiple-column-form container" style="min-height: 82vh; max-height:auto;">
    <div class="page-title">
        <div class="row mb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $page_heading }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Submit Fee</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="center d-flex justify-content-center flex-column" style="min-height: 75vh">
        <div class="row match-height" style="min-height:100%;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('feePayment.collect') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="student_id" class="required">Student ID</label>
                                            <input type="text" name="student_id" placeholder="Student ID" id="student_id" name="student_id" class="form-control">
                                            <small class="text-danger">
                                                @error('student_id')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="amount_paid" class="required">Amount Paid</label>
                                            <input type="text" name="amount_paid" id="amount_paid" placeholder="Amount Paid" name="amount_paid" class="form-control">
                                            <small class="text-danger">
                                                @error('amount_paid')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="payment_method" class="required">Payment Method</label>
                                            <select class="choices form-select" name="payment_method" id="payment_method">
                                                <option value="" disabled selected>Select Payment Method</option>
                                                    <option value="cash">Cash</option>
                                                    <option value="bank">Bank</option>
                                                    <option value="other">Other</option>
                                            </select>
                                            <small class="text-danger">
                                                @error('payment_method')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                        class="btn btn-primary me-1 mb-1">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection