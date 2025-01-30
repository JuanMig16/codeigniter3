<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Create a New Task</h2>
                    </div>
                    <div class="card-body">

                        <!-- Success Message -->
                        <?php if (isset($task_id)): ?>
                            <div class="alert alert-success" role="alert">
                                <h4 class="alert-heading">Task Created Successfully!</h4>
                                <p><strong>Task ID:</strong> <?= $task_id ?></p>
                            </div>
                        <?php endif; ?>

                        <!-- Error Message -->
                        <?php if ($this->session->flashdata('error')): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $this->session->flashdata('error'); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Task Creation Form -->
                        <form action="<?= site_url('Oauth/create_task') ?>" method="POST">

                            <!-- Template ID -->
                            <div class="mb-3">
                                <label for="template_id" class="form-label">Template ID (required):</label>
                                <input type="number" class="form-control" id="template_id" name="template_id" required>
                            </div>

                            <!-- File Name -->
                            <div class="mb-3">
                                <label for="file_name" class="form-label">File Name:</label>
                                <input type="text" class="form-control" id="file_name" name="file_name" required>
                            </div>

                            <!-- Stage Section -->
                            <h3 class="mt-4">Stage:</h3>

                            <!-- Stage Name -->
                            <div class="mb-3">
                                <label for="stage_name" class="form-label">Stage Name:</label>
                                <input type="text" class="form-control" id="stage_name" name="stages[0][name]" required>
                            </div>

                            <!-- Stage Email -->
                            <div class="mb-3">
                                <label for="stage_email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="stage_email" name="stages[0][email]" required>
                            </div>

                            <!-- Field Settings -->
                            <h4 class="mt-4">Field Settings:</h4>

                            <!-- Field Type -->
                            <div class="mb-3">
                                <label for="field_type" class="form-label">Field Type:</label>
                                <input type="text" class="form-control" id="field_type" name="stages[0][field_settings][0][field_type]" value="textfield" required>
                            </div>

                            <!-- Coordinates -->
                            <div class="mb-3">
                                <label for="coord" class="form-label">Coordinates (left-x, bottom-y, right-x, top-y):</label>
                                <input type="text" class="form-control" id="coord" name="stages[0][field_settings][0][coord]" value="15.5,30.2,45.8,60.1" required>
                            </div>

                            <!-- Page -->
                            <div class="mb-3">
                                <label for="page" class="form-label">Page:</label>
                                <input type="number" class="form-control" id="page" name="stages[0][field_settings][0][page]" value="0" required>
                            </div>

                            <!-- Access Token -->
                            <div class="mb-3">
                                <label for="access_token" class="form-label">Access Token:</label>
                                <input type="text" class="form-control" id="access_token" name="access_token" value="<?= set_value('access_token') ?>" required>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Create Task</button>
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