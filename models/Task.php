<?php
class Task {
    private $con; 

    public function __construct($con) {
        $this->con = $con;
    }

    public function create($user_id, $data) {
        $user_id = (int)$user_id;
        $title = mysqli_real_escape_string($this->con, $data['title']);
        $description = mysqli_real_escape_string($this->con, $data['description'] ?? '');
        $deadline = !empty($data['deadline']) ? "'".mysqli_real_escape_string($this->con, $data['deadline'])."'" : "NULL";
        $priority = mysqli_real_escape_string($data['priority']) ;
        $status = mysqli_real_escape_string($data['status']) ;

        $sql = "INSERT INTO tasks (user_id, title, description, deadline, priority, status, created_at, updated_at) 
                VALUES ($user_id, '$title', '$description', $deadline, '$priority', '$status', NOW(), NOW())";

        if (!mysqli_query($this->con, $sql)) {
            die("Insert failed: " . mysqli_error($this->con));
        }

        return true;
    }

   
    public function getAll($user_id, $q='', $status='', $priority='', $sort='created_at_desc') {
        $user_id = (int)$user_id;
        $sql = "SELECT * FROM tasks WHERE user_id=$user_id";

        if ($q) {
            $q = mysqli_real_escape_string($this->con, $q);
            $sql .= " AND (title LIKE '%$q%' OR description LIKE '%$q%')";
        }

        // if ($status) {
        //     $status = mysqli_real_escape_string($this->con, $status);
        //     $sql .= " AND status='$status'";
        // }

        // if ($priority) {
        //     $priority = mysqli_real_escape_string($this->con, $priority);
        //     $sql .= " AND priority='$priority'";
        // }

        switch ($sort) {
            case 'deadline_asc':
                $sql .= " ORDER BY deadline ASC";
                break;
            case 'deadline_desc':
                $sql .= " ORDER BY deadline DESC";
                break;
            case 'priority':
                $sql .= " ORDER BY FIELD(priority,'High','Medium','Low')";
                break;
            default:
                $sql .= " ORDER BY created_at DESC";
        }

        $result = mysqli_query($this->con, $sql);
        $tasks = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $tasks[] = $row;
        }
        return $tasks;
    }

   
    public function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM tasks WHERE id=$id LIMIT 1";
        $result = mysqli_query($this->con, $sql);
        return mysqli_fetch_assoc($result);
    }

    
    public function update($id, $data) {
        $id = (int)$id;
        $title = mysqli_real_escape_string($this->con, $data['title']);
        $description = mysqli_real_escape_string($this->con, $data['description']);
        $deadline = mysqli_real_escape_string($this->con, $data['deadline']);
        $priority = mysqli_real_escape_string($this->con, $data['priority']);
        $status = mysqli_real_escape_string($this->con, $data['status']);

        $sql = "UPDATE tasks SET title='$title', description='$description', deadline='$deadline', 
                priority='$priority', status='$status' WHERE id=$id";
        return mysqli_query($this->con, $sql);
    }

    
    public function delete($id, $user_id) {
        $id = (int)$id;
        $user_id = (int)$user_id;
        $sql = "DELETE FROM tasks WHERE id=$id AND user_id=$user_id";
        return mysqli_query($this->con, $sql);
    }

   
    public function countsByStatus($user_id) {
        $user_id = (int)$user_id;
        $sql = "SELECT status, COUNT(*) as cnt FROM tasks WHERE user_id=$user_id GROUP BY status";
        $result = mysqli_query($this->con, $sql);

        $counts = ['Pending'=>0, 'In Progress'=>0, 'Completed'=>0];
        while ($row = mysqli_fetch_assoc($result)) {
            $counts[$row['status']] = (int)$row['cnt'];
        }
        return $counts;
    }
}
?>
