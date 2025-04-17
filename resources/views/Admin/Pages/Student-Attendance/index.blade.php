@extends('Admin.Layout.layout')

@section('content')


<section id="multiple-column-form container" style="min-height: 82vh; max-height:auto;">
    {{-- <div class="page-title">
        <div class="row mb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $page_heading }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('redirect') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div> --}}
    <div class="center d-flex justify-content-center flex-column" style="min-height: 75vh">
        <div class="row match-height" style="min-height:100%;">
            @foreach ($subjects as $subject)
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2 d-flex 4 align-items-start">
                                <div class="stats-icon purple">
                                    <i class="bi-journal-bookmark d-flex justify-content-center align-items-center"></i>
                                </div>
                            </div>
                            <div class="col-md-10 d-flex 4 align-items-center justify-content-start">
                                <h6 class="font-extrabold mb-0 d-inline"><a href="{{ route('admin.student.mark-attendance',[$subject->name, $subject->id]) }}">{{ $subject->name }}</a></h6>
                            </div>
                        </div>
        
                    </div>
                    <div class="card-body px-3 py-">
                        <div class="row align-items-center">
                            {{-- <div class="col-md-4">
                                <div class="stats-icon purple">
                                    <i class="bi-journal-bookmark d-flex justify-content-center align-items-center"></i>
                                </div>
                            </div> --}}
                            <div class="col-md-8 px-4">
                                <h6 class="text-muted font-semibold">Teacher: {{ $subject->teacher->username }}</h6>
                                {{-- <h6 class="font-extrabold mb-0 d-inline"><a href="{{ route('student.myClass', $class->id) }}">{{ $subject->name }}</a></h6> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach    
        
        </div>
    </div>
</section>
@endsection




















<div class="row">
   
</div>