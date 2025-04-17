@extends('Admin.Layout.layout')

@section('content')
{{-- <div class="container"> --}}

{{-- </div> --}}

<section class="section container" style="min-height: 82vh">
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
                        <li class="breadcrumb-item active" aria-current="page">View Students</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('admin.student.add') }}" class="btn btn-primary">Add</a>
            
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Student Name</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Status</th>
                        <th>Generate Report</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($students as $student)
                    <tr>
                        <td>
                            <img src="{{ $student->user->image ? asset('/Admin/user_images/' . $student->user->image) : asset('/Admin/user_images/1738840373.jpg') }}" alt="" height="40px" style="border-radius: 50% !important; width:50px !important;">
                        </td>
                        <td>{{ $student->user->username }} {{ $student->father_name }}</td>
                        <td>{{ $student->school_class->name}}</td>
                        <td>{{  $student->section->name  }}</td>
                        <td>
                            <form id="changeStatus{{$student->user_id}}" action="{{ route('student.status.update', $student->user_id) }}" method="post">
                                @method("PUT")
                                @csrf
                                <button type="button" style="border: none;  background:none;" onclick="confirmChangeStatus({{$student->user_id}}, '{{ $student->user->status === 0 ? 1 : 0 }}')">
                                    <span class="badge bg-{{ $student->user->status === 0 ? 'danger' : 'success' }}"> {{ $student->user->status === 0 ? "In-Active " : "Active" }}</span>
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('admin.student.generateReport', $student->id) }}" class=" btn btn-primary d-inline mx-1 ">Generate Report</a>
                        </td>
                        <td>
                            <a href="{{ route('admin.student.view', $student->id) }}" class="bg-none d-inline mx-1 text-primary fs-5"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <a href="{{ route('admin.student.edit', $student->id) }}" class="d-inline mx-1 text-warning fs-5"><i class="bi bi-pencil-square" aria-hidden="true"></i></a>
                            <form  id="deleteForm{{ $student->user_id }}" action="{{ route('admin.student.destroy', $student->user_id) }}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="" style="border: none !important; background:none;" onclick="confirmDelete({{ $student->user_id }})">
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
            text: "You want to delete this user? This action cannot be done",
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
    
    function confirmChangeStatus($studentId, $studentStatus){
        Swal.fire({
            title: "Are you sure?",
            text: "You want to change the status to " + ($studentStatus == 0 ? 'In-Active':'Active'),
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('changeStatus' + $studentId).submit();
            } else {
                Swal.close();
            }
        });
        console.log('hey');
        
    }
</script>
@endsection