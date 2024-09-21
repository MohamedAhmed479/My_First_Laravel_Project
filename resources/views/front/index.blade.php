@extends('front.master')


@section('content')
    <section id="hero">

        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 70% off!</p>
        <button onclick="window.location.href='{{ Route('shopPage') }}'">Shop Now!</button>

    </section>

    <!-- End Hero -->

    <!-- start Feature-->
    <section id="feature" class="section-p1">
        <div class="fe-1">
            <img src="{{ asset('assets') }}/img/features/f1.png" alt="">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-1">
            <img src="{{ asset('assets') }}/img/features/f2.png" alt="">
            <h6>Online Order</h6>
        </div>
        <div class="fe-1">
            <img src="{{ asset('assets') }}/img/features/f3.png" alt="">
            <h6>Save Money</h6>
        </div>
        <div class="fe-1">
            <img src="{{ asset('assets') }}/img/features/f4.png" alt="">
            <h6>Promitions</h6>
        </div>
        <div class="fe-1">
            <img src="{{ asset('assets') }}/img/features/f5.png" alt="">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-1">
            <img src="{{ asset('assets') }}/img/features/f6.png" alt="">
            <h6>F7/24 Support</h6>
        </div>
    </section>
    <!-- End Feature-->

    <!-- Start New Arrival or productCard Features -->
    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modren Desgin</p>
        <div class="pro-container">

            @if (count($firstProducts) > 0)
                @foreach ($firstProducts as $product)
                    <div class="pro">
                        <img src="{{ asset("storage/products/$product->image") }}" alt="p1">
                        <div class="des">
                            <span>{{ $product->name }}</span>
                            <h5>{{ $product->description }}</h5>
                            <div class="star">
                                @for ($i = 0; $i <= $product->star; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <h4>{{ $product->price }}</h4>
                            <form action="{{ route('orders.store', ['product' => $product]) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </section>
    <!-- End New Arrival -->

    <!-- Start bannar -->
    <section id="bannar" class="section-m1">
        <h4>Repair Service</h4>
        <h2>Up to <span>70% Off</span> - All t-Shirts & Accessories</h2>
        <button class="normal">Explore More</button>
    </section>
    <!-- End bannar -->

    <section id="product1" class="section-p1">
        <h2>New Arrival</h2>
        <p>Summer Collection New Modren Desgin</p>
        <div class="pro-container">

            @if (count($secondeProducts) > 0)
                @foreach ($secondeProducts as $product)
                    <div class="pro">
                        <img src="{{ asset("storage/products/$product->image") }}" alt="p1">
                        <div class="des">
                            <span>{{ $product->name }}</span>
                            <h5>{{ $product->description }}</h5>
                            <div class="star">
                                @for ($i = 0; $i <= $product->star; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <h4>{{ $product->price }}</h4>
                            <form action="{{ route('orders.store', ['product' => $product]) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="cart">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
    </section>


    <section id="sm-bannar" class="section-p1">
        <table style="width: 100%;" cellspacing="20">
            <tr>
                <td>
                    <div class="bannar-box">
                        <h4>Crazy Deals</h4>
                        <h2>buy 1 get 1 Free</h2>
                        <span>The best classic dress is on sale from cara</span>
                        <button class="white">Learn More</button>
                    </div>
                </td>
                <td>
                    <div class="bannar-box bannar-box2">
                        <h4>Spring/Summer</h4>
                        <h2>buy 1 get 1 Free</h2>
                        <span>The best classic dress is on sale from cara</span>
                        <button class="white">Learn More</button>
                    </div>
                </td>
            </tr>
        </table>
    </section>


    <section id="bannar3" class="section-p1">
        <div class="bannar-box">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection - 50% off</h3>
        </div>
        <div class="bannar-box bannar-box2">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection - 50% off</h3>
        </div>
        <div class="bannar-box bannar-box3">
            <h2>SEASONAL SALE</h2>
            <h3>Winter Collection - 50% off</h3>
        </div>
    </section>

@endsection
