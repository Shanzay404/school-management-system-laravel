@extends('Frontend.Layout.layout')

@section('content')
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
                        <li class="breadcrumb-item active" aria-current="page">Leave Record</li>
                    </ol>
                </nav> 
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('leave.add') }}" class="btn btn-primary">Add</a>
            
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Username</th>
                        {{-- <th>Role</th> --}}
                        <th>Leave Type</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($leaves as $leave)
                    <tr>
                        <td>{{ $leave->user->username }}</td>
                        {{-- <td>{{ $payment->amount_paid }}</td> --}}
                        <td>{{ $leave->leave_type}}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->start_date)->format('d-M-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($leave->end_date)->format('d-M-Y') }}</td>
                        <td> {{ $leave->status }}</td>
                        <td>
                            <a href="{{ route('leave.detail', $leave->id) }}" class="bg-none d-inline mx-1 text-primary fs-5"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            {{-- <form  id="deleteForm{{ $leave->id }}" action="{{ route('leave.destroy', $leave->id) }}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="" style="border: none !important; background:none;" onclick="confirmDelete({{ $leave->id}})">
                                     <i class="fa fa-trash text-danger fs-5 " aria-hidden="true"></i></button>
                            </form> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


</section>
<script>
     function confirmDelete(Id){
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this Leave? This action cannot be done",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + Id).submit();
            } else {
                Swal.close();
            }
        });
        console.log('hey');
    }
    
</script>

@endsection