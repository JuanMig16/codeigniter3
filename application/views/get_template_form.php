<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Template</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Get Template</h2>
                    </div>
                    <div class="card-body">
                        <form action="<?= site_url('Oauth/get_template') ?>" method="POST">
                            <div class="mb-3">
                                <label for="access_token" class="form-label">Enter Access Token:</label>
                                <input type="text" class="form-control" id="access_token" name="access_token" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Get Template</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
