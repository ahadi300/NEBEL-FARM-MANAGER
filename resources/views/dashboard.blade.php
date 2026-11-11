
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NEBEL FARM MANAGER</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#">
                    <i class="fas fa-bars"></i>
                </a>
            </li>
        </ul>

        <span class="ml-auto font-weight-bold text-success">
            NEBEL FARM MANAGER
        </span>
    </nav>

    <aside class="main-sidebar sidebar-dark-success elevation-4">
        <a href="/" class="brand-link text-center">
            <span class="brand-text font-weight-bold">NEBEL FARM</span>
        </a>

        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column"
                    data-widget="treeview" role="menu">

                    <li class="nav-item">
                        <a href="/" class="nav-link active">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('farms.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tractor"></i>
                            <p>Farms</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('crops.index') }}" class="nav-link">
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
                        <a href="{{ route('expenses.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-wallet"></i>
                            <p>Expenses Management</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('sales.index') }}" class="nav-link">
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

    <div class="content-wrapper">

        <section class="content-header">
            <div class="container-fluid">
                <h1>Farm Management Dashboard</h1>
                <p class="text-muted">
                    Manage your farms, crops, livestock and business performance.
                </p>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">

                {{-- FARM STATISTICS --}}
                <div class="row">

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalFarms }}</h3>
                                <p>Registered Farms</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tractor"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ number_format($totalAcres, 2) }}</h3>
                                <p>Total Acres</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ number_format($totalHectares, 2) }}</h3>
                                <p>Total Hectares</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-map"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $recentFarms->count() }}</h3>
                                <p>Recent Farm Records</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- CROP AND LIVESTOCK STATISTICS --}}
                <div class="row">

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalCropRecords }}</h3>
                                <p>Crop Records</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-seedling"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $totalLivestockRecords }}</h3>
                                <p>Livestock Records</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-cow"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ number_format($totalAnimals) }}</h3>
                                <p>Total Animals</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-paw"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ number_format($healthyAnimals) }}</h3>
                                <p>Healthy Animals</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-heart"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ number_format($sickAnimals) }}</h3>
                                <p>Sick Animals</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-notes-medical"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ number_format($animalsUnderTreatment) }}</h3>
                                <p>Under Treatment</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-stethoscope"></i>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- FINANCIAL STATISTICS --}}
                <h4 class="mb-3 mt-3">Financial Overview</h4>

                <div class="row">

                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>TZS {{ number_format($totalExpenses, 2) }}</h3>
                                <p>Total Expenses</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>TZS {{ number_format($totalSales, 2) }}</h3>
                                <p>Total Sales</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-12">
                        <div class="small-box {{ $netProfit >= 0 ? 'bg-success' : 'bg-danger' }}">
                            <div class="inner">
                                <h3>TZS {{ number_format($netProfit, 2) }}</h3>
                                <p>Net Profit / Loss</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            Welcome to NEBEL FARM MANAGER
                        </h3>
                    </div>

                    <div class="card-body">
                        Your central workspace for managing agricultural
                        operations, monitoring records and tracking performance.
                    </div>
                </div>

            </div>
        </section>
    </div>

    <footer class="main-footer text-center">
        <strong>NEBEL FARM MANAGER</strong> |
        Farm management made smarter.
    </footer>

</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>

</body>
</html>
