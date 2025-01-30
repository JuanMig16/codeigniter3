<!-- application/views/oauth/task_results.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Results</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .task-list-item {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .task-list-item:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .task-list-item hr {
            margin: 10px 0;
        }
        .status-summary ul {
            list-style-type: none;
            padding-left: 0;
        }
        .status-summary li {
            font-size: 1.1rem;
            margin-bottom: 8px;
        }
        .status-summary li strong {
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="text-center mb-4">
            <h2>Task Results</h2>
            <p class="lead">Here you can find the detailed summary of tasks and their statuses.</p>
        </div>

        <!-- Status Summary -->
        <?php if (isset($status_count)): ?>
            <div class="status-summary mb-5">
                <h3>Status Summary</h3>
                <ul class="list-group">
                    <?php foreach ($status_count as $status => $count): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong><?= ucfirst(htmlspecialchars($status)) ?>:</strong>
                            <span class="badge bg-primary rounded-pill"><?= htmlspecialchars($count) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <!-- Fetched Tasks -->
        <?php if (isset($data['tasks']) && !empty($data['tasks'])): ?>
            <div class="mb-5">
                <h3>Fetched Tasks</h3>
                <?php foreach ($data['tasks'] as $task): ?>
                    <div class="task-list-item">
                        <p><strong>Task ID:</strong> <?= htmlspecialchars($task['task_id'] ?? 'N/A') ?></p>
                        <p><strong>File Name:</strong> <?= htmlspecialchars($task['file_name'] ?? 'N/A') ?></p>
                        <p><strong>Sign Type:</strong> <?= htmlspecialchars($task['sign_type'] ?? 'N/A') ?></p>
                        <p><strong>Status:</strong> <?= htmlspecialchars($task['status'] ?? 'N/A') ?></p>
                        <p><strong>Has Order:</strong> <?= htmlspecialchars($task['has_order'] ? 'Yes' : 'No') ?></p>
                        <p><strong>Owned By Me:</strong> <?= htmlspecialchars($task['owned_by_me'] ? 'Yes' : 'No') ?></p>
                        <p><strong>Last Modified By Owner:</strong> <?= htmlspecialchars($task['last_modified_by_owner'] ? 'Yes' : 'No') ?></p>
                        <hr>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif (isset($data['error'])): ?>
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?= htmlspecialchars($data['error']) ?>
            </div>
        <?php endif; ?>

        <div class="text-center">
            <a href="<?= site_url('Oauth/get_task_form') ?>" class="btn btn-primary">
                <i class="bi bi-arrow-left me-2"></i>Back to Form
            </a>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
