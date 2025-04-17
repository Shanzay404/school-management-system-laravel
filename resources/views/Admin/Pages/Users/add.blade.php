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
                        <li class="breadcrumb-item active" aria-current="page">View Users</li>
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
                        <form class="form" action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" class=" required">Username</label>
                                        <input type="text" id="username"  class="form-control"
                                            placeholder="Username" name="username" value="{{ old('username') }}">
                                            <small class="text-danger">@error('username')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email" class=" required">Email</label>
                                        <input type="email" id="email"  class="form-control"
                                            placeholder="Email" name="email" value="{{ old('email') }}">
                                            <small class="text-danger">@error('email')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="password " class=" required">Password</label>
                                        <input type="text" id="password" class="form-control"
                                            placeholder="Password" name="password" value="{{ old('password') }}">
                                            <small class="text-danger">@error('password')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address " class=" required">Address</label>
                                        <input type="text" id="address" class="form-control"
                                            name="address" placeholder="address" value="{{ old('address') }}">
                                            <small class="text-danger">@error('address')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="contact " class=" required">Contact No:</label>
                                        <input type="number" id="contact" class="form-control"
                                            name="contact" placeholder="Contact" value="{{ old('contact') }}">
                                            <small class="text-danger">@error('contact')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status " class=" required">Status</label>
                                        <select class="choices form-select" name="status">
                                            <option value="" disabled selected>Select user Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">In-Active</option>
                                        </select>
                                        <small class="text-danger">@error('status')
                                            {{ $message }}
                                        @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="role" class=" required">Role</label>
                                        <select class="choices form-select multiple-remove"
                                        multiple="multiple" name="role[]">
                                            <option value="" disabled selected>Select user Status</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">@error('role')
                                            {{ $message }}
                                        @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group col-">
                                        <div class='form-group'>
                                            <label for="image" class="required">Image</label>
                                            <input type="file" name="image" id="InputImage" accept="image/*" class="form-control" onchange="previewImage(event)">
                                            <small class="text-danger">@error('image')
                                                {{ $message }}
                                            @enderror</small>
                                        </div>
                                    </div>
                                    <img src="" alt="" height="100px" id="imagePreview">
                                </div>
                                
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit"
                                        class="btn btn-primary me-1 mb-1">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('imagePreview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]); // File ko read karega
    }
    </script>
@endsection