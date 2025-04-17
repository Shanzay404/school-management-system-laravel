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
                        <li class="breadcrumb-item active" aria-current="page">Add Permissions</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="center d-flex justify-content-center flex-column" style="min-height: 75vh">
        <div class="row match-height" style="min-height:100%;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4 class="card-title">Role: {{ $role->name }}</h4>
                        <a href="{{ url('roles') }}" class="btn btn-primary">Back</a>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <div class="form-group">
                                            <label for="name" class="fs-5 mb-5 fw-bold ">Permissions</label>
                                           <div class="row">
                                            @foreach ($permissions as $permission)
                                                <div class="col-lg-2 col-md-2 col-12">
                                                    <label>
                                                        <input type="checkbox" 
                                                        name="permission[]" 
                                                        id="permissions" 
                                                        value="{{ $permission->name }}" 
                                                        {{ in_array($permission->id,$rolePermission) ? 'checked':'' }}
                                                        />
                                                        {{ $permission->name }}
                                                    </label>
                                                    <small class="text-danger mt-1">
                                                        @error('permission')
                                                            {{ $message }}
                                                        @enderror
                                                    </small>
                                                </div>
                                            @endforeach
                                           </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                            class="btn btn-primary me-1 mb-1">Update</button>
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