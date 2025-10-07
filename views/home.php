<?php include 'partials/header.php'; ?>
<div class="container mt-4">

  <!-- Page Header -->
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary fw-bold"><i class="bi bi-list-task"></i> Task Manager</h2>
    <a href="index.php?controller=task&action=create" class="btn btn-success">
      <i class="bi bi-plus-circle"></i> Create New Task
    </a>
  </div>

  <!-- Search Bar -->
  <form method="GET" action="index.php" class="row g-3 mb-3">
    <input type="hidden" name="controller" value="task">
    <input type="hidden" name="action" value="search">
    <div class="col-md-10">
      <input type="text" name="keyword" class="form-control" placeholder="🔍 Search tasks by title or description" value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
    </div>
    <div class="col-md-2 d-grid">
      <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> Search</button>
    </div>
  </form>

  <!-- Flash Message -->
  <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <!-- Task Table -->
  <div class="card shadow-lg border-0">
    <div class="card-body">
      <?php if (!empty($tasks)): ?>
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead class="table-primary">
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Due Date</th>
                <th>Created On</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($tasks as $index => $task): ?>
                <tr>
                  <td><?php echo $index + 1; ?></td>
                  <td class="fw-bold"><?php echo htmlspecialchars($task['title']); ?></td>
                  <td><?php echo htmlspecialchars(substr($task['description'], 0, 40)) . '...'; ?></td>
                  <td>
                    <?php if ($task['status'] == 'Pending'): ?>
                      <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> Pending</span>
                    <?php elseif ($task['status'] == 'In Progress'): ?>
                      <span class="badge bg-info text-dark"><i class="bi bi-arrow-repeat"></i> In Progress</span>
                    <?php else: ?>
                      <span class="badge bg-success"><i class="bi bi-check-circle"></i> Completed</span>
                    <?php endif; ?>
                  </td>
                  <td><?php echo htmlspecialchars($task['due_date']); ?></td>
                  <td><?php echo htmlspecialchars($task['created_at']); ?></td>
                  <td>
                    <a href="index.php?controller=task&action=edit&id=<?php echo $task['id']; ?>" class="btn btn-sm btn-outline-primary">
                      <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="index.php?controller=task&action=delete&id=<?php echo $task['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this task?');">
                      <i class="bi bi-trash"></i> Delete
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      <?php else: ?>
        <div class="text-center text-muted py-5">
          <i class="bi bi-emoji-frown display-5 d-block"></i>
          <h5>No tasks found!</h5>
          <p class="text-secondary">Start by creating a new task above.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>

</div>

<?php include 'partials/footer.php'; ?>
