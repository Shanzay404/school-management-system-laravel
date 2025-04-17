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
                        <li class="breadcrumb-item active" aria-current="page">Assign Subjects</li>
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
                            <form class="form" action="{{ route('class_subject.assign.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="school_class" class="required">School Class</label>
                                            <select class="choices form-select" name="school_class" id="school_class">
                                                <option value="" disabled selected>Select Class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">
                                                @error('school_class')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    {{-- <option value="{{ $subject->id }}">{{ $subject->name }}</option> --}}
                                    {{-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="subject" class="required">Subjects</label>
                                            <select class="choices form-select" name="subject_ids[]" id="subject" multiple required>
                                                <option value="" disabled selected>Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}" 
                                                        {{ collect(old('subject_ids'))->contains($subject->id) ? 'selected' : '' }}>
                                                        {{ $subject->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">
                                                @error('subject_ids')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div> --}}


                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="subject" class="required">Subjects</label>
                                            <select class="choices form-select multiple-remove form-select" name="subject_ids[]" id="subject" multiple="multiple">
                                                <option value="" disabled>Select Subject</option>
                                                @foreach ($subjects as $subject)
                                                    <option value="{{ $subject->id }}" 
                                                        {{ collect(old('subject_ids'))->contains($subject->id) ? 'selected' : '' }}>
                                                        {{ $subject->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">
                                                @error('subject_ids') {{ $message }} @enderror
                                                @foreach ($errors->get('subject_ids.*') as $error) 
                                                    {{ $error[0] }}
                                                @endforeach
                                            </small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12 d-flex justify-content-end">
                                        <button type="submit"
                                        class="btn btn-primary me-1 mb-1">Assign</button>
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