<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Learning</title>
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
            margin-bottom: 20px;
        }
        .challan-container .challan-info div.mt-2 {
            margin-top: 11px !important;
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
    <div class="challan-header">E-Learning  - Student Fee Challan</div>

    <div class="challan-info">
        <div class="mt-2">
            <strong>Student Id:</strong> {{  $payment->student->id }}
        </div>
        <div class="mt-2">
            <strong>Student Name:</strong> {{  $payment->student->user->username }} 
        </div>
        <div class="mt-2">
            <strong>Father Name:</strong> {{ $payment->student->father_name }}
        </div>
        <div class="mt-2">
            <strong class="mt-4">Class:</strong> {{  $payment->student->school_class->name }}
        </div>
        <div class="mt-2">
            <strong class="mt-4">Section:</strong> {{  $payment->student->section->name }}
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Fees Type</th>
                <th>Total Fee</th>
                <th>Amount Paid</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Monthly Fee</td>
                <td>{{ number_format($class_fee->monthly_fee,2) }}</td>
                <td>{{ number_format($payment->amount_paid, 2) }}</td>
                <td>{{ $payment->payment_status }}</td>
            </tr>
        </tbody>
    </table>

    <div class="challan-info" style="margin-top:15px;">
        <div style="margin-bottom: 15px;">
            <strong>due amount:</strong> <span>{{number_format($payment->due_amount,2)}}</span>
        </div> 
        <strong>payment Date:</strong> {{ date('d-M-Y', strtotime($payment->payment_date ))}} <br>
    </div>

    <div class="challan-info">
        <div class="col-6">
            <strong>Note:</strong> Please pay your fee before the due date to avoid late fees.
         </div>
    </div>

    <div class="footer-text">
        This is a system-generated challan. No signature required.
    </div>
</div>

</body>
</html>
