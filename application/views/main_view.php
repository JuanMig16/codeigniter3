<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Management System</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/style.css') ?>" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= site_url('main') ?>">
                <i class="bi bi-file-earmark-text"></i>
                Document Management System
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row justify-content-center mb-5">
            <div class="col-12 text-center">
                <h1 class="display-4 mb-4">Document Management System</h1>
                <p class="lead">Welcome to our comprehensive document management solution</p>
            </div>
        </div>

        <div class="row g-4">
            <!-- Access Token -->
            <div class="col-md-4">
                <a href="<?= site_url('Oauth/create_token') ?>" class="text-decoration-none">
                    <div class="card main-menu-card">
                        <div class="card-body text-center">
                            <i class="bi bi-key-fill main-menu-icon"></i>
                            <h4>Generate Token</h4>
                            <p class="text-muted">Create access tokens for authentication</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Create Task -->
            <div class="col-md-4">
                <a href="<?= site_url('Oauth/create_task') ?>" class="text-decoration-none">
                    <div class="card main-menu-card">
                        <div class="card-body text-center">
                            <i class="bi bi-plus-circle-fill main-menu-icon"></i>
                            <h4>Create Task</h4>
                            <p class="text-muted">Create new document tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- View Tasks -->
            <div class="col-md-4">
                <a href="<?= site_url('Oauth/get_task') ?>" class="text-decoration-none">
                    <div class="card main-menu-card">
                        <div class="card-body text-center">
                            <i class="bi bi-list-check main-menu-icon"></i>
                            <h4>View Tasks</h4>
                            <p class="text-muted">View and manage existing tasks</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Read Task -->
            <div class="col-md-4">
                <a href="<?= site_url('Oauth/read_task') ?>" class="text-decoration-none">
                    <div class="card main-menu-card">
                        <div class="card-body text-center">
                            <i class="bi bi-file-text-fill main-menu-icon"></i>
                            <h4>Read Task</h4>
                            <p class="text-muted">View detailed task information</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Templates -->
            <div class="col-md-4">
                <a href="<?= site_url('Oauth/get_template') ?>" class="text-decoration-none">
                    <div class="card main-menu-card">
                        <div class="card-body text-center">
                            <i class="bi bi-file-earmark-fill main-menu-icon"></i>
                            <h4>Templates</h4>
                            <p class="text-muted">Manage document templates</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>