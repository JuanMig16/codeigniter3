<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->load->view('templates/header', ['title' => 'Your Page Title']); ?>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .task-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .task-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .stage-card {
            border-left: 4px solid #0d6efd;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-file-earmark-text me-2"></i>
                Task Management System
            </a>
        </div>
    </nav> -->

    <div class="container py-5">
        <?php if (!isset($data['data'])): ?>
            <div class="form-container">
                <div class="card task-card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="bi bi-search me-2"></i>Read Task Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('Oauth/read_task') ?>" method="POST" class="needs-validation" novalidate>
                            <div class="mb-3">
                                <label for="access_token" class="form-label">Access Token</label>
                                <input type="text" class="form-control" id="access_token" name="access_token" required>
                                <div class="invalid-feedback">Please provide an access token.</div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="task_id" class="form-label">Task ID</label>
                                <input type="text" class="form-control" id="task_id" name="task_id" required>
                                <div class="invalid-feedback">Please provide a task ID.</div>
                            </div>
                            
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-search me-2"></i>Retrieve Task Details
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <?php if (isset($data['error'])): ?>
                <div class="alert alert-danger" role="alert">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    <?= htmlspecialchars($data['error'] ?? 'An error occurred'); ?>
                </div>
            <?php else: ?>
                <div class="row">
                    <!-- Basic Information Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card task-card h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Basic Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-borderless">
                                        <tr>
                                            <th width="40%">Task ID</th>
                                            <td><?= htmlspecialchars($data['data']['task_id'] ?? 'N/A'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>File Name</th>
                                            <td><?= htmlspecialchars($data['data']['file_name'] ?? 'N/A'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Sign Type</th>
                                            <td><span class="badge bg-info"><?= htmlspecialchars($data['data']['sign_type'] ?? 'N/A'); ?></span></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td><span class="badge bg-success"><?= htmlspecialchars($data['data']['status'] ?? 'N/A'); ?></span></td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td><?= htmlspecialchars(date('Y-m-d H:i:s', $data['data']['created_at']) ?? 'N/A'); ?></td>
                                        </tr>
                                        <tr>
                                            <th>Last Modified</th>
                                            <td><?= htmlspecialchars(date('Y-m-d H:i:s', $data['data']['last_modified_at']) ?? 'N/A'); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Access Information Card -->
                    <div class="col-md-6 mb-4">
                        <div class="card task-card h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-shield-check me-2"></i>Access Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <?php foreach ($data['data']['access_info'] as $key => $value): ?>
                                        <div class="list-group-item d-flex justify-content-between align-items-center">
                                            <span><?= htmlspecialchars(ucwords(str_replace('_', ' ', $key))); ?></span>
                                            <span class="badge bg-<?= $value ? 'success' : 'danger' ?> rounded-pill">
                                                <?= $value ? 'Yes' : 'No' ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Task Settings Card -->
                    <div class="col-md-12 mb-4">
                        <div class="card task-card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-gear me-2"></i>Task Settings</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="bi bi-globe fs-3 text-primary"></i>
                                                <h6 class="mt-2">Receiver Language</h6>
                                                <p class="mb-0"><?= htmlspecialchars($data['data']['task_setting']['receiver_lang'] ?? 'N/A'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="bi bi-bell fs-3 text-primary"></i>
                                                <h6 class="mt-2">Forget Remind</h6>
                                                <p class="mb-0"><?= $data['data']['task_setting']['forget_remind'] ? 'Enabled' : 'Disabled' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="bi bi-clock fs-3 text-primary"></i>
                                                <h6 class="mt-2">Expire Remind</h6>
                                                <p class="mb-0"><?= $data['data']['task_setting']['expire_remind'] ? 'Enabled' : 'Disabled' ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <div class="card h-100">
                                            <div class="card-body text-center">
                                                <i class="bi bi-calendar-event fs-3 text-primary"></i>
                                                <h6 class="mt-2">Deadline</h6>
                                                <p class="mb-0">
                                                    <?= $data['data']['task_setting']['deadline'] ? 
                                                        htmlspecialchars(date('Y-m-d H:i:s', $data['data']['task_setting']['deadline'])) : 
                                                        'No Deadline' ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stages Card -->
                    <?php if (!empty($data['data']['details'])): ?>
                    <div class="col-md-12 mb-4">
                        <div class="card task-card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0"><i class="bi bi-diagram-3 me-2"></i>Task Stages</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <?php foreach ($data['data']['details'] as $index => $detail): ?>
                                        <div class="col-md-6 mb-4">
                                            <div class="card stage-card">
                                                <div class="card-body">
                                                    <h6 class="card-title">
                                                        <i class="bi bi-person-circle me-2"></i>
                                                        Stage <?= $index + 1 ?>
                                                    </h6>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm">
                                                            <tr>
                                                                <th width="30%">Name</th>
                                                                <td><?= htmlspecialchars($detail['name'] ?? 'N/A'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <td><?= htmlspecialchars($detail['email'] ?? 'N/A'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Sequence</th>
                                                                <td><?= htmlspecialchars($detail['sequence'] ?? 'N/A'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Status</th>
                                                                <td>
                                                                    <span class="badge bg-info">
                                                                        <?= htmlspecialchars($detail['status'] ?? 'N/A'); ?>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                    <?php if (!empty($detail['field_settings'])): ?>
                                                        <div class="mt-3">
                                                            <h6 class="card-subtitle mb-2 text-muted">Field Settings</h6>
                                                            <?php foreach ($detail['field_settings'] as $field): ?>
                                                                <div class="card bg-light mb-2">
                                                                    <div class="card-body py-2">
                                                                        <small class="d-block">
                                                                            <strong>Type:</strong> 
                                                                            <?= htmlspecialchars($field['field_type'] ?? 'N/A'); ?>
                                                                        </small>
                                                                        <small class="d-block">
                                                                            <strong>Page:</strong> 
                                                                            <?= htmlspecialchars($field['page'] ?? 'N/A'); ?>
                                                                        </small>
                                                                        <small class="d-block">
                                                                            <strong>Coordinates:</strong> 
                                                                            <?= htmlspecialchars(implode(', ', $field['coord']) ?? 'N/A'); ?>
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="<?= site_url('Oauth/read_task') ?>" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Search
                    </a>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Form Validation Script -->
    <script>
        // Enable Bootstrap form validation
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>
</html>