<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fe;
        }
        
        .accordion-item {
            border: none;
            border-radius: 12px !important;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .accordion-button {
            padding: 1rem 1.5rem;
            background: white;
            border: none;
        }

        .accordion-button:not(.collapsed) {
            background: linear-gradient(45deg, #4e73df, #3a54c4);
            color: white;
        }

        .accordion-button:focus {
            box-shadow: none;
        }

        .header-card {
            background: linear-gradient(45deg, #4e73df, #3a54c4);
            color: white;
            border: none;
            border-radius: 12px;
        }

        .custom-badge {
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
        }

        .list-group-item {
            border: 1px solid rgba(0,0,0,.125);
            margin-bottom: 0.5rem;
            border-radius: 8px !important;
            transition: all 0.3s ease;
        }

        .list-group-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .template-info-table td {
            padding: 0.75rem 1rem;
        }

        .back-btn {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .stage-badge {
            background: linear-gradient(45deg, #36b9cc, #2a96a5);
            color: white;
            border: none;
        }

        .status-active {
            background: linear-gradient(45deg, #1cc88a, #169b6b);
            color: white;
        }

        .status-inactive {
            background: linear-gradient(45deg, #858796, #6e6f7a);
            color: white;
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #4e73df;
            margin-bottom: 1.2rem;
            position: relative;
        }

        .section-title:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 40px;
            height: 3px;
            background: linear-gradient(45deg, #4e73df, #3a54c4);
            border-radius: 2px;
        }

        .cc-recipient-card {
            background: #fff;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 0.5rem;
            border: 1px solid rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        .cc-recipient-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .accordion-button::after {
            background-color: rgba(255,255,255,0.2);
            border-radius: 50%;
            padding: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-xl-10">
                <?php if (isset($templates_data) && isset($templates_data['data']) && isset($templates_data['data']['templates'])): ?>
                    <!-- Header Section -->
                    <div class="card header-card mb-4 shadow-lg">
                        <div class="card-body py-4">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h2 class="mb-0 fw-bold">Templates Overview</h2>
                                </div>
                                <div class="col-auto">
                                    <span class="custom-badge bg-white text-primary">
                                        <?php echo count($templates_data['data']['templates']); ?> Templates
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Templates Accordion -->
                    <div class="accordion" id="templatesAccordion">
                        <?php foreach ($templates_data['data']['templates'] as $index => $template): ?>
                            <div class="accordion-item mb-3 shadow">
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
                                            <span class="custom-badge <?php echo $template['status'] === 'active' ? 'status-active' : 'status-inactive'; ?> ms-2">
                                                <?php echo ucfirst(htmlspecialchars($template['status'] ?? 'Unknown')); ?>
                                            </span>
                                        </div>
                                    </button>
                                </h2>
                                <div id="template<?php echo $index; ?>" 
                                     class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>" 
                                     data-bs-parent="#templatesAccordion">
                                    <div class="accordion-body bg-white p-4">
                                        <div class="row g-4">
                                            <!-- Template Details -->
                                            <div class="col-md-6">
                                                <h6 class="section-title">Template Information</h6>
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-borderless template-info-table">
                                                        <tr>
                                                            <td class="text-muted" style="width: 140px;">Template ID:</td>
                                                            <td class="fw-medium"><?php echo htmlspecialchars($template['template_id'] ?? 'N/A'); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Created:</td>
                                                            <td class="fw-medium"><?php echo date('M d, Y H:i', $template['created_at'] ?? 0); ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-muted">Last Modified:</td>
                                                            <td class="fw-medium"><?php echo $template['last_modified_at'] ? date('M d, Y H:i', $template['last_modified_at']) : 'Never'; ?></td>
                                                        </tr>
                                                    </table>
                                                </div>

                                                <?php if (!empty($template['template_setting']['message'])): ?>
                                                    <h6 class="section-title mt-4">Template Message</h6>
                                                    <p class="mb-0 ps-3 border-start border-primary"><?php echo htmlspecialchars($template['template_setting']['message']); ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Signing Sequence -->
                                            <div class="col-md-6">
                                                <h6 class="section-title">Signing Sequence</h6>
                                                <?php if (!empty($template['details'])): ?>
                                                    <div class="list-group">
                                                        <?php foreach ($template['details'] as $detail): ?>
                                                            <div class="list-group-item border-0 shadow-sm">
                                                                <div class="d-flex justify-content-between align-items-center">
                                                                    <h6 class="mb-0 fw-bold"><?php echo htmlspecialchars($detail['role'] ?? 'Unnamed Role'); ?></h6>
                                                                    <span class="badge stage-badge">Step <?php echo htmlspecialchars($detail['sequence']); ?></span>
                                                                </div>
                                                                <small class="text-muted d-block mt-1">
                                                                    <i class="bi bi-arrow-right-circle me-1"></i>
                                                                    <?php echo ucfirst(htmlspecialchars($detail['stage_type'])); ?>
                                                                </small>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                <?php else: ?>
                                                    <p class="text-muted">No signing sequence defined</p>
                                                <?php endif; ?>

                                                <!-- CC Information -->
                                                <?php if (!empty($template['template_setting']['cc_infos'])): ?>
                                                    <h6 class="section-title mt-4">CC Recipients</h6>
                                                    <?php foreach ($template['template_setting']['cc_infos'] as $cc): ?>
                                                        <div class="cc-recipient-card">
                                                            <div class="d-flex align-items-center">
                                                                <i class="bi bi-envelope-fill me-2 text-primary"></i>
                                                                <div>
                                                                    <div class="fw-bold"><?php echo htmlspecialchars($cc['name']); ?></div>
                                                                    <div class="small text-muted"><?php echo htmlspecialchars($cc['email']); ?></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                <?php else: ?>
                    <div class="alert alert-warning shadow-sm">
                        <h4 class="alert-heading">No Data Available</h4>
                        <p class="mb-0">No templates were found or the data structure is incorrect.</p>
                    </div>
                <?php endif; ?>

                <!-- Back Button -->
                <div class="text-center mt-4">
                    <a href="<?php echo site_url('Oauth/get_template_form'); ?>" class="btn btn-primary back-btn">
                        <i class="bi bi-arrow-left me-2"></i>Back to Form
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>