<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      height: 100vh;
    }
  </style>
</head>
<body class="bg-light d-flex align-items-center justify-content-center">

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
          <h3 class="text-center mb-4 fw-bold">Reset Password</h3>

            <?php if (!empty($userController->success)) : ?>
                <div class="alert alert-success text-center fw-semibold mx-auto w-75" role="alert">
                <?php echo $userController->success; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($userController->error)) : ?>
                <div class="alert alert-danger text-center fw-semibold mx-auto w-75" role="alert">
                <?php echo $userController->error; ?>
                </div>
            <?php endif; ?>
          

          <form method="post" action="">
            <div class="mb-3">
              <label for="email" class="form-label">Registered Email</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="favorite_movie" class="form-label">Your Favorite Movie</label>
              <input type="text" name="favorite_movie" id="favorite_movie" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="new_password" class="form-label">New Password</label>
              <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>

            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm New Password</label>
              <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>

            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-success btn-lg rounded-3">Reset Password</button>
            </div>

            <p class="text-center mb-0">
              Remembered your password? 
              <a href="index.php?page=login" class="text-decoration-none fw-semibold">Login here</a>
            </p>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>