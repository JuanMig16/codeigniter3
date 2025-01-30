<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get The Share Link</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Get The Share Link</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('Oauth/get_share_link') ?>" method="POST" onsubmit="clearResult()">
                            <div class="mb-3">
                                <label for="access_token" class="form-label">Access Token:</label>
                                <input type="text" class="form-control" id="access_token" name="access_token" required>
                            </div>

                            <div class="mb-3">
                                <label for="task_id" class="form-label">Task ID:</label>
                                <input type="text" class="form-control" name="task_id" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Get The Share Link</button>
                            </div>
                        </form>

                        <!-- Display Result -->
                        <div id="result">
                        <?php if ($this->session->flashdata('share_link')): ?>
                            <?php $share_link = $this->session->flashdata('share_link'); ?>
                            <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
                                <strong>Share Link:</strong>
                                <input type="text" class="form-control mt-2" id="shareLink" value="<?= htmlspecialchars($share_link); ?>" readonly>
                                <button class="btn btn-sm btn-secondary mt-2" onclick="copyToClipboard()">Copy Link</button>
                                <br>
                                <small class="text-muted">This message will disappear in 20 seconds.</small>
                            </div>
                            <?php elseif ($this->session->flashdata('error')): ?>
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
        function copyToClipboard() {
            let linkInput = document.getElementById('shareLink');
            linkInput.select();
            linkInput.setSelectionRange(0, 99999);
            document.execCommand('copy');
            alert('Share Link Copied!');
        }

        // Clear result when form is submitted
        function clearResult() {
            document.getElementById('result').innerHTML = '';
        }
    </script>
</body>
</html>