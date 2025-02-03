<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Access Token</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
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
                            <div class="mb-3">
                                <label for="client_id" class="form-label">Client ID: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="client_id" required>
                            </div>

                            <div class="mb-3">
                                <label for="client_secret" class="form-label">Client Secret: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="client_secret" required>
                            </div>

                            <div class="mb-3">
                                <label for="grant_type" class="form-label">Grant Type: <span class="text-danger">*</span></label>
                                <select class="form-select" name="grant_type" id="grant_type" required>
                                    <option value="client_credentials">client_credentials</option>
                                    <option value="authorization_code">authorization_code</option>
                                    <option value="refresh_token">refresh_token</option>
                                </select>
                            </div>

                            <!-- <div class="mb-3">
                                <label for="scope" class="form-label">Scope:</label>
                                <input type="text" class="form-control" name="scope" placeholder="Space-separated scopes">
                                <small class="text-muted">Required for client_credentials grant type</small>
                            </div> -->

                            <div class="mb-3 auth-code-field" style="display: none;">
                                <label for="code" class="form-label">Authorization Code:</label>
                                <input type="text" class="form-control" name="code">
                                <small class="text-muted">Required for authorization_code grant type</small>
                            </div>

                            <div class="mb-3 auth-code-field" style="display: none;">
                                <label for="redirect_uri" class="form-label">Redirect URI:</label>
                                <input type="text" class="form-control" name="redirect_uri">
                                <small class="text-muted">Required for authorization_code grant type</small>
                            </div>

                            <div class="mb-3 refresh-token-field" style="display: none;">
                                <label for="refresh_token" class="form-label">Refresh Token:</label>
                                <input type="text" class="form-control" name="refresh_token">
                                <small class="text-muted">Required for refresh_token grant type</small>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Generate Token</button>
                            </div>
                        </form>

                        <!-- Display Token Result -->
                        <div id="result">
                            <?php if ($this->session->flashdata('token_data')): ?>
                                <?php $token_data = $this->session->flashdata('token_data'); ?>
                                <div class="alert alert-success mt-3" role="alert">
                                    <h4 class="alert-heading mb-3">Token Generated Successfully!</h4>
                                    
                                    <!-- Access Token -->
                                    <div class="mb-3">
                                        <div class="d-flex align-items-center">
                                            <strong class="me-2">Access Token:</strong>
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="accessToken" 
                                                       value="<?= htmlspecialchars($token_data['access_token']); ?>" readonly>
                                                <button class="btn btn-outline-secondary" type="button" onclick="copyAccessToken()">
                                                    <i class="bi bi-clipboard"></i> Copy
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Token Type -->
                                    <div class="mb-2">
                                        <strong>Token Type:</strong> <?= htmlspecialchars($token_data['token_type']); ?>
                                    </div>

                                    <!-- Expires In -->
                                    <div class="mb-2">
                                        <strong>Expires In:</strong> <?= htmlspecialchars($token_data['expires_in']); ?> seconds
                                    </div>

                                    <!-- Refresh Token
                                    <div class="mb-2">
                                        <strong>Refresh Token:</strong> <?= htmlspecialchars($token_data['refresh_token']); ?>
                                    </div> -->

                                    <!-- Scope -->
                                    <!-- <div class="mb-2">
                                        <strong>Scope:</strong> <?= htmlspecialchars($token_data['scope']); ?>
                                    </div> -->

                                    <!-- Created At -->
                                    <div class="mb-2">
                                        <strong>Created At:</strong> <?= htmlspecialchars($token_data['created_at']); ?>
                                    </div>

                                    <hr>
                                    <small class="text-muted">This message will disappear in 20 seconds.</small>
                                </div>
                            <?php elseif ($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger mt-3" role="alert">
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
        // Show/hide fields based on grant type
        document.getElementById('grant_type').addEventListener('change', function() {
            const authCodeFields = document.querySelectorAll('.auth-code-field');
            const refreshTokenField = document.querySelector('.refresh-token-field');
            
            // Hide all conditional fields first
            authCodeFields.forEach(field => field.style.display = 'none');
            refreshTokenField.style.display = 'none';
            
            // Show relevant fields based on grant type
            if (this.value === 'authorization_code') {
                authCodeFields.forEach(field => field.style.display = 'block');
            } else if (this.value === 'refresh_token') {
                refreshTokenField.style.display = 'block';
            }
        });

        // Function to copy access token
        function copyAccessToken() {
            const tokenInput = document.getElementById('accessToken');
            tokenInput.select();
            document.execCommand('copy');
            
            // Show feedback
            const copyButton = tokenInput.nextElementSibling;
            const originalContent = copyButton.innerHTML;
            copyButton.innerHTML = '<i class="bi bi-check"></i> Copied!';
            setTimeout(() => {
                copyButton.innerHTML = originalContent;
            }, 2000);
        }

        // Auto-clear result after 20 seconds
        setTimeout(() => {
            let resultDiv = document.getElementById('result');
            if (resultDiv) {
                resultDiv.innerHTML = '';
            }
        }, 20000);
    </script>
</body>
</html>