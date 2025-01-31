<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 280px;
            --navbar-height: 65px;
            --primary-dark: #2c3e50;
            --secondary-dark: #34495e;
        }

        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: var(--primary-dark);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            height: var(--navbar-height);
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            background: var(--secondary-dark);
        }

        .sidebar-toggle {
            position: absolute;
            right: -15px;
            top: 80px;
            width: 30px;
            height: 30px;
            background: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border: none;
            z-index: 1001;
        }

        .nav-item {
            margin: 5px 10px;
        }

        .nav-link {
            color: #fff;
            padding: 12px 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: #fff;
        }

        .nav-link.active {
            background: #3498db;
            color: #fff;
        }

        .nav-link i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        /* Main Content Styles */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        /* Navbar Styles */
        .main-navbar {
            height: var(--navbar-height);
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .navbar-profile img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Search Bar */
        .search-bar {
            max-width: 400px;
            position: relative;
        }

        .search-bar input {
            padding-left: 40px;
            border-radius: 20px;
            border: 1px solid #e0e0e0;
        }

        .search-bar i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }

        /* Cards */
        .stat-card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        /* Activity Timeline */
        .timeline-item {
            position: relative;
            padding-left: 30px;
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #3498db;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            left: 5px;
            top: 12px;
            width: 2px;
            height: calc(100% + 10px);
            background: #e0e0e0;
        }

        /* Progress bars */
        .progress {
            height: 8px;
            border-radius: 4px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.collapsed {
                transform: translateX(0);
                width: var(--sidebar-width);
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.expanded {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="sidebar-header">
        <h4 class="text-white mb-0">AdminPanel</h4>
    </div>
    <button class="sidebar-toggle">
        <i class="fas fa-chevron-left"></i>
    </button>
    <div class="px-3 py-4">
        <nav class="nav flex-column">
            <div class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-users"></i>
                    <span>Users</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Products</span>
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-chart-bar"></i>
                    <span>Analytics</span>
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
</div>

<!-- Main Content -->
<div class="main-content">
    <!-- Navbar -->
    <nav class="main-navbar px-4 d-flex align-items-center justify-content-between">
        <div class="search-bar">
            <i class="fas fa-search"></i>
            <input type="text" class="form-control" placeholder="Search...">
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown me-3">
                <button class="btn btn-link text-dark position-relative" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        3
                    </span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">New User Registration</a></li>
                    <li><a class="dropdown-item" href="#">New Order #12345</a></li>
                    <li><a class="dropdown-item" href="#">Server Update Required</a></li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn d-flex align-items-center" type="button" data-bs-toggle="dropdown">
                    <div class="navbar-profile me-2">
                        <img src="/api/placeholder/100/100" alt="Profile">
                    </div>
                    <span>John Doe</span>
                    <i class="fas fa-chevron-down ms-2"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i>Settings</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Dashboard Content -->
    <div class="p-4">
        <!-- Stats -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Total Sales</h6>
                                <h3 class="mb-0">$24,156</h3>
                                <small class="text-white-50">+12% from last month</small>
                            </div>
                            <div class="fs-1 opacity-75">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Total Orders</h6>
                                <h3 class="mb-0">1,352</h3>
                                <small class="text-white-50">+5% from last month</small>
                            </div>
                            <div class="fs-1 opacity-75">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">New Users</h6>
                                <h3 class="mb-0">328</h3>
                                <small class="text-white-50">+18% from last month</small>
                            </div>
                            <div class="fs-1 opacity-75">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card stat-card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title mb-1">Total Products</h6>
                                <h3 class="mb-0">856</h3>
                                <small class="text-white-50">+2% from last month</small>
                            </div>
                            <div class="fs-1 opacity-75">
                                <i class="fas fa-box"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Cards -->
        <div class="row g-4">
            <!-- Recent Orders -->
            <div class="col-12 col-xl-8">
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Recent Orders</h5>
                        <button class="btn btn-primary btn-sm">View All</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#12345</td>
                                        <td>John Doe</td>
                                        <td>Product A</td>
                                        <td>$99.99</td>
                                        <td><span class="badge bg-success">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>#12346</td>
                                        <td>Jane Smith</td>
                                        <td>Product B</td>
                                        <td>$149.99</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>#12347</td>
                                        <td>Mike Johnson</td>
                                        <td>Product C</td>
                                        <td>$199.99</td>
                                        <td><span class="badge bg-info">Processing</span></td>
                                    </tr>
                                    <tr>
                                        <td>#12348</td>
                                        <td>Sarah Williams</td>
                                        <td>Product D</td>
                                        <td>$299.99</td>
                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Recent Activity</h5>
                    </div>
                    <div class="card-body">
                        <div class="timeline-item mb-4">
                            <h6 class="mb-1">