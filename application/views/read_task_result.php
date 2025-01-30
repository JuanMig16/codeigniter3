<?php
// Assuming $data contains the results (either the task data or an error message)
if (isset($data['data'])) {
    $taskData = $data['data'];
    $error = null;
} else {
    $taskData = null;
    $error = $data['error'] ?? 'No data available.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php $this->load->view('templates/header', ['title' => 'Task Detail Dashboard']); ?>
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
    <?php $this->load->view('templates/header', ['title' => 'Your Page Title']); ?>

    <div class="container py-5">
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?= htmlspecialchars($error); ?>
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
                                        <td><?= htmlspecialchars($taskData['task_id'] ?? 'N/A'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>File Name</th>
                                        <td><?= htmlspecialchars($taskData['file_name'] ?? 'N/A'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Sign Type</th>
                                        <td><span class="badge bg-info"><?= htmlspecialchars($taskData['sign_type'] ?? 'N/A'); ?></span></td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td><span class="badge bg-success"><?= htmlspecialchars($taskData['status'] ?? 'N/A'); ?></span></td>
                                    </tr>
                                    <tr>
                                        <th>Created At</th>
                                        <td><?= htmlspecialchars(date('Y-m-d H:i:s', $taskData['created_at']) ?? 'N/A'); ?></td>
                                    </tr>
                                    <tr>
                                        <th>Last Modified</th>
                                        <td><?= htmlspecialchars(date('Y-m-d H:i:s', $taskData['last_modified_at']) ?? 'N/A'); ?></td>
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
                                <?php foreach ($taskData['access_info'] as $key => $value): ?>
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
                                            <p class="mb-0"><?= htmlspecialchars($taskData['task_setting']['receiver_lang'] ?? 'N/A'); ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-bell fs-3 text-primary"></i>
                                            <h6 class="mt-2">Forget Remind</h6>
                                            <p class="mb-0"><?= $taskData['task_setting']['forget_remind'] ? 'Enabled' : 'Disabled' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-clock fs-3 text-primary"></i>
                                            <h6 class="mt-2">Expire Remind</h6>
                                            <p class="mb-0"><?= $taskData['task_setting']['expire_remind'] ? 'Enabled' : 'Disabled' ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body text-center">
                                            <i class="bi bi-calendar-event fs-3 text-primary"></i>
                                            <h6 class="mt-2">Deadline</h6>
                                            <p class="mb-0">
                                                <?= $taskData['task_setting']['deadline'] ? 
                                                    htmlspecialchars(date('Y-m-d H:i:s', $taskData['task_setting']['deadline'])) : 
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
                <?php if (!empty($taskData['details'])): ?>
                <div class="col-md-12 mb-4">
                    <div class="card task-card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-diagram-3 me-2"></i>Task Stages</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php foreach ($taskData['details'] as $index => $detail): ?>
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
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
