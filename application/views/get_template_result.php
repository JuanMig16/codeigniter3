<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <?php if (isset($templates_data) && isset($templates_data['data']) && isset($templates_data['data']['templates'])): ?>
                    <!-- Header Section -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h2 class="mb-0">Templates Overview</h2>
                                </div>
                                <div class="col-auto">
                                    <span class="badge bg-primary fs-6">
                                        Total Templates: <?php echo count($templates_data['data']['templates']); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Templates Accordion -->
                    <div class="accordion" id="templatesAccordion">
                        <?php foreach ($templates_data['data']['templates'] as $index => $template): ?>
                            <div class="accordion-item mb-3 shadow-sm">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?php echo $index !== 0 ? 'collapsed' : ''; ?>" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#template<?php echo $index; ?>">
                                        <div class="d-flex align-items-center justify-content-between w-100 me-3">
                                            <div>
                                                <i class="bi bi-file-earmark-text me-2"></i>
                                                <?php echo htmlspecialchars($template['file_name'] ?? 'Untitled'); ?>
                                            </div>
                                            <span class="badge <?php echo $template['status'] === 'active' ? 'bg-success' : 'bg-secondary'; ?> ms-2">
                                                <?php echo ucfirst(htmlspecialchars($template['status'] ?? 'Unknown')); ?>
                                            </span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="template<?php echo $index; ?>" 
                                     class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" 
                                     data-bs-parent="#templatesAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-4">
                                            <!-- Template Details -->
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <h6 class="text-muted mb-3">Template Information</h6>
                                                    <div class="table-responsive">
                                                        <table class="table table-sm table-borderless">
                                                            <tr>
                                                                <td class="text-muted" style="width: 140px;">Template ID:</td>
                                                                <td><?php echo htmlspecialchars($template['template_id'] ?? 'N/A'); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Created:</td>
                                                                <td><?php echo date('M d, Y H:i', $template['created_at'] ?? 0); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td class="text-muted">Last Modified:</td>
                                                                <td><?php echo $template['last_modified_at'] ? date('M d, Y H:i', $template['last_modified_at']) : 'Never'; ?></td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>

                                                <?php if (!empty($template['template_setting']['message'])): ?>
                                                    <div class="mb-4">
                                                        <h6 class="text-muted mb-2">Template Message</h6>
                                                        <p class="mb-0"><?php echo htmlspecialchars($template['template_setting']['message']); ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Signing Sequence -->
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <h6 class="text-muted mb-3">Signing Sequence</h6>
                                                    <?php if (!empty($template['details'])): ?>
                                                        <div class="list-group">
                                                            <?php foreach ($template['details'] as $detail): ?>
                                                                <div class="list-group-item">
                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                        <h6 class="mb-0"><?php echo htmlspecialchars($detail['role'] ?? 'Unnamed Role'); ?></h6>
                                                                        <span class="badge bg-info">Step <?php echo htmlspecialchars($detail['sequence']); ?></span>
                                                                    </div>
                                                                    <small class="text-muted">
                                                                        <?php echo ucfirst(htmlspecialchars($detail['stage_type'])); ?>
                                                                    </small>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <p class="text-muted">No signing sequence defined</p>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- CC Information -->
                                                <?php if (!empty($template['template_setting']['cc_infos'])): ?>
                                                    <div>
                                                        <h6 class="text-muted mb-3">CC Recipients</h6>
                                                        <div class="list-group">
                                                            <?php foreach ($template['template_setting']['cc_infos'] as $cc): ?>
                                                                <div class="list-group-item">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="bi bi-envelope me-2"></i>
                                                                        <div>
                                                                            <div class="fw-bold"><?php echo htmlspecialchars($cc['name']); ?></div>
                                                                            <div class="small text-muted"><?php echo htmlspecialchars($cc['email']); ?></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php else: ?>
                    <div class="alert alert-warning">
                        <h4 class="alert-heading">No Data Available</h4>
                        <p class="mb-0">No templates were found or the data structure is incorrect.</p>
                    </div>
                <?php endif; ?>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="<?php echo site_url('Oauth/get_template_form'); ?>" class="btn btn-primary">
                        <i class="bi bi-arrow-left me-2"></i>Back to Form
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>