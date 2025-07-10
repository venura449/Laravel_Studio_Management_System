<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Cafe Pixel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        .navbar-cafepixel {
            background: linear-gradient(90deg, #000 0%, #1e3a8a 100%);
            color: #fff !important;
            box-shadow: 0 2px 8px rgba(30,58,138,0.07);
        }
        .navbar-cafepixel .navbar-brand {
            color: #3b82f6 !important;
            font-weight: bold;
            font-size: 1.5rem;
            letter-spacing: 2px;
            font-family: 'Nunito', sans-serif;
        }
        .navbar-cafepixel .nav-link, .navbar-cafepixel .dropdown-toggle {
            color: #fff !important;
            font-weight: 500;
        }
        .navbar-cafepixel .dropdown-menu {
            background: #1e3a8a;
            border: none;
        }
        .navbar-cafepixel .dropdown-item {
            color: #fff;
            transition: background 0.2s;
        }
        .navbar-cafepixel .dropdown-item:hover {
            background: #3b82f6;
            color: #fff;
        }
        .navbar-cafepixel .btn-logout {
            background: linear-gradient(90deg, #1e3a8a 0%, #3b82f6 100%);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 0.375rem 1.25rem;
            font-weight: 600;
            margin-left: 0.5rem;
        }
        .navbar-cafepixel .btn-logout:hover {
            background: #3b82f6;
            color: #fff;
        }
    </style>
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-cafepixel">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <i class="bi bi-palette me-2" style="font-size:1.7rem;"></i>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('/home') }}">
                                        <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                    </a>
                                    <a class="dropdown-item" href="#"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        @if(!request()->is('login') && !request()->is('register'))
        <div class="container-fluid">
            <div class="row">
                <!-- Side Navigation Panel -->
                <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar position-fixed h-100" id="sidebarMenu" style="top:0; left:0; z-index:1030; min-height:100vh; overflow-y:auto;">
                    <div class="position-sticky pt-3">
                        <div class="text-center mb-4">
                            <h4 class="text-white">Cafe Pixel Studio</h4>
                            <hr class="bg-light">
                        </div>
                        <ul class="nav flex-column">
                            @if(auth()->user()->getrole()=="cashier" || auth()->user()->getrole()=="admin")
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{route('home')}}">
                                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('user/manage') ? 'active' : '' }}" href="{{route('user.manage')}}">
                                    <i class="bi bi-people me-2"></i> User Management
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('order/create') ? 'active' : '' }}" href="{{route('order.create')}}">
                                    <i class="bi bi-plus-square me-2"></i> Create Order
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('order/view') ? 'active' : '' }}" href="{{route('order.view')}}">
                                    <i class="bi bi-list-check me-2"></i> View Orders
                                </a>
                            </li>
                            @if(auth()->user()->getrole()=="cashier" || auth()->user()->getrole()=="admin")
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('item/create') ? 'active' : '' }}" href="{{route('item.create')}}">
                                    <i class="bi bi-plus-circle me-2"></i> Add Items
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('item/View') ? 'active' : '' }}" href="{{route('item.view')}}">
                                    <i class="bi bi-box-seam me-2"></i> Manage Items
                                </a>
                            </li>
                            @endif
                           @if(auth()->user()->getrole()=="cashier" || auth()->user()->getrole()=="admin")
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('pay/view') ? 'active' : '' }}" href="{{route('pay.view')}}">
                                        <i class="bi bi-cash-stack me-2"></i> Payment & Billing
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->getrole()=="cashier" || auth()->user()->getrole()=="admin")
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('pay/unpaidview') ? 'active' : '' }}" href="{{route('pay.unpaidview')}}">
                                        <i class="bi bi-hourglass-split me-2"></i> Pending Payments
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->getrole()=="cashier" || auth()->user()->getrole()=="admin")
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('pay/paidview') ? 'active' : '' }}" href="{{route('pay.paidview')}}">
                                        <i class="bi bi-receipt me-2"></i> Processed Payments
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
                <!-- Main Content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 offset-md-3 offset-lg-2" style="min-height:100vh; background: #f8fafc; padding-top: 2rem;">
                    @yield('content')
                </main>
            </div>
        </div>
        @else
        <main>
            @yield('content')
        </main>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    @stack('scripts')
</body>
</html>
