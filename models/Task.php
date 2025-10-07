<?php
class Task {
    private $con;
    public function __construct($con) { $this->con = $con; }

    public function getTasks($uid) {
        $res = mysqli_query($this->con, "SELECT * FROM tasks WHERE user_id='$uid' ORDER BY deadline ASC");
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    public function getTask($id) {
        $res = mysqli_query($this->con, "SELECT * FROM tasks WHERE id='$id'");
        return mysqli_fetch_assoc($res);
    }

    public function addTask($uid, $title, $desc, $deadline, $priority) {
        return mysqli_query($this->con, "INSERT INTO tasks (user_id,title,description,deadline,priority,status) VALUES ('$uid','$title','$desc','$deadline','$priority','Pending')");
    }

    public function updateTask($id, $data) {
        $title = $data['title'];
        $desc = $data['description'];
        $deadline = $data['deadline'];
        $priority = $data['priority'];
        $status = $data['status'];
        return mysqli_query($this->con, "UPDATE tasks SET title='$title',description='$desc',deadline='$deadline',priority='$priority',status='$status' WHERE id='$id'");
    }

    public function deleteTask($id) {
        return mysqli_query($this->con, "DELETE FROM tasks WHERE id='$id'");
    }
}
?>
