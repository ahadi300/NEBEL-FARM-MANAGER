
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'NEBEL FARM MANAGER')</title>

    <!-- Website Favicon -->
    <link rel="icon" type="image/png"
          href="{{ asset('images/nebel-logo.png') }}?v=2">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        .brand-link {
            height: 85px;
            display: flex !important;
            align-items: center;
            justify-content: center;
            padding: 8px;
            background: #ffffff;
        }

        .brand-link img {
            display: block;
            max-width: 100%;
        }
    </style>

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

       <div class="ml-auto d-flex align-items-center">
    <img src="{{ asset('images/nebel-logo.png') }}"
         alt="NEBEL FARM MANAGER"
         style="height: 40px; width: auto; object-fit: contain;">

    <span class="ml-2 font-weight-bold text-success">
        NEBEL FARM MANAGER
    </span>
</div>
    </nav>

    <!-- Sidebar -->
    <aside class="main-sidebar sidebar-dark-success elevation-4">

        <a href="{{ url('/') }}" class="brand-link text-center">

    <img src="{{ asset('images/nebel-logo.png') }}"
         alt="NEBEL FARM MANAGER"
         style="width: 170px; max-height: 65px; object-fit: contain;">

</a>

        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview" role="menu">

                    <li class="nav-item">
                        <a href="{{ url('/') }}"
                           class="nav-link {{ request()->routeIs('dashboard') || request()->is('/') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('farms.index') }}"
                           class="nav-link {{ request()->routeIs('farms.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-tractor"></i>
                            <p>Farms</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('crops.index') }}"
                           class="nav-link {{ request()->routeIs('crops.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-seedling"></i>
                            <p>Crop Management</p>
                        </a>
                    </li>

                    
                    <li class="nav-item">
    <a href="{{ route('livestock.index') }}" class="nav-link">
        <i class="nav-icon fas fa-cow"></i>
        <p>Livestock</p>
    </a>
</li>

             
<li class="nav-item">
    <a href="{{ route('expenses.index') }}"
       class="nav-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}">

        <i class="nav-icon fas fa-wallet"></i>
        <p>Expenses Management</p>

    </a>
</li>

<li class="nav-item">
    <a href="{{ route('sales.index') }}"
       class="nav-link {{ request()->routeIs('sales.*') ? 'active' : '' }}">

        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>Sales Management</p>

    </a>
</li>

<li class="nav-item">
    <a href="{{ route('reports.index') }}"
       class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-file-alt"></i>
        <p>Reports</p>
    </a>
</li>

                </ul>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <h1>@yield('page-title', 'Dashboard')</h1>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>

    </div>

    <!-- Footer -->
    <footer class="main-footer text-center">
        <strong>NEBEL FARM MANAGER</strong> |
        Discover Smart Solutions
    </footer>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
