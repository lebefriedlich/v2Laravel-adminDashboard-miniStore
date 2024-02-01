<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $data['judul'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body>
    <header class="navbar sticky-top bg-secondary flex-md-nowrap p-0 shadow" data-bs-theme="dark">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="dashboard">
            <img src="{{ asset('images/main-logo.png') }}" alt="main-logo">
        </a>
    </header>
    
    <div class="container-fluid bg-body-tertiary min-vh-100">
        <div class="row">
            <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary min-vh-100 position-fixed" style="top: 10;">
                <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
                    <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
                        <h3 class="ms-3">Hai, {{ session('data') }}</h3>
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 text-black " href="dashboard">
                                        <i class="{{ Request::is('dashboard') ? 'bi bi-house-fill' : 'bi bi-house' }}"></i> Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 text-black" href="customers">
                                    <i class="{{ Request::is('customers') ? 'bi bi-people-fill' : 'bi bi-people' }}"></i> Customers
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 text-black" href="admins">
                                    <i class="{{ Request::is('admins') ? 'bi bi-person-fill' : 'bi bi-person' }}"></i> Admins
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 text-black" href="products">
                                    <i class="{{ Request::is('products') ? 'bi bi-cart-fill' : 'bi bi-cart' }}"></i> Products
                                </a>
                            </li>
                        </ul>
    
                        <hr class="my-3">
    
                        <ul class="nav flex-column mb-auto">
                            <li class="nav-item">
                                <a class="nav-link d-flex align-items-center gap-2 text-black" href="{{ url('logout') }}">
                                    <i class="bi bi-door-closed"></i> Sign out
                                </a>
                            </li>
                        </ul>                        
                    </div>
                </div>
            </div>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield('container')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>

