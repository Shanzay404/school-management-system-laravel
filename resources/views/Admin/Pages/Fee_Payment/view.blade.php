@extends('Admin.Layout.layout')

@section('content')
{{-- <div class="container"> --}}

{{-- </div> --}}

<section class="section container" style="min-height: 82vh">
    <div class="page-title">
        <div class="row mb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $page_heading }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Students</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('feePayment.form') }}" class="btn btn-primary">Add</a>
            
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>S:NO</th>
                        <th>Student ID</th>
                        <th>Amount Paid</th>
                        <th>Due Amount</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                        <th>Payment Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $sno = 0; @endphp
                    @foreach ($payments as $payment)
                    @php $sno++; @endphp
                    <tr>
                        <td>{{ $sno }}</td>
                        <td>{{ $payment->student_id }}</td>
                        <td>{{ $payment->amount_paid }}</td>
                        <td>{{ $payment->due_amount }}</td>
                        <td>{{ $payment->payment_method }}</td>
                        <td> <span class="badge bg-{{ ($payment->payment_status === 'pending') ? "warning" : "success" }}">{{ $payment->payment_status }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-M-Y') }}</td>
                        <td>
                            <a href="{{ route('feePayment.challan',$payment->id) }}" class="btn btn-primary btn-sm">
                                Save Challan
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</section>

@endsection