<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Document Management System' ?></title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="<?= site_url('main') ?>">
                <i class="bi bi-file-earmark-text"></i>
                Document Management System
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Oauth/create_token') ?>">Generate Token</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Oauth/create_task') ?>">Create Task</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Oauth/get_task') ?>">View Tasks</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('Oauth/get_template') ?>">Templates</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Get Task Data</h2>
                    </div>
                    <div class="card-body">
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($this->session->flashdata('error')); ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('Oauth/get_task') ?>" method="POST">
                            <div class="mb-3">
                                <label for="access_token" class="form-label">Enter Access Token</label>
                                <input type="text" class="form-control" id="access_token" name="access_token" required>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Choose a Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="waiting">Waiting</option>
                                    <option value="draft">Draft</option>
                                    <option value="completed">Completed</option>
                                    <option value="declined">Declined</option>
                                    <option value="voided">Voided</option>
                                    <option value="expired">Expired</option>
                                </select>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Get Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-primary text-white py-4">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6 text-md-start mb-2 mb-md-0">
                    <p class="mb-0">&copy; <?= date('Y') ?> Document Management System. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white me-3 text-decoration-none">Privacy Policy</a>
                    <a href="#" class="text-white text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS (Optional for functionality) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
