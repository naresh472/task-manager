<?php include 'partials/header.php'; ?>
<div class="container mt-4">

 
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-success fw-bold"><i class="bi bi-plus-circle"></i> Create New Task</h2>
    <a href="index.php?page=home" class="btn btn-outline-secondary">
      <i class="bi bi-arrow-left"></i> Back to Tasks
    </a>
  </div>

  
  <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

 
  <div class="card shadow-lg border-0">
    <div class="card-body p-4">
      <form method="POST" action="index.php?page=create">
        <div class="row mb-3">
          <div class="col-md-6">
            <label for="title" class="form-label fw-semibold">Task Title</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Enter task title" required>
          </div>
          <div class="col-md-6">
            <label for="status" class="form-label fw-semibold">Status</label>
            <select id="status" name="status" class="form-select">
              <option value="Pending" selected>Pending</option>
              <option value="In Progress">In Progress</option>
              <option value="Completed">Completed</option>
            </select>
          </div>
        </div>

        <div class="mb-3">
          <label for="description" class="form-label fw-semibold">Description</label>
          <textarea id="description" name="description" class="form-control" rows="4" placeholder="Describe the task..." required></textarea>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="due_date" class="form-label fw-semibold">Due Date</label>
            <input type="date" id="due_date" name="deadline" class="form-control" required>
          </div>
          <div class="col-md-6">
            <label for="priority" class="form-label fw-semibold">Priority</label>
            <select id="priority" name="priority" class="form-select">
              <option value="High">High</option>
              <option value="Medium" selected>Medium</option>
              <option value="Low">Low</option>
            </select>
          </div>
        </div>

        <div class="row mb-4">
          <div class="col-md-6 d-flex align-items-end">
            <button type="submit" class="btn btn-success w-100">
              <i class="bi bi-save"></i> Save Task
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script>
    const today = new Date().toISOString().split('T')[0];
    document.getElementById("due_date").setAttribute("min", today);
  </script>

</div>
<?php include 'partials/footer.php'; ?>
