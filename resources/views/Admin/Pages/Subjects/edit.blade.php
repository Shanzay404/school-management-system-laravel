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
                        <li class="breadcrumb-item active" aria-current="page">Submit Leave</li>
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
                            <form class="form" action="{{ route('subject.update', $subject->id) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="name" class="required">Subject Name</label>
                                            <input type="name" name="name" placeholder="Subject Name" id="name"  class="form-control" value="{{ $subject->name }}">
                                            <small class="text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="code" class="required">Subject Code</label>
                                            <input type="text" id="code" name="code" class="form-control">
                                            <small class="text-danger">
                                                @error('code')
                                                    {{ $message }}
                                                @enderror
                                            </small>
                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="school_class" class="required">Class</label>
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
                                    </div> --}}
                                    <div class="col-md-6 col-12">
                                        <div class="form-group">
                                            <label for="teacher" class="required">Teacher</label>
                                            <select class="choices form-select" name="teacher" id="teacher">
                                                @foreach ($teachers as $teacher)
                                                @if ($subject->teacher_id === $teacher->id)
                                                   {{ $selected = 'selected'}}
                                                @else
                                                   {{ $selected = ''}}
                                                @endif
                                                <option value="{{ $teacher->id }}" {{ $selected }}>{{ $teacher->username }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-danger">
                                                @error('teacher')
                                                    {{ $message }}
                                                @enderror
                                            </small>
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