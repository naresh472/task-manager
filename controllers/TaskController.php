<?php
require_once "models/Task.php";

class TaskController {
    private $taskModel;

    public function __construct($con) {
        $this->taskModel = new Task($con);
    }

    public function tasks() {
        $tasks = $this->taskModel->getTasks($_SESSION['user']['id']);
        include "views/tasks/index.php";
    }

    public function task_create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $desc = $_POST['description'];
            $deadline = $_POST['deadline'];
            $priority = $_POST['priority'];

            $this->taskModel->addTask($_SESSION['user']['id'], $title, $desc, $deadline, $priority);
            redirect("index.php?action=tasks");
        }
        include "views/tasks/create.php";
    }

    public function task_edit() {
        $id = $_GET['id'];
        $task = $this->taskModel->getTask($id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->taskModel->updateTask($id, $_POST);
            redirect("index.php?action=tasks");
        }
        include "views/tasks/edit.php";
    }

    public function task_delete() {
        $id = $_GET['id'];
        $this->taskModel->deleteTask($id);
        redirect("index.php?action=tasks");
    }
}
?>
