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
                        <li class="breadcrumb-item"><a href="{{ route('redirect') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
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
                        <form class="form" action="{{ route('profile.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" class="required">Name</label>
                                        <input type="text" id="username"  class="form-control"
                                            placeholder="Name" name="username" value="{{ $user->username }}">
                                            <small class="text-danger">@error('username')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="father_name" class="required">Father Name</label>
                                        <input type="text" id="father_name"  class="form-control"
                                            placeholder="Father Name" name="father_name" value="{{ ($user->student->father_name) ? $user->student->father_name :  " "  }}">
                                            <small class="text-danger">@error('father_name')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="mother_name" class="required">Mother Name</label>
                                        <input type="text" id="mother_name"  class="form-control"
                                            placeholder="Mother Name" name="mother_name" value="{{ $user->student->mother_name }}">
                                            <small class="text-danger">@error('mother_name')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email" class="required">Email</label>
                                        <input type="email" id="email"  class="form-control"
                                            placeholder="Email" name="email" value="{{ $user->email }}">
                                            <small class="text-danger">@error('email')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="contact " class="required">Contact No:</label>
                                        <input type="number" id="contact" class="form-control"
                                            name="contact" placeholder="Contact" value="{{ $user->contact }}">
                                            <small class="text-danger">@error('contact')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address " class="required">Address</label>
                                        <input type="text" id="address" class="form-control"
                                            name="address" placeholder="address" value="{{ $user->address }}">
                                            <small class="text-danger">@error('address')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                {{-- <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address " class="required">DOB</label>
                                        <input type="text" id="dob" class="form-control"
                                            name="dob" placeholder="Date of birth" value="{{ $user->student->dob }}">
                                            <small class="text-danger">@error('dob')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div> --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group col-">
                                        <div class='form-group'>
                                            <label for="image" class="required">Image</label>
                                            <input type="file" name="image" id="InputImage" accept="image/*" class="form-control"  onchange="previewNewImage(event)">
                                            <small class="text-danger">@error('image')
                                                {{ $message }}
                                            @enderror</small>
                                        </div>
                                    </div>
                                    {{-- <img src="" alt="" height="100px" id="previewImage"> --}}
                                    <img src="{{ $user->image ? asset('/Admin/user_images/' . $user->image) : asset('/Admin/user_images/1738840373.jpg') }}" alt="" height="100px" id="previewImage">
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
</section>
<script>
    function previewNewImage(event) {
        const file = event.target.files[0]; // Get the selected file
        if (file) {
            const preview = document.getElementById('previewImage');
            preview.src = URL.createObjectURL(file); // Update the image preview
            preview.style.display = "block"; // Ensure the image is visible
        }
    }
    </script>
@endsection