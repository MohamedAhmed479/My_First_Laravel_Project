@extends('front.master')


@section('content')
    <section id="page-header" class="about-header">
        <h2>#Cart</h2>
        <p>Let's see what you have.</p>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                @if ($order != null)
                    @if (count($products) > 0)
                        <tr>
                            <td>Image</td>
                            <td>Name</td>
                            <td>Quantity</td>
                            <td>price</td>
                            <td>Subtotal</td>
                            <td>Remove</td>
                        </tr>
                    @endif
                @endif
            </thead>

            <tbody>
                @if ($order != null)
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <tr>
                                <td><img src="{{ asset("storage/products/$product->image") }}" alt="{{ $product->name }}">
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->pivot->amount }}</td>

                                <!-- Remove any cart item  -->
                                <td>
                                    <form
                                        action="{{ route('orders.destroy', ['order_id' => Crypt::encrypt($order->id), 'product_id' => Crypt::encrypt($product->id)]) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            You don't have any items in your cart right now. <a href="{{ Route('indexPage') }}">Enter to add
                                products</a>
                        </div>
                    @endif
                @else
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        You don't have any items in your cart right now. <a href="{{ Route('indexPage') }}">Enter to add
                            products</a>
                    </div>
                @endif
            </tbody>

        </table>
    </section>

    @if ($order != null)
        @if (count($products) > 0)
            <section id="cart-add" class="section-p1">


                <div id="coupon">
                    <form action="{{ route('orders.applyCoupon', ['order' => $order]) }}" method="post">
                        @csrf
                        <h3>Coupon</h3>
                        <input type="text" name="coupon_code"
                            value="@if (!empty($order->coupon->code)) {{ $order->coupon->code }} @endif"
                            placeholder="Enter coupon code" required>
                        <x-input-error :messages="$errors->get('coupon_code')" class="mt-2" />
                        <x-success-alert key='success'></x-success-alert>

                        <button type="submit" class="normal">Apply</button>
                    </form>
                </div>

                <div id="subTotal">
                    <h3>Cart totals</h3>
                    <table>
                        <tr>
                            <td>Subtotal</td>
                            <td>${{ $subtotal }}</td>
                        </tr>

                        @if (!empty($coupon_discount_value))
                            <tr>
                                <td>Discount Value ({{ $percentage }})%</td>
                                <td>${{ $coupon_discount_value }} </td>
                            </tr>
                        @endif
                        <tr>
                            <td>Shipping</td>
                            <td>${{ $shipping }}</td>
                        </tr>
                        <tr>
                            <td>Tax(14)%</td>
                            <td>${{ $tax }}</td>
                        </tr>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>${{ $net_total }}</strong></td>
                        </tr>
                    </table>


                    <form action="{{ route('orders.confirmOrder', ['order' => $order]) }}" method="post">
                        @csrf

                        <button type="submit" class="normal">proceed to checkout</button>
                    </form>
                </div>
            </section>
        @endif
    @endif
@endsection
