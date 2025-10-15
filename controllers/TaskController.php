<?php
require_once __DIR__ . '/../models/Task.php';
require_once __DIR__ . '/../helpers/auth.php';

class TaskController {
    private $taskModel;

    public function __construct($con) {
        $this->taskModel = new Task($con);
    }

    public function index() {
        requireLogin();
        $uid = currentUserId();

        $q = $_GET['q'] ?? '';
        // $status = $_GET['status'] ?? '';
        // $priority = $_GET['priority'] ?? '';
        // $sort = $_GET['sort'] ?? 'created_at_desc';

        $tasks = $this->taskModel->getAll($uid, $q);

        $data = [
            'tasks' => $tasks
        ];
        include __DIR__ . '/../views/home.php';
    }

    public function create() {
        requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title'       => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'deadline'    => $_POST['deadline'] ?: null,
                'priority'    => $_POST['priority'] ?: 'Medium',
                'status'      => $_POST['status'] ?: 'Pending'
            ];

            $result=$this->taskModel->create(currentUserId(), $data);
            if ($result) {
                $_SESSION['message'] = "Task created successfully!";
            } else {
                $_SESSION['message'] = "Error: " . mysqli_error($this->con);
            }

            header('Location: index.php?page=home');
            exit;
        }

        include __DIR__ . '/../views/create.php';
    }

    public function edit($id) {
        requireLogin();

        $task = $this->taskModel->getById($id);

        if (!$task || $task['user_id'] != currentUserId()) {
            header('Location: index.php?page=home');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title'       => trim($_POST['title']),
                'description' => trim($_POST['description']),
                'deadline'    => $_POST['deadline'] ?: null,
                'priority'    => $_POST['priority'] ?: 'Medium',
                'status'      => $_POST['status'] ?: 'Pending'
            ];

            $this->taskModel->update($id, $data);

            header('Location: index.php?page=home');
            exit;
        }

        $data = [
            'task' => $task
        ];
        include __DIR__ . '/../views/edit.php';
    }

    public function delete($id) {
        requireLogin();
        $this->taskModel->delete($id, currentUserId());
        header('Location: index.php?page=home');
        exit;
    }
}
