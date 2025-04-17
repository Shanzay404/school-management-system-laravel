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
    <div class="center d-flex justify-content-center flex-column" style="min-height: 75vh">
        <div class="row match-height" style="min-height:100%;">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form" action="{{ route('admin.fee.update', $feeStructure->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="class" class=" required">Class</label>
                                            <input type="text" name="class" class="form-control" @disabled(true) value="{{ $feeStructure->class }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email" class=" required">Admission Fee</label>
                                            <input type="text" id="admission_fee"  class="form-control"
                                                placeholder="Admission Fee" name="admission_fee" value="{{ $feeStructure->admission_fee }}">
                                                <small class="text-danger">@error('admission_fee')
                                                    {{ $message }}
                                                @enderror</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="email" class=" required">Monthly Fee</label>
                                            <input type="text" id="monthly_fee"  class="form-control"
                                                placeholder="Monthly Fee" name="monthly_fee" value="{{ $feeStructure->monthly_fee }}">
                                                <small class="text-danger">@error('monthly_fee')
                                                    {{ $message }}
                                                @enderror</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="exam_fee" class=" required">Exam Fee</label>
                                            <input type="text" id="exam_fee"  class="form-control"
                                                placeholder="Exam Fee" name="exam_fee" value="{{ $feeStructure->exam_fee }}">
                                                <small class="text-danger">@error('exam_fee')
                                                    {{ $message }}
                                                @enderror</small>
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