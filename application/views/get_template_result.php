<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Results</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Template Results</h2>
                    </div>
                    <div class="card-body">
                        <?php if (isset($data['data']) && !empty($data['data']['templates'])): ?>
                            <div class="mb-4">
                                <h4>Templates List</h4>
                                <p>Total Count: <?= htmlspecialchars($data['data']['total_count']); ?></p>
                                <p>Page: <?= htmlspecialchars($data['data']['current_page']); ?> of <?= htmlspecialchars($data['data']['total_pages']); ?></p>
                            </div>

                            <div class="accordion" id="templatesAccordion">
                                <?php foreach ($data['data']['templates'] as $index => $template): ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading<?= $index; ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $index; ?>" aria-expanded="false" aria-controls="collapse<?= $index; ?>">
                                                Template ID: <?= htmlspecialchars($template['template_id'] ?? 'N/A'); ?> - <?= htmlspecialchars($template['file_name'] ?? 'N/A'); ?>
                                            </button>
                                        </h2>
                                        <div id="collapse<?= $index; ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $index; ?>" data-bs-parent="#templatesAccordion">
                                            <div class="accordion-body">
                                                <p><strong>Has Order:</strong> <?= htmlspecialchars($template['has_order'] ? 'Yes' : 'No'); ?></p>
                                                <p><strong>Status:</strong> <?= htmlspecialchars($template['status'] ?? 'N/A'); ?></p>

                                                <h5>Access Information</h5>
                                                <ul>
                                                    <li>View: <?= htmlspecialchars($template['access_info']['view'] ? 'Yes' : 'No'); ?></li>
                                                    <li>Update: <?= htmlspecialchars($template['access_info']['update'] ? 'Yes' : 'No'); ?></li>
                                                    <li>Delete: <?= htmlspecialchars($template['access_info']['delete'] ? 'Yes' : 'No'); ?></li>
                                                    <li>Group Share: <?= htmlspecialchars($template['access_info']['group_share'] ? 'Yes' : 'No'); ?></li>
                                                </ul>

                                                <h5>Stages</h5>
                                                <?php if (!empty($template['details'])): ?>
                                                    <ul>
                                                        <?php foreach ($template['details'] as $stage): ?>
                                                            <li>
                                                                <p>Stage ID: <?= htmlspecialchars($stage['stage_id'] ?? 'N/A'); ?></p>
                                                                <p>Sequence: <?= htmlspecialchars($stage['sequence'] ?? 'N/A'); ?></p>
                                                                <p>Status: <?= htmlspecialchars($stage['status'] ?? 'N/A'); ?></p>
                                                                <p>Type: <?= htmlspecialchars($stage['stage_type'] ?? 'N/A'); ?></p>
                                                                <p>Role: <?= htmlspecialchars($stage['role'] ?? 'N/A'); ?></p>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>

                                                <h5>Template Settings</h5>
                                                <p>Deadline: <?= htmlspecialchars(date('Y-m-d H:i:s', $template['template_setting']['deadline']) ?? 'N/A'); ?></p>
                                                <p>Language: <?= htmlspecialchars($template['template_setting']['receiver_lang'] ?? 'N/A'); ?></p>
                                                <p>Expires in Days: <?= htmlspecialchars($template['template_setting']['expires_in_days'] ?? 'N/A'); ?></p>
                                                <p>Message: <?= htmlspecialchars($template['template_setting']['message'] ?? 'N/A'); ?></p>
                                                <p><strong>Created At:</strong> <?= htmlspecialchars(date('Y-m-d H:i:s', $template['created_at']) ?? 'N/A'); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                        <?php elseif (isset($data['error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= htmlspecialchars($data['error'] ?? 'An error occurred'); ?>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info" role="alert">
                                No templates found.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
