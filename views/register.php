<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
 
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
          <h3 class="text-center mb-4 fw-bold">Register</h3>
          
          <form method="post" action="/user/register">
           
            
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>

           
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" id="name" class="form-control" required>
            </div>

           

           
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>

           
            <div class="mb-3">
              <label for="confirm_password" class="form-label">Confirm Password</label>
              <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>

        
            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-primary btn-lg rounded-3">Register</button>
            </div>

            
            <p class="text-center mb-0">
              Already have an account? 
              <a href="./login.php" class="text-decoration-none fw-semibold">Go to Login</a>
            </p>
          </form>

        </div>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
