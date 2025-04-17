@extends('Admin.Layout.layout')

@section('content')


<section id="multiple-column-form container" style="min-height: 82vh; max-height:auto;">
    <div class="page-title">
        <div class="row mb-3">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>{{ $page_heading }} {{ $subjectName }}</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Student Attendance</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
<div class="center d-flex justify-content-center flex-column" style="min-height: 75vh">
    <div class="row match-height"  style="min-height:100%;">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"></h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" action="{{ route('admin.student.attendance.store', $subjectId) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="student_name" class=" required">Student Name</label>
                                        <select class="choices form-select" name="student_name" id="student_dropdown">
                                            <option value="" disabled selected>Select Student Name</option>
                                            @foreach ($students as $student)
                                                <option value="{{ $student->id }}">{{ $student->id }} - {{ $student->user->username}} {{ $student->father_name }}</option>
                                            @endforeach
                                        </select>
                                            <small class="text-danger">@error('student_name')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="status" class=" required">Status</label>
                                        <select class="choices form-select" name="status" id="student_dropdown">
                                            <option value="" disabled selected>Select Status</option>
                                            <option value="present">Present</option>
                                            <option value="absent">Absent</option>
                                            <option value="late">Late</option>
                                            <option value="leave">Leave</option>
                                        </select>
                                            <small class="text-danger">@error('status')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label for="date" class="required">Date</label>
                                        <input type="date" id="date"  class="form-control"
                                            placeholder="Date" name="date" value="{{ old('date') }}">
                                            <small class="text-danger">@error('date')
                                                {{ $message }}
                                            @enderror</small>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit"
                                    class="btn btn-primary me-1 my-2">Mark</button>
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