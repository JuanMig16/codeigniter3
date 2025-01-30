<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Trail - Search</title>
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 2rem;
        }
        .task-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        .task-card:hover {
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
        .error-message {
            animation: fadeIn 0.5s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <div class="form-container">
            <?php if (isset($data['error'])): ?>
                <div class="alert alert-danger error-message mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= htmlspecialchars($data['error']); ?>
                </div>
            <?php endif; ?>

            <div class="card task-card">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">
                        <i class="bi bi-search me-2"></i>
                        Search Audit Trails
                    </h4>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('get_audit_trail_result') ?>" method="POST" class="needs-validation" novalidate>
                        <div class="mb-4">
                            <label for="access_token" class="form-label">Access Token</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-key-fill"></i>
                                </span>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="access_token" 
                                    name="access_token" 
                                    value="<?= htmlspecialchars($this->input->post('access_token') ?? ''); ?>"
                                    required
                                    autocomplete="off"
                                >
                                <div class="invalid-feedback">
                                    Please provide a valid access token.
                                </div>
                            </div>
                            <small class="text-muted">
                                Enter your API access token for authentication.
                            </small>
                        </div>
                        
                        <div class="mb-4">
                            <label for="task_id" class="form-label">Task ID</label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-hash"></i>
                                </span>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="task_id" 
                                    name="task_id" 
                                    value="<?= htmlspecialchars($this->input->post('task_id') ?? ''); ?>"
                                    required
                                    pattern="[a-zA-Z0-9-_]+"
                                >
                                <div class="invalid-feedback">
                                    Please provide a valid task ID.
                                </div>
                            </div>
                            <small class="text-muted">
                                Enter the task ID to retrieve its audit trail.
                            </small>
                        </div>

                        <div class="mb-4">
                            <label for="page" class="form-label">Page: </label>
                            <div class="input-group">
                                <span class="input-group-text">
                                    <i class="bi bi-hash"></i>
                                </span>
                                <input 
                                    type="text" 
                                    class="form-control" 
                                    id="page" 
                                    name="page" 
                                    value="<?= htmlspecialchars($this->input->post('page') ?? ''); ?>"
                                    required
                                    pattern="[a-zA-Z0-9-_]+"
                                >
                                <div class="invalid-feedback">
                                    Please provide a valid number.
                                </div>
                            </div>
                            <small class="text-muted">
                                Enter a page number.
                            </small>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search me-2"></i>
                            Search Audit Trail
                        </button>
                    </form>
                </div>
            </div>

            <?php if (isset($data['data'])): ?>
                <div class="mt-4">
                    <div class="card task-card">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-check-circle me-2"></i>
                                Search Results
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Add your results display here -->
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap 5.3 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Form Validation Script -->
    <script>
        (function() {
            'use strict';

            const forms = document.querySelectorAll('.needs-validation');
            
            Array.prototype.slice.call(forms).forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
</body>
</html>