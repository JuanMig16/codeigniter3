<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .login-container {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
        }
        
        .login-form {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            transform: translateY(20px);
            opacity: 0;
            animation: fadeInUp 0.5s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #0d6efd;
        }

        .login-btn {
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
        }

        .dashboard-container {
            display: none;
        }

        .sidebar {
            min-height: 100vh;
            background: #212529;
        }

        .nav-link {
            color: #fff;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: #0dcaf0;
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>

<!-- Login Form -->
<div class="login-container d-flex align-items-center justify-content-center">
    <div class="login-form p-5 w-100" style="max-width: 400px;">
        <h2 class="text-center mb-4">Admin Login</h2>
        <form id="loginForm">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" required>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 login-btn">Login</button>
        </form>
    </div>
</div>

<!-- Dashboard -->
<div class="dashboard-container">
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-auto sidebar p-3">
            <h4 class="text-white mb-4">Admin Panel</h4>
            <nav class="nav flex-column">
                <a class="nav-link active" href="#"><i class="fas fa-home me-2"></i>Dashboard</a>
                <a class="nav-link" href="#"><i class="fas fa-users me-2"></i>Users</a>
                <a class="nav-link" href="#"><i class="fas fa-chart-bar me-2"></i>Analytics</a>
                <a class="nav-link" href="#"><i class="fas fa-cog me-2"></i>Settings</a>
                <a class="nav-link" href="#" id="logoutBtn"><i class="fas fa-sign-out-alt me-2"></i>Logout</a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="col p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Dashboard</h2>
                <div class="dropdown">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-2"></i>Admin
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" id="dropdownLogout">Logout</a></li>
                    </ul>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-3">
                    <div class="card stat-card bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Total Users</h5>
                            <h2 class="mb-0">1,234</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Revenue</h5>
                            <h2 class="mb-0">$5,678</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card bg-warning text-white">
                        <div class="card-body">
                            <h5 class="card-title">Orders</h5>
                            <h2 class="mb-0">892</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card stat-card bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Products</h5>
                            <h2 class="mb-0">156</h2>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="mb-1">New user registered</h6>
                                    <small class="text-muted">John Doe</small>
                                </div>
                                <small class="text-muted">5 mins ago</small>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="mb-1">New order received</h6>
                                    <small class="text-muted">Order #12345</small>
                                </div>
                                <small class="text-muted">15 mins ago</small>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="mb-1">Server update completed</h6>
                                    <small class="text-muted">System update v2.1</small>
                                </div>
                                <small class="text-muted">1 hour ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Add your authentication logic here
    document.querySelector('.login-container').style.display = 'none';
    document.querySelector('.dashboard-container').style.display = 'block';
});

document.getElementById('logoutBtn').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('.login-container').style.display = 'flex';
    document.querySelector('.dashboard-container').style.display = 'none';
});

document.getElementById('dropdownLogout').addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector('.login-container').style.display = 'flex';
    document.querySelector('.dashboard-container').style.display = 'none';
});
</script>
</body>
</html>