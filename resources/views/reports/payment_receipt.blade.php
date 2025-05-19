<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Payment Receipt</title>
    <style>
        body { font-family: sans-serif; }
        h1 { text-align: center; }
        table { width: 100%; margin-top: 20px; }
        td, th { padding: 6px 0; }
        .footer { margin-top: 30px; font-size: 12px; }
        .bold { font-weight: bold; }
    </style>
</head>
<body>
    <h1>Payment Receipt</h1>
    <hr>
    <p><span class="bold">Receipt No:</span> {{ $payment->id }}</p>
    <p><span class="bold">Date:</span> {{ $payment->paid_date }}</p>
    <p><span class="bold">Enrollment No:</span> {{ $payment->enrollment->enroll_no }}</p>
    <p><span class="bold">Student Name:</span> {{ $payment->enrollment->student->name }}</p>
    <hr>
    <table>
        <tr>
            <th align="left">Description</th>
            <th align="right">Amount</th>
        </tr>
        <tr>
            <td>{{ $payment->enrollment->batch->name }}</td>
            <td align="right">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
        </tr>
    </table>
    <hr>
    <div class="footer">
        Printed By: <strong>{{ Auth::user()->name }}</strong><br>
        Printed Date: <strong>{{ now()->format('Y-m-d') }}</strong>
    </div>
</body>
</html>
