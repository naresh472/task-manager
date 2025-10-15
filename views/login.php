<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
 
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
          <h3 class="text-center mb-4 fw-bold">Login</h3>

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
        
          <form method="post" action="index.php?page=login">
            
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>

          
            

            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-primary btn-lg rounded-3">Login</button>
            </div>

            <div class="text-end mb-3">
              <a href="index.php?page=forgot_password" class="text-decoration-none text-danger fw-semibold">
                Forgot Password?
              </a>
            </div>

            <p class="text-center mb-0">
              Don’t have an account? 
              <a href="index.php?page=register" class="text-decoration-none fw-semibold">Go to Register</a>
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
