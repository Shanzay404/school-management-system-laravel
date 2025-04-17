@extends('Admin.Layout.layout')

@section('content')

<style>
     
        .challan-container {
            max-width: 800px;
            margin: 30px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            /* box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2); */
            border: 2px solid #333;
        }
        .challan-header {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .challan-info {
            font-size: 16px;
            margin-bottom: 10px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle;
        }
        .remarks {
            width: 100%;
            border: 1px solid #ddd;
            padding: 5px;
            border-radius: 5px;
            font-size: 14px;
        }
        .footer-text {
            text-align: center;
            font-size: 14px;
            margin-top: 20px;
            font-style: italic;
            border-top: 1px dashed #555;
            padding-top: 10px;
        }
    </style>

 <!-- Table head options start -->
 <section class="section" style="min-height: 82vh; max-height:auto;">
    <div class="row" id="table-head">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="card-title">Student Report Card</h4> 
                    <a href="{{ route('admin.students.data') }}" class="btn btn-primary">Back</a>        
                </div>
            
                <div class="card-content px-5 pb-5">
                        <div class="row challan-info">
                            <div class="col-12 mt-3"><strong>Student Name:</strong> {{ $student->user->username }} {{ $student->father_name }}</div>
                            <div class="col-12 mt-3"><strong>Class:</strong> {{ $student->school_class->name }}</div>
                        </div>
                   
                  <form action="{{ route('admin.student.send-report', $student->id) }}" method="POST">
                    @csrf
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead >
                                <tr>
                                    <th>Subjects</th>
                                    <th>Present</th>
                                    <th>Leaves</th>
                                    <th>Absent</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subject_ids as $subject)
                                @php
                                    $sub = \App\Models\Subject::find($subject->subject_id);
                                    $sub_attendance_present = \App\Models\StudentAttendance::where(['student_id' => $student->id, 'subject_id' => $sub->id, 'status' => 'present'])->count();
                                    $sub_attendance_leave = \App\Models\StudentAttendance::where(['student_id' => $student->id, 'subject_id' => $sub->id, 'status' => 'leave'])->count();
                                    $sub_attendance_absent = \App\Models\StudentAttendance::where(['student_id' => $student->id, 'subject_id' => $sub->id, 'status' => 'absent'])->count();
                                @endphp
                                <tr>
                                    <td>{{ $sub->name }}</td>
                                    <td>{{ $sub_attendance_present }}</td>
                                    <td>{{ $sub_attendance_leave }}</td>
                                    <td>{{ $sub_attendance_absent }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        @php
                             $total_attendance = \App\Models\StudentAttendance::where(['student_id' => $student->id, 'status' => 'present'])->count();
                             $attendance_percentage = ($total_attendance/365) * 100;
                        @endphp
                        <div class="challan-info mt-4">
                            <div class="col-6"><strong>Total Attendance:</strong> {{ $total_attendance }} days</div>
                            <div class="col-6 mt-2"><strong>Overall Percentage:</strong> <span class="badge bg-success fs-6">{{ round($attendance_percentage,1) }}%</span></div>
                
                        </div>
                
                        <div class="mt-3">
                            {{-- <div class="col-6"><strong>Eligibility:</strong> {{ round($attendance_percentage,1) > 70 ? "You're Eligible for Exams" : "You aren't Eligible for Exams" }}</div> --}}
                            <div class="col-6"><strong>Remarks:</strong> {{ round($attendance_percentage,1) > 70 ? "V.Good" : "Need Improvement" }}</div>
                            {{-- <div class="col-6"><strong>Remarks:</strong></div> --}}
                        </div>
                        <div class="d-flex justify-content-end">
                            <input type="submit" value="Send Report" class="btn btn-success mt-4 text-right">
                        </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Table head options end -->
@endsection