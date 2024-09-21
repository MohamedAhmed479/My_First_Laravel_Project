<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.payments.view_payments', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function searchOrderPayment(Request $request) {
        $request->validate([
            'payment_search' => 'required|numeric|exists:orders,id|exists:payments,order_id',
        ]);

        $order_id = $request->input('payment_search');
        $payment = Payment::where('order_id', $order_id)->first();

        return to_route('admin.viewSpecificPayment', ['payment' => $payment]);

    }

    public function viewSpecificPayment(Payment $payment) {
        return view('admin.payments.view_specific_payment', get_defined_vars());
    }

    public function viewCustomersPayments(User $customer) {
        $payments = $customer->payments;

        return view('admin.payments.view_customer_payments', get_defined_vars());

    }
}
