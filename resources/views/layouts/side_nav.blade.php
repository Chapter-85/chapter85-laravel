<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('home') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('frontend/images/logo-gold.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('frontend/images/logo-gold.png') }}" alt=""
                    style="max-height: 100%; height: auto; width: 180px;">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('home') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('frontend/images/logo-white.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('frontend/images/logo-white.png') }}" alt=""
                    style="max-height: 100%; height: auto; width: 180px;">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ Request::is('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('customers') || Request::is('customers/*') ? 'active' : '' }}"
                        href="{{ route('customers.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Customers</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('agents') ? 'active' : '' }}"
                        href="{{ route('agents.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Agents</span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('categories') || Request::is('categories/*') ? 'active' : '' }}"
                        href="{{ route('categories.index') }}" role="
                        button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Categories</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('manufacturers') || Request::is('manufacturers/*') ? 'active' : '' }}"
                        href="{{ route('manufacturers.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Manufacturers</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('products') || Request::is('products/*') ? 'active' : '' }}"
                        href="{{ route('products.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Products</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('delivery-charges') || Request::is('delivery-charges/*') ? 'active' : '' }}"
                        href="{{ route('delivery-charges.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Delivery Charges</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('inventories') || Request::is('inventories/*') ? 'active' : '' }}"
                        href="{{ route('inventories.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Inventory</span>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('customers-products') || Request::is('customers-products/*') ? 'active' : '' }}"
                        href="{{ route('customer-products.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Customers Products</span>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('product-commission') || Request::is('product-commission/*') ? 'active' : '' }}"
                        href="{{ route('product-commission.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Products Commission</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('orders') || Request::is('orders/*') ? 'active' : '' }}"
                        href="{{ route('orders.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Customer Orders</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link
                    {{ Request::is('exchange-rate') || Request::is('exchange-rate/*') ? 'active' : '' }}"
                        href="{{ route('exchange-rate.index') }}" role="button">
                        <i class="ri-home-smile-line"></i> <span data-key="t-dashboards">Exchange Rate</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link @if (Request::is('setup') ||
                        Request::is('setup/*') ||
                        Request::is('payment-methods/*') ||
                        Request::is('payment-methods') ||
                        Request::is('nationalities') ||
                        Request::is('nationalities/*')) active @endif"
                        href="#sidebarMultilevel" data-bs-toggle="collapse" role="button"
                        aria-expanded="@if (Request::is('setup') ||
                            Request::is('setup/*') ||
                            Request::is('payment-methods/*') ||
                            Request::is('payment-methods') ||
                            Request::is('nationalities') ||
                            Request::is('nationalities/*')) true @else false @endif"
                        aria-controls="sidebarMultilevel">
                        <i class="ri-settings-2-fill"></i>
                        <span data-key="t-multi-level">Setup</span>
                    </a>

                    <div class="collapse menu-dropdown @if (Request::is('setup') ||
                        Request::is('setup/*') ||
                        Request::is('payment-methods/*') ||
                        Request::is('payment-methods') ||
                        Request::is('nationalities') ||
                        Request::is('nationalities/*')) show @endif"
                        id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('setup') || Request::is('setup/*') ? 'active' : '' }}"
                                    href="{{ route('setup.index') }}" data-key="t-dashboards">Delivery
                                    Methods</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('payment-methods') || Request::is('payment-methods/*') ? 'active' : '' }}"
                                    href="{{ route('payment-methods.index') }}" data-key="t-dashboards">Payment
                                    Methods</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Request::is('nationalities') || Request::is('nationalities/*') ? 'active' : '' }}"
                                    href="{{ route('nationalities.index') }}"
                                    data-key="t-dashboards">Nationalities</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link @if (Request::is('staffs') ||
                        Request::is('staffs/*') ||
                        Request::is('roles-permission-assignment-list') ||
                        Request::is('permissions') ||
                        Request::is('permissions/*') ||
                        Request::is('roles') ||
                        Request::is('roles/*')) active @endif"
                        href="#sidebarRolePermission" data-bs-toggle="collapse" role="button"
                        aria-expanded="@if (Request::is('staffs') ||
                            Request::is('staffs/*') ||
                            Request::is('roles-permission-assignment-list') ||
                            Request::is('permissions') ||
                            Request::is('permissions/*') ||
                            Request::is('roles') ||
                            Request::is('roles/*')) true @else false @endif"
                        aria-controls="sidebarRolePermission">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Roles & Permissions</span>
                    </a>
                    <div class="collapse menu-dropdown @if (Request::is('staffs') ||
                        Request::is('staffs/*') ||
                        Request::is('roles-permission-assignment-list') ||
                        Request::is('permissions') ||
                        Request::is('permissions/*') ||
                        Request::is('roles') ||
                        Request::is('roles/*')) show @endif"
                        id="sidebarRolePermission">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('staffs.index') }}"
                                    class="nav-link {{ Request::is('staffs') || Request::is('staffs/*') ? 'active' : '' }}"
                                    data-key="t-analytics">
                                    Staffs
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles-permission-assignment-list') }}"
                                    class="nav-link {{ Request::is('roles-permission-assignment-list') || Request::is('roles-permission-assignment-list/*') ? 'active' : '' }}"
                                    data-key="t-analytics"> Roles Assignment </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}"
                                    class="nav-link {{ Request::is('roles') || Request::is('roles/*') ? 'active' : '' }}"
                                    data-key="t-analytics"> Roles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('permissions.index') }}"
                                    class="nav-link {{ Request::is('permissions') || Request::is('permissions/*') ? 'active' : '' }}"
                                    data-key="t-analytics">
                                    Permissions </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</div>
