<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Document Management System' ?></title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
</head>
<body>
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