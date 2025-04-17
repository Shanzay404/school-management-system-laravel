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
                        <li class="breadcrumb-item active" aria-current="page">View Fee Structure</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ route('admin.fee.add') }}" class="btn btn-primary">Add</a>
            
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Class</th>
                        <th>Admission Fee</th>
                        <th>Monthly Fee</th>
                        <th>Exam Fee</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classFees as $classFee)
                    <tr>
                        <td>{{ $classFee->class }}</td>
                        <td>{{ $classFee->admission_fee }}</td>
                        <td>{{ $classFee->monthly_fee }}</td>
                        <td>{{ $classFee->exam_fee }}</td>
                        <td>
                            {{-- <a href="{{ route('admin.user.view',$user->id) }}" class="bg-none d-inline mx-1 text-primary fs-5"><i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                            <a href="{{ route('admin.fee.edit',$classFee->id) }}" class="d-inline mx-1 text-warning fs-5"><i class="bi bi-pencil-square" aria-hidden="true"></i></a>
                            <form  id="deleteForm{{ $classFee->id }}" action="{{ route('admin.fee.destroy', $classFee->id) }}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="" style="border: none !important; background:none;" onclick="confirmDelete({{ $classFee->id }})">
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
            text: "You want to delete this fee structure? This action cannot be done",
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
    
    // function confirmChangeStatus($userId, $userStatus){
    //     Swal.fire({
    //         title: "Are you sure?",
    //         text: "You want to change the status to " + ($userStatus == 0 ? 'In-Active':'Active'),
    //         icon: "warning",
    //         showCancelButton: true,
    //         confirmButtonColor: "#3085d6",
    //         cancelButtonColor: "#d33",
    //         confirmButtonText: "Yes"
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             document.getElementById('changeStatus' + $userId).submit();
    //         } else {
    //             Swal.close();
    //         }
    //     });
    //     console.log('hey');
        
    // }
</script>
@endsection