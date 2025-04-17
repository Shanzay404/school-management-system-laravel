@extends('Admin.Layout.layout')
@section('content')


<section id="multiple-column-form container" style="min-height: 82vh; max-height:auto;">
    <div class="page-title">
        <div class="row mb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $page_heading }}</h3>
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
                                        src="{{ $user->image ? asset('/Admin/user_images/' . $user->image) : asset('/Admin/user_images/1738840373.jpg') }}" 
                                        alt="" height="200px" width="200px"
                                        style="border-radius: 50%">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="username" class="mb-2" >Name</label>
                                        <input type="text" style="cursor:not-allowed" id="username"  class="form-control"
                                            placeholder="Username" name="username" value="{{ $user->username }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="email" class="mb-2" >Email</label>
                                        <input type="email" style="cursor:not-allowed" id="email"  class="form-control"
                                            placeholder="Email" name="email" value="{{ $user->email }}">
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="address " class="mb-2" >Address</label>
                                        <input type="text" style="cursor:not-allowed" id="address" class="form-control"
                                            name="address" placeholder="address" value="{{ $user->address }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="contact " class="mb-2" >Contact No</label>
                                        <input type="number" style="cursor:not-allowed" id="contact" class="form-control"
                                            name="contact" placeholder="Contact" value="{{ $user->contact }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="status " class="mb-2" >Status</label>
                                        <input type="text" style="cursor: not-allowed" class="form-control"  value="{{ $user->status === 1 ? "Active" : "In-Active" }}">
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="status " class="mb-2" >Role</label>
                                        <input type="text" style="cursor: not-allowed" class="form-control"  value="@foreach ($user->getRoleNames() as $role){{ $role }}@endforeach"></div>
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