<?php

namespace App\Http\Controllers;

use App;
use Auth;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function report($pid)
    {
        $payment = Payment::with(['enrollment.student', 'enrollment.batch'])->findOrFail($pid);

        if (!$payment->enrollment) {
            return abort(404, 'Data enrollment tidak ditemukan untuk payment ini.');
        }

        $pdf = App::make('dompdf.wrapper');
        $print = "<div style='margin:20px; padding:20px;'>";
        $print .= "<h1 align='center'>Payment Receipt</h1>";
        $print .= "<hr/>";
        $print .= "<p>Receipt No: <b>$pid</b></p>";
        $print .= "<p>Date: <b>{$payment->paid_date}</b></p>";
        $print .= "<p>Enrollment No: <b>{$payment->enrollment->enroll_no}</b></p>";
        $print .= "<p>Student Name: <b>" . 
                  ($payment->enrollment && $payment->enrollment->student 
                      ? $payment->enrollment->student->name 
                      : 'N/A') . 
                  "</b></p>";
        $print .= "<hr/>";
        $print .= "<table style='width: 100%; border-collapse: collapse;'>";

        $print .= "<tr><th style='text-align: left;'>Description</th><th style='text-align: right;'>Amount</th></tr>";
        $print .= "<tr>";
        $print .= "<td style='padding: 8px; font-weight: bold;'>{$payment->enrollment->batch->name}</td>";
        $print .= "<td style='text-align: right; padding: 8px; font-weight: bold;'>{$payment->amount}</td>";
        $print .= "</tr>";

        $print .= "</table>";
        
        $print .= "<hr/>";
        $print .= "<span>Printed By: <b>" . (Auth::check() ? Auth::user()->name : 'Guest') . "</b></span><br>";

        $print .= "<span>Printed Date: <b>" . date('Y-m-d') . "</b></span>";
        $print .= "</div>";

       
        $pdf->loadHTML($print)->setPaper('A4', 'portrait');
        return $pdf->stream("payment_receipt_{$pid}.pdf");
    }
}
