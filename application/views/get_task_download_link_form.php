<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get The Task Download Link</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Get The Task Download Link</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('Oauth/get_task_download_link') ?>" method="POST" onsubmit="clearResult()">
                            <div class="mb-3">
                                <label for="access_token" class="form-label">Access Token:</label>
                                <input type="text" class="form-control" id="access_token" name="access_token" required>
                            </div>
                            <div class="mb-3">
                                <label for="task_id" class="form-label">Task ID:</label>
                                <input type="text" class="form-control" name="task_id" required>
                            </div>
                            <div class="mb-3">
                                <label for="file_type" class="form-label">File Type:</label>
                                <select class="form-select form-select-md" name="file_type" required>
                                    <option value="task">Task</option>
                                    <option value="attachment">Attachment</option>
                                    <option value="attachment_compressed">Attachment Compressed</option>
                                    <option value="audit_trail">Audit Trail</option>
                                </select>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Get The Task Download Link</button>
                            </div>
                        </form>
                        <!-- Display Result -->
                        <div id="result">
                            <!-- Task Section -->
                            <?php if ($this->session->flashdata('task')): ?>
                                <div class="mt-3">
                                    <strong>Task:</strong>
                                    <div class="input-group mt-2">
                                        <input type="text" class="form-control" id="task" value="<?= htmlspecialchars($this->session->flashdata('task')); ?>" readonly>
                                        <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('task')">Copy</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- Attachment Section -->
                            <?php if ($this->session->flashdata('attachment')): ?>
                                <div class="mt-3">
                                    <strong>Attachment:</strong>
                                    <div class="input-group mt-2">
                                        <input type="text" class="form-control" id="attachment" value="<?= htmlspecialchars($this->session->flashdata('attachment')); ?>" readonly>
                                        <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('attachment')">Copy</button>
                                    </div>
                                    <a href="<?= htmlspecialchars($this->session->flashdata('attachment')); ?>" target="_blank" class="mt-2">View Attachment</a>
                                </div>
                            <?php endif; ?>
                            <!-- Compressed Attachment Section -->
                            <?php if ($this->session->flashdata('attachment_compressed')): ?>
                                <div class="mt-3">
                                    <strong>Compressed Attachment:</strong>
                                    <div class="input-group mt-2">
                                        <input type="text" class="form-control" id="attachment_compressed" value="<?= htmlspecialchars($this->session->flashdata('attachment_compressed')); ?>" readonly>
                                        <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('attachment_compressed')">Copy</button>
                                    </div>
                                    <a href="<?= htmlspecialchars($this->session->flashdata('attachment_compressed')); ?>" target="_blank" class="mt-2">Download Compressed File</a>
                                </div>
                            <?php endif; ?>
                            <!-- Audit Trail Section -->
                            <?php if ($this->session->flashdata('audit_trail')): ?>
                                <div class="mt-3">
                                    <strong>Audit Trail:</strong>
                                    <div class="input-group mt-2">
                                        <input type="text" class="form-control" id="audit_trail" value="<?= htmlspecialchars($this->session->flashdata('audit_trail')); ?>" readonly>
                                        <button class="btn btn-sm btn-secondary" onclick="copyToClipboard('audit_trail')">Copy</button>
                                    </div>
                                    <p class="mt-2"><?= htmlspecialchars($this->session->flashdata('audit_trail')); ?></p>
                                </div>
                            <?php endif; ?>
                            <!-- Error Section -->
                            <?php if ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
                                    <?= htmlspecialchars($this->session->flashdata('error')); ?>
                                    <br>
                                    <small class="text-muted">This message will disappear in 20 seconds.</small>
                                </div>
                            <?php endif; ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Auto-clear result after 20 seconds
        setTimeout(() => {
            let resultDiv = document.getElementById('result');
            if (resultDiv) {
                resultDiv.innerHTML = '';
            }
        }, 20000);

        // Function to copy the share link
        function copyToClipboard(type) {
        let linkInput = document.getElementById(type);
        if (linkInput) {
            linkInput.select();
            linkInput.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand('copy');
            alert('Link Copied!');
        }
    }

        // Clear result when form is submitted
        function clearResult() {
            document.getElementById('result').innerHTML = '';
        }
    </script>
</body>
</html>