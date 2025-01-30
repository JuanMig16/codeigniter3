<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Trail Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 2rem;
        }
        .event-card {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            transition: all 0.3s ease;
        }
        .event-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }
        .event-badge {
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .event-viewed { background-color: #e3f2fd; color: #0d47a1; }
        .event-signed { background-color: #e8f5e9; color: #1b5e20; }
        .event-sent { background-color: #fff3e0; color: #e65100; }
        .event-created { background-color: #f3e5f5; color: #4a148c; }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Summary Section -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Total Events</h6>
                        <h2 class="mb-0"><?= number_format($data['data']['total_count']) ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Current Page</h6>
                        <h2 class="mb-0"><?= number_format($data['data']['current_page']) ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h6 class="text-muted mb-2">Total Pages</h6>
                        <h2 class="mb-0"><?= number_format($data['data']['total_pages']) ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Events Timeline -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">
                    <i class="bi bi-clock-history me-2"></i>
                    Event Timeline
                </h4>
            </div>
            <div class="card-body">
                <?php if (isset($data['data']['events']) && !empty($data['data']['events'])): ?>
                    <?php foreach ($data['data']['events'] as $event): ?>
                        <div class="event-card">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <span class="event-badge event-<?= strtolower($event['action_name']) ?>">
                                        <i class="bi bi-activity me-2"></i>
                                        <?= ucfirst(htmlspecialchars($event['action_name'])) ?>
                                    </span>
                                    <div class="mt-3">
                                        <p class="mb-2">
                                            <i class="bi bi-person me-2"></i>
                                            <strong>Role:</strong> <?= htmlspecialchars($event['role']) ?>
                                        </p>
                                        <p class="mb-2">
                                            <i class="bi bi-building me-2"></i>
                                            <strong>Client:</strong> <?= htmlspecialchars($event['client']) ?>
                                        </p>
                                        <p class="mb-2">
                                            <i class="bi bi-globe me-2"></i>
                                            <strong>User Agent:</strong> <?= htmlspecialchars($event['user_agent']) ?>
                                        </p>
                                        <p class="mb-0">
                                            <i class="bi bi-geo-alt me-2"></i>
                                            <strong>IP Address:</strong> <?= htmlspecialchars($event['ip_address']) ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        <?= date('Y-m-d H:i:s', $event['created_at']) ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <!-- Pagination -->
                    <?php if ($data['data']['total_pages'] > 1): ?>
                        <div class="pagination-container mt-4">
                            <form action="<?= site_url('get_audit_trail_result') ?>" method="POST" class="d-none" id="pageForm">
                                <input type="hidden" name="access_token" value="<?= htmlspecialchars($this->input->post('access_token')); ?>">
                                <input type="hidden" name="task_id" value="<?= htmlspecialchars($this->input->post('task_id')); ?>">
                                <input type="hidden" name="page" id="pageInput" value="1">
                            </form>
                            
                            <nav aria-label="Event pages">
                                <ul class="pagination justify-content-center mb-0">
                                    <!-- Previous Page -->
                                    <li class="page-item <?= ($data['data']['current_page'] <= 1) ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="#" onclick="changePage(<?= $data['data']['current_page'] - 1 ?>)">
                                            <i class="bi bi-chevron-left"></i>
                                        </a>
                                    </li>
                                    
                                    <!-- Page Numbers -->
                                    <?php 
                                    $start = max(1, $data['data']['current_page'] - 2);
                                    $end = min($data['data']['total_pages'], $start + 4);
                                    $start = max(1, $end - 4);
                                    
                                    for ($i = $start; $i <= $end; $i++): 
                                    ?>
                                        <li class="page-item <?= ($i == $data['data']['current_page']) ? 'active' : ''; ?>">
                                            <a class="page-link" href="#" onclick="changePage(<?= $i ?>)"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    
                                    <!-- Next Page -->
                                    <li class="page-item <?= ($data['data']['current_page'] >= $data['data']['total_pages']) ? 'disabled' : ''; ?>">
                                        <a class="page-link" href="#" onclick="changePage(<?= $data['data']['current_page'] + 1 ?>)">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>

                <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        <i class="bi bi-info-circle me-2"></i>
                        No events found for this task.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Pagination Script -->
    <script>
        function changePage(page) {
            document.getElementById('pageInput').value = page;
            document.getElementById('pageForm').submit();
        }
    </script>
</body>
</html>