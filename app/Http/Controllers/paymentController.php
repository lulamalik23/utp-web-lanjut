<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Support\Facades\App;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with('enrollment')->get();
        return view('payments.index', compact('payments'));
    }

    public function create()
    {
        $enrollments = Enrollment::pluck('enroll_no', 'id');
        return view('payments.create', compact('enrollments'));
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Payment::create($input);
        return redirect('payments')->with('flash_message', 'Payment Added!');
    }

    public function show($id)
    {
        $item = Payment::with('enrollment')->findOrFail($id);
        return view('payments.show', compact('item'));
    }

    public function edit(string $id)
    {
        $payments = Payment::find($id);
        $enrollments = Enrollment::pluck('enroll_no', 'id');
        return view('payments.edit', compact('payments', 'enrollments'));
    }

    public function update(Request $request, string $id)
    {
        $payments = Payment::find($id);
        $input = $request->all();
        $payments->update($input);
        return redirect('payments')->with('flash_message', 'Payment Updated!');
    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();
        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }

    public function print($id)
    {
        // ✅ Perbaikan relasi eager loading
        $payment = Payment::with(['enrollment.student', 'enrollment.batch'])->findOrFail($id);

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('payments.receipt', compact('payment'));

        return response($pdf->output(), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
