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
                        <form class="form" action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 col-12 mb-3 px-3">
                                    <div class="form-group">                                        
                                        <img 
                                        src="{{ $user->image ? asset('/Admin/user_images/' . $user->image) : asset('/Admin/user_images/1738840373.jpg') }}" 
                                        alt="" height="200px" width="200px"
                                        style="border-radius: 50%">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="username" >Username</label>
                                        <input type="text" style="cursor:not-allowed" id="username"  class="form-control"
                                            placeholder="Username" name="username" value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="email" >Email</label>
                                        <input type="email" style="cursor:not-allowed" id="email"  class="form-control"
                                            placeholder="Email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="address " >Address</label>
                                        <input type="text" style="cursor:not-allowed" id="address" class="form-control"
                                            name="address" placeholder="address" value="{{ $user->address }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="contact " >Contact No:</label>
                                        <input type="number" style="cursor:not-allowed" id="contact" class="form-control"
                                            name="contact" placeholder="Contact" value="{{ $user->contact }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="status " >Status</label>
                                        <input type="text" style="cursor: not-allowed" class="form-control"  value="{{ $user->status }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="role" class="d-block" >Role</label>
                                        {{-- <label for="" class="badge bg-primary"></label> --}}
                                        @if(!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $roleName) 
                                        <h5><span class="badge bg-primary text-white mx-1">{{ $roleName }}</span></h5>
                                        @endforeach
                                        @else
                                        <h5><span class="badge bg-primary text-white">{{ $user->role }}</span></h5>
                                        @endif
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
                // Create a temporary URL for the selected file and update the image preview
                document.getElementById('imagePreview').src = URL.createObjectURL(file);
            }
        }
    </script>
@endsection