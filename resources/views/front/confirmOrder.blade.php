@extends('front.master')

@section('content')
    <section id="cart-add" class="section-p1" style="text-align: center;">
        <div id="subTotal" style="display: inline-block; text-align: left; width: 100%;">
            <h3 style="text-align: center;">Cart Totals</h3>
            <form action="{{Route('orders.processing', ['order' => $order])}}" method="post" class="col-4" style="width: 100%; margin: 0 auto;">
                @csrf
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <fieldset style="border: 1px solid #ccc; padding: 10px;">
                                <legend>Personal Information</legend>
                                <label for="name">Name</label><br>
                                <input type="text" id="name" name="name" value="{{ $customer->username }}"
                                    style="width: 100%; margin-bottom: 10px;" readonly><br>

                                <label for="email">Email</label><br>
                                <input type="email" id="email" name="email" value="{{ $customer->email }}"
                                    style="width: 100%; margin-bottom: 10px;" readonly><br>

                                <label for="address">Address</label><br>
                                <input type="text" id="address" name="address" value="{{ $customer->address }}"
                                    style="width: 100%; margin-bottom: 10px;" readonly><br>

                                <label for="phone">Phone</label><br>
                                <input type="text" id="phone" name="phone" value="{{ $customer->phone }}"
                                    style="width: 100%; margin-bottom: 10px;" readonly><br>

                                <label for="paymentType">Payment Type</label><br>
                                <select id="paymentType" name="paymentType" style="width: 100%; margin-bottom: 10px;">
                                    <option value="Cash_on_Delivery">Cash on Delivery</option>
                                </select><br>

                                <input type="hidden" name="Total_final_amount" value="">
                                <input type="hidden" name="order_id" value="">

                        </td>

                        <td>
                            <fieldset style="border: 1px solid #ccc; padding: 10px;">
                                <legend>Order Information</legend>
                                <label for="name">Order Code Number</label><br>
                                <input type="text" id="name" name="name" value="{{ $order->id }}"
                                    style="width: 100%; margin-bottom: 10px;" readonly><br>

                                <label for="email">Total</label><br>
                                <input type="email" id="email" name="email" value="{{ $order->total }}"
                                    style="width: 100%; margin-bottom: 10px;" readonly><br>

                                <label for="address">Net Total</label><br>
                                <input type="text" id="address" name="address" value="{{ $order->net_total }}"
                                    style="width: 100%; margin-bottom: 10px;" readonly><br>

                                <label for="phone">Created At</label><br>
                                <input type="text" id="phone" name="phone" value="{{ $order->updated_at->format("d M Y") }}"
                                    style="width: 100%; margin-bottom: 10px;" readonly><br>

                                <label for="phone">Delivery Time</label><br>
                                <input type="text" id="phone" name="phone" value="Unknown"
                                    style="width: 100%; margin-bottom: 10px;" readonly><br>
                            </fieldset>

                        </td>

                    </tr>
                </table>

                <button class="normal" type="submit" name="checkout"
                    style="padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer;">Proceed
                    to Checkout</button>
            </form>
        </div>
    </section>
@endsection
