<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ Route('admin.index') }}">
                <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                    xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg>
            </a>
        </div>

        {{-- Home Page --}}
        <x-button-tab href="{{ Route('admin.index') }}" icon="fe-home" tabName="Dashboard"></x-button-tab>

        <p class="text-muted nav-heading mt-4 mb-1">
            <span>Other</span>
        </p>

        {{-- ============================================= --}}
        {{-- Admins => Only Super Admins will see this buttons --}}
        @if (Auth::user()->rule == 'super_admin')
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item dropdown">
                    <a href="#adminDropdown" data-toggle="collapse" aria-expanded="false"
                        class="dropdown-toggle nav-link">
                        <i class="fe fe-users fe-16"></i>
                        <span class="ml-3 item-text">Admins</span>
                    </a>
                    <ul class="collapse list-unstyled pl-4 w-100" id="adminDropdown">
                        {{-- Admins => Only Super Admins will see this buttons --}}
                        <x-button-tab href="{{ Route('admin.viewAll') }}" icon="fe-user-check"
                            tabName="View Admins"></x-button-tab>

                        {{-- Admins => Only Super Admins will see this buttons --}}
                        <x-button-tab href="{{ Route('admin.create') }}" icon="fe-user-plus"
                            tabName="Add New Admin"></x-button-tab>
                    </ul>
                </li>
            </ul>
        @endif

        {{-- ================== Customers =========================== --}}
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#customerDropdown" data-toggle="collapse" aria-expanded="false"
                    class="dropdown-toggle nav-link">
                    <i class="fe fe-users fe-16"></i>
                    <span class="ml-3 item-text">Customers</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="customerDropdown">
                    <x-button-tab href="{{ Route('admin.viewAllCustomers') }}" icon="fe-user-check"
                        tabName="View Customers"></x-button-tab>
                    <x-button-tab href="{{ Route('admin.activeCustomers') }}" icon="fe-activity"
                        tabName="Active"></x-button-tab>
                    <x-button-tab href="{{ Route('admin.inactiveCustomers') }}" icon="fe-frown"
                        tabName="long Inactive"></x-button-tab>
                </ul>
            </li>
        </ul>

        {{-- ================== Categories =========================== --}}
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#categoryDropdown" data-toggle="collapse" aria-expanded="false"
                    class="dropdown-toggle nav-link">
                    <i class="fe fe-package fe-16"></i>
                    <span class="ml-3 item-text">Categories</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="categoryDropdown">
                    {{-- View Categories --}}
                    <x-button-tab href="{{ Route('admin.categories.index') }}" icon="fe-zoom-in"
                        tabName="View Categories"></x-button-tab>

                    {{-- Add Categgories --}}
                    <x-button-tab href="{{ Route('admin.categories.create') }}" icon="fe-edit-2"
                        tabName="Add Category"></x-button-tab>
                </ul>
            </li>
        </ul>

        {{-- ================== Products =========================== --}}
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#productsDropdown" data-toggle="collapse" aria-expanded="false"
                    class="dropdown-toggle nav-link">
                    <i class="fe fe-briefcase fe-16"></i>
                    <span class="ml-3 item-text">Products</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="productsDropdown">
                    {{-- View Products --}}
                    <x-button-tab href="{{ Route('admin.products.index') }}" icon="fe-zoom-in"
                        tabName="View Products"></x-button-tab>

                    {{-- Add Products --}}
                    <x-button-tab href="{{ Route('admin.products.create') }}" icon="fe-edit-2"
                        tabName="Add Product"></x-button-tab>
                </ul>
            </li>
        </ul>

        {{-- ================== Coupons =========================== --}}
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#couponDropdown" data-toggle="collapse" aria-expanded="false"
                    class="dropdown-toggle nav-link">
                    <i class="fe fe-gift fe-16"></i>
                    <span class="ml-3 item-text">Coupons</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="couponDropdown">
                    {{-- View Categories --}}
                    <x-button-tab href="{{ Route('admin.coupons.index') }}" icon="fe-zoom-in"
                        tabName="View Coupons"></x-button-tab>

                    {{-- Add Categgories --}}
                    <x-button-tab href="{{ Route('admin.coupons.create') }}" icon="fe-edit-2"
                        tabName="Add Coupon"></x-button-tab>
                </ul>
            </li>
        </ul>

        {{-- ================== Orders =========================== --}}
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#OrdersDropdown" data-toggle="collapse" aria-expanded="false"
                    class="dropdown-toggle nav-link">
                    <i class="fe fe-shopping-cart fe-16"></i>
                    <span class="ml-3 item-text">Orders</span>
                </a>
                <ul class="collapse list-unstyled pl-4 w-100" id="OrdersDropdown">
                    {{-- View Orders --}}
                    <x-button-tab href="{{ Route('admin.viewAllOrders') }}" icon="fe-shopping-bag"
                        tabName="View Orders"></x-button-tab>

                    <x-button-tab href="{{ Route('admin.viewAllProcessingOrders') }}" icon="fe-refresh-cw"
                        tabName="Processing"></x-button-tab>

                    <x-button-tab href="{{ Route('admin.viewAllShippedOrders') }}" icon="fe-truck"
                        tabName="shipped"></x-button-tab>

                    <x-button-tab href="{{ Route('admin.viewAllDeliveredOrders') }}" icon="fe-thumbs-up"
                        tabName="delivered"></x-button-tab>

                    <x-button-tab href="{{ Route('admin.viewAllCancelledOrders') }}" icon="fe-x-octagon"
                        tabName="cancelled"></x-button-tab>

                    {{-- more --}}

                </ul>
            </li>
        </ul>
        
        {{-- ================== Payments =========================== --}}
        {{-- View Payments --}}
        <x-button-tab href="{{ Route('admin.payments.index') }}" icon="fe-dollar-sign"
            tabName="Payments"></x-button-tab>

        {{-- ================== Messges =========================== --}}
        {{-- View Messges --}}
        <x-button-tab href="{{ Route('admin.viewMessages') }}" icon="fe-message-square"
            tabName="Messges"></x-button-tab>

        {{-- ================== Conversations =========================== --}}
        {{-- Conversations --}}
        <x-button-tab href="{{ Route('admin.conversations.index') }}" icon="fe-message-circle"
            tabName="Conversations"></x-button-tab>

        {{-- ============================================= --}}

        {{-- <p class="text-muted nav-heading mt-4 mb-1">
            <span>Other</span>
        </p> --}}

        {{-- ============================================= --}}
        {{-- Customers --}}
        {{-- <x-button-tab href="#" icon="fe-users" tabName="Customers"></x-button-tab> --}}

        {{-- =============================================
        {{-- Products --}}
        {{-- <x-button-tab href="#" icon="fe-shopping-bag" tabName="Products"></x-button-tab> --}}

        {{-- ============================================= --}}
        {{-- Orders --}}
        {{-- <x-button-tab href="#" icon="fe-archive" tabName="Orders"></x-button-tab> --}}

        {{-- ============================================= --}}
        {{-- Blogs --}}
        {{-- <x-button-tab href="#" icon="fe-file-text" tabName="Blogs"></x-button-tab> --}}

        {{-- ============================================= --}}
        {{-- Coupons --}}
        {{-- <x-button-tab href="#" icon="fe-dollar-sign" tabName="Coupons"></x-button-tab> --}}


    </nav>
</aside>
