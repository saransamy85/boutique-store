<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Boutique Admin')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #f8f7fa;
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #292033;
            color: #fff;
            padding: 25px 15px;
            overflow-y: auto;
            z-index: 1000;
            transition: 0.3s;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            color: #f2c6d5;
            padding: 0 12px 30px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #d5cedd;
            padding: 13px 15px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 5px;
            font-size: 14px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #49364f;
            color: #fff;
        }

        .sidebar a i {
            font-size: 18px;
        }

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            transition: 0.3s;
        }

        .topbar {
            height: 75px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            border-bottom: 1px solid #eee;
        }

        .content-area {
            padding: 30px;
        }

        .stat-card {
            border: none;
            border-radius: 14px;
            background: #fff;
            padding: 22px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .03);
            height: 100%;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            background: #f9eaf0;
            color: #a34d70;
            font-size: 23px;
        }

        .stat-card h3 {
            font-size: 26px;
            font-weight: bold;
            margin-top: 18px;
        }

        .stat-card p {
            color: #888;
            font-size: 14px;
            margin-bottom: 0;
        }

        .content-card {
            background: #fff;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0, 0, 0, .03);
        }

        .menu-toggle {
            border: none;
            background: transparent;
            font-size: 24px;
        }

        @media(max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.show {
                left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .content-area {
                padding: 18px;
            }

            .topbar {
                padding: 0 18px;
            }
        }

    </style>

    @stack('styles')
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">

        <div class="brand">
            <i class="bi bi-gem"></i> Boutique
        </div>

        <small class="text-uppercase text-secondary px-3">
            Main Menu
        </small>

        <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i> Dashboard
        </a>

        <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">

            <i class="bi bi-tags"></i> Categories
        </a>

        <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">

            <i class="bi bi-bag"></i> Products
        </a>

        <a href="{{ route('admin.inventory.index') }}" class="{{ request()->routeIs('admin.inventory.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Inventory
        </a>

        <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
            <i class="bi bi-cart3"></i> Orders
        </a>

        <a href="{{ route('admin.customers.index') }}" class="{{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Customers
        </a>

        <a href="#">
            <i class="bi bi-ticket-perforated"></i> Coupons
        </a>

        <a href="#">
            <i class="bi bi-bar-chart"></i> Reports
        </a>

        <hr class="border-secondary">

        <small class="text-uppercase text-secondary px-3">
            Settings
        </small>

        <a href="#">
            <i class="bi bi-gear"></i> Store Settings
        </a>

    </aside>

    <!-- Main Content -->
    <div class="main-content">

        <!-- Navbar -->
        <nav class="topbar">

            <div class="d-flex align-items-center gap-3">
                <button class="menu-toggle" onclick="toggleSidebar()">
                    <i class="bi bi-list"></i>
                </button>

                <h6 class="mb-0 fw-bold">Admin Panel</h6>
            </div>

            <div class="d-flex align-items-center gap-3">

                <i class="bi bi-bell fs-5"></i>

                <div class="d-flex align-items-center gap-2">
                    <div class="rounded-circle bg-light p-2">
                        <i class="bi bi-person"></i>
                    </div>

                    <div>
                        <small class="fw-bold">Administrator</small>
                        <br>
                        <small class="text-muted">Store Manager</small>
                    </div>
                </div>

            </div>

        </nav>

        <!-- Page Content -->
        <main class="content-area">
            @yield('content')
        </main>

    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
        }

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>
</html>
