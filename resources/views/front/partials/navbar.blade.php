<section id="header">
    <a href="{{ Route('indexPage') }}">
        <img src="{{ asset('assets') }}/img/logo.png" alt="homeLogo">
    </a>

    <div>
        <ul id="navbar">
            <li class="link">
                <a class="active " href="{{ Route('indexPage') }}"></a>
            </li>
            <li class="link">
                <a href="{{ Route('shopPage') }}">Shop</a>
            </li>

            {{-- <li class="link">
                <a href="about.html">About</a>
            </li>
            <li class="link">
                <a href="contact.html">Contact</a>
            </li> --}}
            {{-- <li class="link">
                <a href="lang.php?lang=en">English</a>
            </li>
            <li class="link">
                <a href="lang.php?lang=ar">Arabic</a>
            </li> --}}

            <li class="link">
                <a href="{{ Route('contact') }}">Contact</a>
            </li>

            @if (Auth::check())
                @if (Auth::user()->rule == 'customer')
                    <li class="link">
                        <a href="{{ Route('conversations') }}">Customer Service</a>
                    </li>
                @endif
            @endif

            @if (Auth::check())
                @if (Auth::user()->rule == 'admin' || Auth::user()->rule == 'super_admin')
                    <li class="link">
                        <a href="{{ Route('admin.index') }}">Dashboard</a>
                    </li>
                @endif
            @endif

            @if (!Auth::check())
                <li class="link">
                    <a href="{{ route('login') }}" class="link">Login</a>
                </li>
                <li class="link">
                    <a href="{{ route('register') }}" class="link">Register</a>
                </li>
            @else
                <li class="link">
                    <a href="#" id="logout-link"
                        style="cursor: pointer; background: none; border: none; padding: 0;">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                </li>

                <script>
                    document.getElementById('logout-link').addEventListener('click', function(event) {
                        event.preventDefault();
                        document.getElementById('logout-form').submit();
                    });
                </script>

                <li class="link">
                    <a href="{{ Route('orders.allOrders') }}">My Orders</a>
                </li>
            @endif


            <li class="link">
                <a id="lg-cart" href="{{ Route('orders.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                </a>
            </li>
            <a href="#" id="close"><i class="fas fa-times"></i> </a>
        </ul>

    </div>

    <div id="mobile">
        <a href="cart.html">
            <i class="fas fa-shopping-cart"></i>
        </a>
        <a href="#" id="bar"> <i class="fas fa-outdent"></i> </a>
    </div>
</section>
