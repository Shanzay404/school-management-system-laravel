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
                        <form class="form" action="{{ route('admin.student.update', $student->user_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" class=" required">Name</label>
                                        <input type="text" id="username"  class="form-control"
                                            placeholder="Name" name="username" value="{{ $student->user->username }}">
                                            <small class="text-danger">@error('username')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="father_name" class="required">Father Name</label>
                                        <input type="text" id="father_name"  class="form-control"
                                            placeholder="Father Name" name="father_name" value="{{ $student->father_name }}">
                                            <small class="text-danger">@error('father_name')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="mother_name" class="required">Mother Name</label>
                                        <input type="text" id="mother_name"  class="form-control"
                                            placeholder="Mother Name" name="mother_name" value="{{ $student->mother_name }}">
                                            <small class="text-danger">@error('mother_name')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email" class=" required">Email</label>
                                        <input type="email" id="email"  class="form-control"
                                            placeholder="Email" name="email" value="{{ $student->user->email }}">
                                            <small class="text-danger">@error('email')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="contact " class=" required">Contact No:</label>
                                        <input type="number" id="contact" class="form-control"
                                            name="contact" placeholder="Contact" value="{{ $student->user->contact }}">
                                            <small class="text-danger">@error('contact')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address " class=" required">Address</label>
                                        <input type="text" id="address" class="form-control"
                                            name="address" placeholder="address" value="{{ $student->user->address }}">
                                            <small class="text-danger">@error('address')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address " class=" required">DOB</label>
                                        <input type="text" id="dob" class="form-control"
                                            name="dob" placeholder="Date of birth" value="{{ $student->dob }}">
                                            <small class="text-danger">@error('dob')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                              
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="class_section" class="required">Class & Section</label>
                                        <select class="choices form-select" name="class_section" id="classSectionDropdown">
                                            <option value="" disabled selected>Select Class & Section</option>
                                            @foreach ($classes as $class)
                                                <optgroup label="{{ $class->name }}">
                                                    @foreach ($class->section as $section)

                                                    @php
                                                        $selected = ($class->id == $student->school_class_id && $section->id == $student->section_id) ? 'selected' : '';
                                                    @endphp

                                                        <option value="{{ json_encode(['school_class_id' => $class->id, 'section_id' => $section->id]) }}" {{ $selected }}>
                                                            {{ $class->name }} - {{ $section->name }}
                                                        </option>
                                                    @endforeach
                                                </optgroup>
                                            @endforeach
                                        </select>
                                        <small class="text-danger">
                                            @error('class_section')
                                                {{ $message }}
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                              
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
                                    <img src="{{ $student->user->image ? asset('/Admin/user_images/' . $student->user->image) : asset('/Admin/user_images/1738840373.jpg') }}" alt="" height="100px" id="previewImage">
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