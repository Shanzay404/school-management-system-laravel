<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Report Card</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .challan-container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
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
        /* ✅ FIX for Table Borders in PDF */
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            border: 1px solid black !important;
            padding: 8px;
            text-align: center;
        }
        .table thead {
            background-color: #333;
            color: white;
            font-weight: bold;
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
</head>
<body>

<div class="challan-container">
    <div class="challan-header">Student Report Card</div>

    <div class="challan-info">
        <strong>Student Name:</strong> {{ $student->user->username }} {{ $student->father_name }} <br>
        <strong>Class:</strong> {{ $student->school_class->name }}
    </div>

    <table class="table">
        <thead>
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
                    $total_attendance = \App\Models\StudentAttendance::where(['student_id' => $student->id, 'status' => 'present'])->count();
                    $attendance_percentage = ($total_attendance / 365) * 100;
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

    <div class="challan-info" style="margin-top:15px;">
        <strong>Total Attendance:</strong> {{ $total_attendance }} days <br>
        <div style="margin-top: 15px;">
            <strong>Overall Percentage:</strong> <span>{{ round($attendance_percentage, 1) }}%</span>
        </div> 
    </div>

    <div class="challan-info">
        <div class="col-6"><strong>Remarks:</strong> {{ round($attendance_percentage,1) > 70 ? "V.Good" : "Need Improvement" }}</div>
    </div>

    <div class="footer-text">
        This is a system-generated report. No signature required.
    </div>
</div>

</body>
</html>
