@extends('front.master')


@section('content')
    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modren Desgin</p>
        <x-input-error :messages="$errors->get('quantity')" class="mt-2" />
        @if (session('error-message'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error-message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="pro-container">

            @if (count($products) > 0)
                @foreach ($products as $product)
                    <div class="pro">
                        <!-- <form> -->
                        <img src="{{ asset("storage/products/$product->image") }}" alt="p1" />
                        <div class="des">
                            <h4>{{ $product->name }}</h4>
                            <h6>{{ $product->description }}</h6>
                            <div class="star ">
                                @for ($i = 0; $i <= $product->star; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                            <h4>{{ $product->price }}</h4>
                            <form action="{{ route('orders.store', ['product' => $product]) }}" method="post">
                                @csrf
                                <input type="number" name="quantity">
                                <button type="submit"><a class="cart "><i class="fas fa-shopping-cart"></i></a></button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
    </section>

    {{ $products->render('pagination::bootstrap-4') }}

@endsection
