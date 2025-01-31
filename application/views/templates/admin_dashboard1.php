<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --topbar-height: 70px;
            --primary-bg: #f8f9fa;
            --sidebar-bg: #fff;
            --accent-color: #4361ee;
            --text-muted: #6c757d;
        }

        body {
            background-color: var(--primary-bg);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, sans-serif;
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--sidebar-bg);
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar-brand {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }

        .sidebar-brand img {
            width: 35px;
            height: 35px;
        }

        .nav-section {
            padding: 1rem 0;
        }

        .nav-section-title {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 0 1.5rem;
            margin-bottom: 0.5rem;
        }

        .nav-item {
            padding: 0 1rem;
        }

        .nav-link {
            color: #495057;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            font-size: 0.9rem;
        }

        .nav-link:hover {
            color: var(--accent-color);
            background: rgba(67, 97, 238, 0.05);
        }

        .nav-link.active {
            color: var(--accent-color);
            background: rgba(67, 97, 238, 0.1);
        }

        .nav-link i {
            width: 20px;
            font-size: 1.1rem;
            margin-right: 0.75rem;
        }

        .nav-link .badge {
            margin-left: auto;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            padding: 1.5rem;
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            height: var(--topbar-height);
            background: #fff;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: -1.5rem -1.5rem 1.5rem;
            box-shadow: 0 2px 15px rgba(0,0,0,0.04);
        }

        .search-bar {
            position: relative;
            width: 300px;
        }

        .search-bar input {
            padding: 0.6rem 1rem 0.6rem 2.5rem;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            background: #f8f9fa;
            width: 100%;
        }

        .search-bar i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
        }

        .topbar-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .topbar-btn {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: transparent;
            color: #495057;
            position: relative;
            transition: all 0.2s;
        }

        .topbar-btn:hover {
            background: rgba(0,0,0,0.04);
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--accent-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .user-profile:hover {
            background: rgba(0,0,0,0.04);
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            object-fit: cover;
        }

        /* Cards */
        .stat-card {
            background: #fff;
            border-radius: 12px;
            border: none;
            box-shadow: 0 2px 15px rgba(0,0,0,0.04);
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card .card-body {
            padding: 1.5rem;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        /* Data Tables */
        .data-table {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.04);
        }

        .data-table .table {
            margin-bottom: 0;
        }

        .data-table th {
            border-top: none;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            padding: 1rem 1.5rem;
        }

        .data-table td {
            padding: 1rem 1.5rem;
            vertical-align: middle;
        }

        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 6px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Progress bars */
        .progress {
            height: 8px;
            border-radius: 4px;
            background-color: rgba(67, 97, 238, 0.1);
        }

        .progress-bar {
            background-color: var(--accent-color);
        }

        /* Charts */
        .chart-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.04);
            padding: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <img src="/api/placeholder/35/35" alt="Logo" class="me-2">
        <h5 class="mb-0">AdminPro</h5>
    </div>

    <div class="nav-section">
        <div class="nav-section-title">Main Menu</div>
        <nav class="nav flex-column">
            <div class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Orders</span>
                    <span class="badge bg-primary rounded-pill">New</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-box"></i>
                    <span>Products</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i>
                    <span>Customers</span>
                </a>
            </div>
        </nav>
    </div>

    <div class="nav-section">
        <div class="nav-section-title">Management</div>
        <nav class="nav flex-column">
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-line"></i>
                    <span>Analytics</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-wallet"></i>
                    <span>Finance</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-ticket-alt"></i>
                    <span>Support</span>
                </a>
            </div>
        </nav>
    </div>

    <div class="nav-section">
        <div class="nav-section-title">Settings</div>
        <nav class="nav flex-column">
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
        </nav>
    </div>
</aside>

<!-- Main Content -->
<main class="main-content">
    <!-- Topbar -->
    <div class="topbar">
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" class="form-control" placeholder="Search...">
        </div>

        <div class="topbar-actions">
            <button class="topbar-btn">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </button>
            <button class="topbar-btn">
                <i class="fas fa-envelope"></i>
                <span class="notification-badge">5</span>
            </button>
            <div class="user-profile" data-bs-toggle="dropdown">
                <img src="/api/placeholder/40/40" alt="User">
                <div>
                    <h6 class="mb-0">John Doe</h6>
                    <small class="text-muted">Admin</small>
                </div>
                <i class="fas fa-chevron-down ms-2"></i>
            </div>
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="container-fluid p-0">
        <!-- Welcome Card -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card stat-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">Welcome back, John!</h4>
                            <p class="text-muted mb-0">Here's what's happening with your store today.</p>
                        </div>
                        <button class="btn btn-primary">Download Report</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Row -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-1">Total Revenue</p>
                                <h4 class="mb-0">$84,686</h4>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up me-1"></i>
                                    8.3% from last month
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="stat-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-success bg-opacity-10 text-success me-3">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                            <div>
                                <p class="text-muted mb-1">Total Orders</p>
                                <h4 class="mb-0">2,456</h4>
                                <small class="text-success">
                                    <i class="fas fa-arrow-up me-1