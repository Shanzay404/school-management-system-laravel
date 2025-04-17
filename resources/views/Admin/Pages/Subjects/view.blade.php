@extends('Admin.Layout.layout')

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
                        <li class="breadcrumb-item active" aria-current="page">View Subjects</li>
                    </ol>
                </nav> 
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('subject.add') }}" class="btn btn-primary">Add</a>
            
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Subject</th>
                        {{-- <th>Role</th> --}}
                        <th>Code</th>
                        <th>Teacher</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                    <tr>
                        <td>{{ $subject->name }}</td>
                        <td>{{ $subject->code}}</td>
                        <td>{{ $subject->teacher->username}}</td>
                        {{-- <td> 
                            <form action="{{ route('leave.update.status', $leave->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select" onchange="this.form.submit()">
                                    <option value="pending" {{ $leave->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ $leave->status == 'approved' ? 'selected' : '' }}>Approved</option>
                                    <option value="rejected" {{ $leave->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                </select>
                            </form>
                        </td> --}}
                        <td>
                            <a href="{{ route('subject.edit', $subject->id) }}" class="fw-bold bg-none d-inline mx-1 text-primary fs-5"><i class="bi bi-pencil-square" aria-hidden="true"></i></a>
                            {{-- <a href="{{ route('leave.detail', $leave->id) }}" class="bg-none d-inline mx-1 text-primary fs-5"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                            <form  id="deleteForm{{ $subject->id }}" action="{{ route('subject.destroy', $subject->id) }}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="" style="border: none !important; background:none;" onclick="confirmDelete({{ $subject->id}})">
                                     <i class="fa fa-trash text-danger fs-5 " aria-hidden="true"></i></button>
                            </form>
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
            text: "You want to delete this subject? This action cannot be done",
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