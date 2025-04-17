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
                        <form class="form">
                            <div class="row">
                                <div class="col-md-12 col-12 mb-3 px-3">
                                    <div class="form-group">                                        
                                        <img 
                                        src="{{ $student->user->image ? asset('/Admin/user_images/' . $student->user->image) : asset('/Admin/user_images/1738840373.jpg') }}" 
                                        alt="" height="200px" width="200px"
                                        style="border-radius: 50%">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" class="mb-2" >Student Name</label>
                                        <input type="text" style="cursor:not-allowed" id="username"  class="form-control"
                                            placeholder="Username" name="username" value="{{ $student->user->username }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" class="mb-2" >Father Name</label>
                                        <input type="text" style="cursor:not-allowed" id="username"  class="form-control"
                                            placeholder="Username" name="username" value="{{ $student->father_name }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" class="mb-2" >Mother Name</label>
                                        <input type="text" style="cursor:not-allowed" id="username"  class="form-control"
                                            placeholder="Username" name="username" value="{{ $student->mother_name }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email" class="mb-2" >Email</label>
                                        <input type="email" style="cursor:not-allowed" id="email"  class="form-control"
                                            placeholder="Email" name="email" value="{{ $student->user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" class="mb-2" >Date of Birth</label>
                                        <input type="text" style="cursor:not-allowed" id="username"  class="form-control"
                                            placeholder="Username" name="username" value="{{ $student->dob }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" class="mb-2" >Admission Number</label>
                                        <input type="text" style="cursor:not-allowed" id="username"  class="form-control"
                                            placeholder="Username" name="username" value="{{ $student->admission_number }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" class="mb-2" >Admission Date</label>
                                        <input type="text" style="cursor:not-allowed" id="username"  class="form-control"
                                            placeholder="Username" name="username" value="{{ $student->date }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" class="mb-2" >Class</label>
                                        <input type="text" style="cursor:not-allowed" id="username"  class="form-control"
                                            placeholder="Username" name="username" value="{{ $student->school_class->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="section" class="mb-2" >Section</label>
                                        <input type="text" style="cursor:not-allowed" id="username"  class="form-control"
                                            placeholder="section" name="section" value="{{ $student->section->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address " class="mb-2" >Address</label>
                                        <input type="text" style="cursor:not-allowed" id="address" class="form-control"
                                            name="address" placeholder="address" value="{{ $student->user->address }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="contact " class="mb-2" >Contact No</label>
                                        <input type="number" style="cursor:not-allowed" id="contact" class="form-control"
                                            name="contact" placeholder="Contact" value="{{ $student->user->contact }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status " class="mb-2" >Status</label>
                                        <input type="text" style="cursor: not-allowed" class="form-control"  value="{{ $student->user->status === 1 ? "Active" : "In-Active" }}">
                                    </div>
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
            const file = event.target.files[0];
            if (file) {
                document.getElementById('imagePreview').src = URL.createObjectURL(file);
            }
        }
    </script>
@endsection