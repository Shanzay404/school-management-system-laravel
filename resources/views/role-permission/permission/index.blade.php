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
                        <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-end">
            <a href="{{ url('permissions/create') }}" class="btn btn-primary">Add Permission</a>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="table1">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $permission->id }}</td>
                        <td>{{ $permission->name }}</td>
                        <td>
                            <a href="{{ url('permissions/'.$permission->id.'/edit') }}" class="d-inline mx-1 text-warning fs-5"><i class="bi bi-pencil-square" aria-hidden="true"></i></a>
                            <form  id="deleteForm{{ $permission->id }}" action="{{ url('permissions/'.$permission->id) }}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="button" class="" style="border: none !important; background:none;" onclick="confirmDelete({{ $permission->id }})">
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
            text: "You want to delete this class? This action cannot be done",
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