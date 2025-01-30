<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Access Token</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Create Access Token</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('Oauth/create_token') ?>" method="POST">
                            <input type="hidden" name="grant_type" value="client_credentials">

                            <div class="mb-3">
                                <label for="client_id" class="form-label">Client ID:</label>
                                <input type="text" class="form-control" name="client_id" required>
                            </div>

                            <div class="mb-3">
                                <label for="client_secret" class="form-label">Client Secret:</label>
                                <input type="text" class="form-control" name="client_secret" required>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Generate Token</button>
                            </div>
                        </form>

                        <!-- Display Token Result -->
                    <div id="result">
                        <?php if ($this->session->flashdata('token_data')): ?>
                            <?php $token_data = $this->session->flashdata('token_data'); ?>
                            <div class="alert alert-success mt-3 alert-dismissible fade show" role="alert">
                                <strong>Access Token:</strong> <?= htmlspecialchars($token_data['access_token']); ?><br>
                                <strong>Expires In:</strong> <?= htmlspecialchars($token_data['expires_in']); ?> seconds
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Auto-clear result after 10 seconds
        setTimeout(() => {
            let resultDiv = document.getElementById('result');
            if (resultDiv) {
                resultDiv.innerHTML = '';
            }
        }, 20000);

        // Function to copy the access token
        function copyToClipboard() {
            let tokenInput = document.getElementById('accessToken');
            tokenInput.select();
            tokenInput.setSelectionRange(0, 99999); // For mobile devices
            document.execCommand('copy');
            alert('Access Token Copied!');
        }
    </script>
</body>
</html>
